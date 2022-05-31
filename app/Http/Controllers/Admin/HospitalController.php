<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HospitalController extends Controller
{

    public function index()
    {
        $rows = Hospital::get();
        return view('admin.hospitals.index', compact('rows'));
    }


    public function create()
    {
        $villages = Place::get();
        return view('admin.hospitals.create', compact('villages'));
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
            'village_id'          => ['required', 'exists:places,id'],
        ]);

        $hospital = Hospital::create([
            'name' => ['ar' => $request['name_ar'], 'en' => $request['name_en']],
            'description' => ['ar' => $request['description_ar'], 'en' => $request['description_en']],
            'address_details'   => $request['address_details'],
            'village_id'          => $request['village_id'],
        ]);

        $hospital->addMediaFromRequest('image')->toMediaCollection('hospitals');


        Session::flash('result', 2);
        return redirect('/admin/hospitals');
    }

    public function edit($id)
    {
        $row = Hospital::find($id);
        $villages = Place::get();
        return view('admin.hospitals.edit', compact('row', 'villages'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $request->validate([
            'name_ar'    => ['required', 'string', 'max:255'],
            'name_en'    => ['required', 'string', 'max:255'],
            'description_ar'       => ['required', 'string', 'max:2000'],
            'description_en'       => ['required', 'string', 'max:2000'],
            'address_details'   => ['required', 'string', 'max:2000'],
            'village_id'          => ['required', 'exists:places,id'],
        ]);

        $hospital->update([
            'name' => ['ar' => $request['name_ar'], 'en' => $request['name_en']],
            'description' => ['ar' => $request['description_ar'], 'en' => $request['description_en']],
            'address_details'   => $request['address_details'],
            'village_id'          => $request['village_id'],
        ]);

        if ($request->image) {
            $hospital->clearMediaCollection('hospitals');
            $hospital->addMediaFromRequest('image')->toMediaCollection('hospitals');
        }

        Session::flash('result', 3);
        return redirect('/admin/hospitals');
    }

    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
        Session::flash('result', 1);
        return redirect('/admin/hospitals');
    }

    public function insertPhotos(Request $request, $id)
    {
        $request->validate([
            'images'             => ['required'],
            'images.*'             => ['required', 'mimes:jpg,jpeg,png'],
        ]);

        $hospital = Hospital::find($id);
        if ($request->hasFile('images')) {
            $fileAdders = $hospital->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('hospital-gallery');
                });
        }

        Session::flash('result', 3);
        return redirect('/admin/hospitals');
    }

    public function deleteImage(Request $request)
    {
        $uuid = $request->uuid;

        DB::table('media')->where('uuid', $uuid)->delete();
    }
}
