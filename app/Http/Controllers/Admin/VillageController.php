<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Village;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VillageController extends Controller
{

    public function index()
    {
        $rows = Village::get();
        return view('admin.villages.index', compact('rows'));
    }


    public function create()
    {
        $places = Place::get();
        return view('admin.villages.create', compact('places'));
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

        $village = Village::create([
            'name' => ['ar' => $request['name_ar'], 'en' => $request['name_en']],
            'description' => ['ar' => $request['description_ar'], 'en' => $request['description_en']],
            'address_details'   => $request['address_details'],
            'place_id'          => $request['place_id'],
        ]);

        $village->addMediaFromRequest('image')->toMediaCollection('villages');


        Session::flash('result', 2);
        return redirect('/admin/villages');
    }

    public function edit($id)
    {
        $row = Village::find($id);
        $places = Place::get();
        return view('admin.villages.edit', compact('row', 'places'));
    }

    public function update(Request $request, Village $village)
    {
        $request->validate([
            'name_ar'    => ['required', 'string', 'max:255'],
            'name_en'    => ['required', 'string', 'max:255'],
            'address_details'   => ['required', 'string', 'max:2000'],
            'place_id'          => ['required', 'exists:places,id'],
        ]);

        $village->update([
            'name' => ['ar' => $request['name_ar'], 'en' => $request['name_en']],
            'description' => ['ar' => $request['description_ar'], 'en' => $request['description_en']],
            'address_details'   => $request['address_details'],
            'place_id'          => $request['place_id'],
        ]);

        if ($request->image) {
            $village->clearMediaCollection('villages');
            $village->addMediaFromRequest('image')->toMediaCollection('villages');
        }

        Session::flash('result', 3);
        return redirect('/admin/villages');
    }

    public function destroy(Village $village)
    {
        $village->delete();
        Session::flash('result', 1);
        return redirect('/admin/villages');
    }

    public function insertPhotos(Request $request, $id)
    {
        $request->validate([
            'images'             => ['required'],
            'images.*'             => ['required', 'mimes:jpg,jpeg,png'],
        ]);

        $village = Village::find($id);
        if ($request->hasFile('images')) {
            $fileAdders = $village->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('village-gallery');
                });
        }

        Session::flash('result', 3);
        return redirect('/admin/villages');
    }

    public function deleteImage(Request $request)
    {
        $uuid = $request->uuid;

        DB::table('media')->where('uuid', $uuid)->delete();
    }
}
