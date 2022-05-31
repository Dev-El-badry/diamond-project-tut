<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoomController extends Controller
{

    public function index()
    {
        $rows = HotelRoom::get();
        return view('admin.rooms.index', compact('rows'));
    }


    public function create()
    {
        $hotels = Hotel::get();
        return view('admin.rooms.create', compact('hotels'));
    }

    public function store(Request $request)
    { 
        $request->validate([
            'code'              => ['required', 'string', 'max:255'],
            'price'              => ['required', 'string', 'max:255'],
            'image'             => ['required', 'mimes:jpg,jpeg,png'],
        ]);

        $room = HotelRoom::create([
            'code'              => $request['code'],
            'hotel_id'           => $request['hotel_id'],
            'price'           => $request['price'],
        ]);

        $room->addMediaFromRequest('image')->toMediaCollection('rooms');


        Session::flash('result', 2);
        return redirect('/admin/rooms');

    }

    public function edit($id)
    {
        $row = HotelRoom::find($id);
        $hotels = Hotel::get();
        return view('admin.rooms.edit', compact('row', 'hotels'));
    }

    public function update(Request $request, HotelRoom $room)
    {
        $request->validate([
            'code'              => ['required', 'string', 'max:255'],
            'price'              => ['required', 'string', 'max:255'],
        ]);

        $room->update($request->all());

        if($request->image){
            $room->clearMediaCollection('rooms');
            $room->addMediaFromRequest('image')->toMediaCollection('rooms');
        }

        Session::flash('result', 3); 
        return redirect('/admin/rooms');
    }

    public function destroy(HotelRoom $room)
    {
        $room->delete();
        Session::flash('result', 1); 
        return redirect('/admin/rooms');
    }




}