<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HotelController extends Controller
{

    public function index()
    {
        $rows = Hotel::get();
        return view('admin.hotels.index', compact('rows'));
    }


    public function create()
    {
        $places = Place::get();
        return view('admin.hotels.create', compact('places'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar'    => ['required', 'string', 'max:255'],
            'name_en'    => ['required', 'string', 'max:255'],
            'description_ar'       => ['required', 'string', 'max:2000'],
            'description_en'       => ['required', 'string', 'max:2000'],
            'address_details'   => ['required', 'string', 'max:2000'],
            'image'             => ['required', 'mimes:jpg,jpeg,png'],
            'place_id'          => ['required', 'exists:places,id'],
        ]);

        $hotel = Hotel::create([
            'name' => ['ar' => $request['name_ar'], 'en' => $request['name_en']],
            'description' => ['ar' => $request['description_ar'], 'en' => $request['description_en']],
            'address_details'   => $request['address_details'],
            'place_id'          => $request['place_id'],
        ]);

        $hotel->addMediaFromRequest('image')->toMediaCollection('hotels');


        Session::flash('result', 2);
        return redirect('/admin/hotels');
    }

    public function edit($id)
    {
        $row = Hotel::find($id);
        $places = Place::get();
        return view('admin.hotels.edit', compact('row', 'places'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name_ar'    => ['required', 'string', 'max:255'],
            'name_en'    => ['required', 'string', 'max:255'],

            'address_details'   => ['required', 'string', 'max:2000'],

            'place_id'          => ['required', 'exists:places,id'],
        ]);

        $hotel->update([
            'name' => ['ar' => $request['name_ar'], 'en' => $request['name_en']],
            'description' => ['ar' => $request['description_ar'], 'en' => $request['description_en']],
            'address_details'   => $request['address_details'],
            'place_id'          => $request['place_id'],
        ]);

        if ($request->image) {
            $hotel->clearMediaCollection('hotels');
            $hotel->addMediaFromRequest('image')->toMediaCollection('hotels');
        }

        Session::flash('result', 3);
        return redirect('/admin/hotels');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        Session::flash('result', 1);
        return redirect('/admin/hotels');
    }

    public function insertPhotos(Request $request, $id)
    {
        $request->validate([
            'images'             => ['required'],
            'images.*'           => ['required', 'mimes:jpg,jpeg,png'],
            // 'place_id'           => ['required', 'exists:places,id'],
        ]);

        $hotel = Hotel::find($id);
        if ($request->hasFile('images')) {
            $fileAdders = $hotel->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('hotel-gallery');
                });
        }

        Session::flash('result', 3);
        return redirect('/admin/hotels');
    }

    public function deleteImage(Request $request)
    {
        $uuid = $request->uuid;

        DB::table('media')->where('uuid', $uuid)->delete();
    }
}
