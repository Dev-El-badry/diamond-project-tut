<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class RestaurantController extends Controller
{

    public function index()
    {
        $rows = Restaurant::get();
        return view('admin.restaurants.index', compact('rows'));
    }


    public function create()
    {
        $places = Place::get();
        return view('admin.restaurants.create', compact('places'));
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

        $restaurant = Restaurant::create([
            'name' => ['ar' => $request['name_ar'], 'en' => $request['name_en']],
            'description' => ['ar' => $request['description_ar'], 'en' => $request['description_en']],
            'address_details'   => $request['address_details'],
            'place_id'          => $request['place_id'],
        ]);

        $restaurant->addMediaFromRequest('image')->toMediaCollection('restaurants');


        Session::flash('result', 2);
        return redirect('/admin/restaurants');
    }

    public function edit($id)
    {
        $row = Restaurant::find($id);
        $places = Place::get();
        return view('admin.restaurants.edit', compact('row', 'places'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {

        $request->validate([
            'name_ar'    => ['required', 'string', 'max:255'],
            'name_en'    => ['required', 'string', 'max:255'],
            'description_ar'       => ['required', 'string', 'max:2000'],
            'description_en'       => ['required', 'string', 'max:2000'],
            'address_details'   => ['required', 'string', 'max:2000'],

            'place_id'          => ['required', 'exists:places,id'],
        ]);

        $restaurant->update([
            'name' => ['ar' => $request['name_ar'], 'en' => $request['name_en']],
            'description' => ['ar' => $request['description_ar'], 'en' => $request['description_en']],
            'address_details'   => $request['address_details'],
            'place_id'          => $request['place_id'],
        ]);

        if ($request->image) {
            $restaurant->clearMediaCollection('restaurants');
            $restaurant->addMediaFromRequest('image')->toMediaCollection('restaurants');
        }

        Session::flash('result', 3);
        return redirect('/admin/restaurants');
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        Session::flash('result', 1);
        return redirect('/admin/restaurants');
    }



    public function insertPhotos(Request $request, $id)
    {
        $request->validate([
            'images'             => ['required'],
            'images.*'           => ['required', 'mimes:jpg,jpeg,png'],
            // 'place_id'           => ['required', 'exists:places,id'],
        ]);

        $restautant = Restaurant::find($id);
        if ($request->hasFile('images')) {
            $fileAdders = $restautant->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('restaurant-gallery');
                });
        }

        Session::flash('result', 3);
        return redirect('/admin/restaurants');
    }

    public function deleteImage(Request $request)
    {
        $uuid = $request->uuid;

        DB::table('media')->where('uuid', $uuid)->delete();
    }
}
