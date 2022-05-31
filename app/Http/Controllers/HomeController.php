<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Hospital;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\Restaurant;
use App\Models\Store;
use App\Models\Village;
use Illuminate\Http\Request;
use DB, Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function home()
    {
        return redirect()->route('home');
    }

    public function hotels(Request $request)
    {
        $name = $request->query('name') ?? '';
        $place = $request->query('place') ?? '';

        $hotels = Hotel::where('name', 'LIKE', "%$name%")
            ->whereHas('place');

        if (!empty($place)) {
            $hotels = $hotels->where('place_id', $place);
        }

        $hotels = $hotels->paginate(10);

        return view('hotels.index', compact('hotels'));
    }

    public function singleHotel($id)
    {
        $hotel = Hotel::findOrFail($id);

        return view('hotels.single-hotel', compact('hotel'));
    }

    public function bookingRoom($id)
    {
        $room = HotelRoom::findOrFail($id);

        Cart::create(['room_id' => $room->id, 'hotel_id' => $room->hotel_id, 'user_id' => Auth::id()]);
        return redirect()->route('dashboard.cart');
    }

    public function villas(Request $request)
    {
        $name = $request->query('name') ?? '';
        $place = $request->query('place') ?? '';

        $villas = Village::where('name', 'LIKE', "%$name%")
            ->whereHas('place');

        if (!empty($place)) {
            $villas = $villas->where('place_id', $place);
        }

        $villas = $villas->paginate(10);

        return view('villas.index', compact('villas'));
    }

    public function singleVilla($id)
    {
        $villa = Village::findOrFail($id);
        return view('villas.show', compact('villa'));
    }

    public function hospitals(Request $request)
    {
        $name = $request->query('name') ?? '';
        $place = $request->query('place') ?? '';

        $hospitals = Hospital::where('name', 'LIKE', "%$name%")
            ->whereHas('place');

        if (!empty($place)) {
            $hospitals = $hospitals->where('village_id', $place);
        }

        $hospitals = $hospitals->paginate(10);

        return view('hospitals.index', compact('hospitals'));
    }

    public function singleHospitals($id)
    {
        $hospital = Hospital::findOrFail($id);

        return view('hospitals.show', compact('hospital'));
    }

    public function restaurants(Request $request)
    {
        $name = $request->query('name') ?? '';
        $place = $request->query('place') ?? '';

        $restaurant = Restaurant::where('name', 'LIKE', "%$name%")
            ->whereHas('place');

        if (!empty($place)) {
            $restaurant = $restaurant->where('place_id', $place);
        }

        $restaurant = $restaurant->paginate(10);

        return view('restaurants.index', compact('restaurant'));
    }

    public function singleRestaurants($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('restaurants.show', compact('restaurant'));
    }

    public function stores(Request $request)
    {
        $name = $request->query('name') ?? '';
        $place = $request->query('place') ?? '';

        $stores = Store::where('name', 'LIKE', "%$name%")
            ->whereHas('place');

        if (!empty($place)) {
            $stores = $stores->where('place_id', $place);
        }

        $stores = $stores->paginate(10);
        return view('stores.index', compact('stores'));
    }

    public function singleStores($id)
    {
        $store = Store::findOrFail($id);
        return view('stores.show', compact('store'));
    }

    public function searchResults(Request $request)
    {
        $results = [];

        $name = $request->query('name') ?? '';
        $place = $request->query('place') ?? '';

        $hotels = Hotel::where('name', 'LIKE', "%$name%")->whereHas('place');
        $villas = Village::where('name', 'LIKE', "%$name%")->whereHas('place');
        $hospitals = Hospital::where('name', 'LIKE', "%$name%")->whereHas('place');
        $restaurant = Restaurant::where('name', 'LIKE', "%$name%")->whereHas('place');
        $stores = Store::where('name', 'LIKE', "%$name%")->whereHas('place');

        if (!empty($place)) {
            $hotels = $hotels->where('place_id', $place);
            $villas = $villas->where('place_id', $place);
            $restaurant = $restaurant->where('place_id', $place);
            $stores = $stores->where('place_id', $place);
            $hospitals = $hospitals->where('village_id', $place);
        }

        array_push(
            $results,
            ["hotels" => $hotels->get()],
            ["villas" => $villas->get()],
            ["restaurants" => $restaurant->get()],
            ["stores" => $stores->get()],
            ["hospitals" => $hospitals->get()]
        );

        return view('results.index', compact('results'));
    }
}
