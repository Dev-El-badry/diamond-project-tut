<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PlaceController extends Controller
{

    public function index()
    {
        $rows = Place::get();
        return view('admin.places.index', compact('rows'));
    }


    public function create()
    {
        return view('admin.places.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar'    => ['required', 'string', 'max:255'],
            'name_en'    => ['required', 'string', 'max:255'],
        ]);

        $place = Place::create([
            'name' => ['ar' => $request['name_ar'], 'en' => $request['name_en']]
        ]);


        Session::flash('result', 2);
        return redirect('/admin/places');
    }

    public function edit($id)
    {
        $row = Place::find($id);
        return view('admin.places.edit', compact('row'));
    }

    public function update(Request $request, Place $place)
    {
        $request->validate([
            'name_ar'    => ['required', 'string', 'max:255'],
            'name_en'    => ['required', 'string', 'max:255'],
        ]);

        $place->update(['name' => ['ar' => $request['name_ar'], 'en' => $request['name_en']]]);

        Session::flash('result', 3);
        return redirect('/admin/places');
    }

    public function destroy(Place $place)
    {
        $place->delete();
        Session::flash('result', 1);
        return redirect('/admin/places');
    }
}
