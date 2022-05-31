<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Validator, Auth, Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProfileController extends Controller
{
    public function update()
    {
        return view('profile.update');
    }

    public function postUpdate(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth()->user()->id]
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard.update')->withErrors($validator);
        }

        Auth::user()->update($data);
        Session::flash('updated', 'Profile has been updated !');
        return redirect()->route('dashboard.update');
    }

    public function updatePassword()
    {
        return view('profile.update-password');
    }

    public function postUpdatePassword(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard.update-password')->withErrors($validator);
        }

        Auth::user()->update($data);
        Session::flash('updated', 'Password has been updated !');

        return redirect()->route('dashboard.update-password');
    }

    public function cart()
    {
        $items = Cart::where('user_id', Auth::id())->get();

        return view('profile.cart', compact('items'));
    }

    public function deleteCart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('dashboard.cart');
    }

    public function bookings()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('profile.bookings', compact('orders'));
    }

    public function charge(Request $request)
    {
        $ids = explode(',', $request->item_ids);

        foreach ($ids as $val) {
            $cart = Cart::find($val);
            Order::create([
                'order_ref' => Str::random(8),
                'room_id' => $cart->room_id,
                'hotel_id' => $cart->hotel_id,
                'user_id' => $cart->user_id,
                'price' => intval($request->price),
                'order_status' => 1,
                'strip_token' => $request->stripeToken
            ]);
        }

        Cart::whereIn('id', $ids)->delete();
        return redirect()->route('dashboard.bookings');
    }
}
