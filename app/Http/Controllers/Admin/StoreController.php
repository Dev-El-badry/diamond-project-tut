<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StoreController extends Controller
{

    public function index()
    {
        $rows = Store::get();
        return view('admin.stores.index', compact('rows'));
    }


    public function create()
    {
        $places = Place::get();
        return view('admin.stores.create', compact('places'));
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

        $store = Store::create([
            'name' => ['ar' => $request['name_ar'], 'en' => $request['name_en']],
            'description' => ['ar' => $request['description_ar'], 'en' => $request['description_en']],
            'address_details'   => $request['address_details'],
            'place_id'          => $request['place_id'],
        ]);

        $store->addMediaFromRequest('image')->toMediaCollection('stores');


        Session::flash('result', 2);
        return redirect('/admin/stores');
    }

    public function edit($id)
    {
        $row = Store::find($id);
        $places = Place::get();
        return view('admin.stores.edit', compact('row', 'places'));
    }

    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name_ar'    => ['required', 'string', 'max:255'],
            'name_en'    => ['required', 'string', 'max:255'],
            'description_ar'       => ['required', 'string', 'max:2000'],
            'description_en'       => ['required', 'string', 'max:2000'],
            'address_details'   => ['required', 'string', 'max:2000'],
            'place_id'          => ['required', 'exists:places,id'],
        ]);
        $store->update([
            'name' => ['ar' => $request['name_ar'], 'en' => $request['name_en']],
            'description' => ['ar' => $request['description_ar'], 'en' => $request['description_en']],
            'address_details'   => $request['address_details'],
            'place_id'          => $request['place_id'],
        ]);

        if ($request->image) {
            $store->clearMediaCollection('stores');
            $store->addMediaFromRequest('image')->toMediaCollection('stores');
        }

        Session::flash('result', 3);
        return redirect('/admin/stores');
    }

    public function destroy(Store $store)
    {
        $store->delete();
        Session::flash('result', 1);
        return redirect('/admin/stores');
    }

    public function insertPhotos(Request $request, $id)
    {
        $request->validate([
            'images'             => ['required'],
            'images.*'             => ['required', 'mimes:jpg,jpeg,png'],
        ]);

        $store = Store::find($id);
        if ($request->hasFile('images')) {
            $fileAdders = $store->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('store-gallery');
                });
        }

        Session::flash('result', 3);
        return redirect('/admin/stores');
    }

    public function deleteImage(Request $request)
    {
        $uuid = $request->uuid;

        DB::table('media')->where('uuid', $uuid)->delete();
    }
}
