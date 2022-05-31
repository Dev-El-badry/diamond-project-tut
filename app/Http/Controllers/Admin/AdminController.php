<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    {
        $rows = Admin::get();
        return view('admin.admins.index', compact('rows'));
    }


    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password'      => ['required', 'string', 'min:8'],
            'activation'    => ['required'],
        ]);

        $admin = Admin::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'activation'    => $request['activation'],
        ]);

        $admin->addMediaFromRequest('image')->toMediaCollection('admins');


        Session::flash('result', 2); 
        return redirect('/admin/admins');

    }

    public function edit($id)
    {
        $row = Admin::find($id);

        return view('admin.admins.edit', compact('row'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['required', 'string', 'max:255'],
            'email'         => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'password'      => ['nullable', 'string', 'min:8'],
            'activation'    => ['required'],
        ]);

        if(!$request->password)
            $request->offsetUnset('password');

        $request['password'] = Hash::make($request['password']);

        $admin->update($request->all());

        if($request->image){
            $admin->clearMediaCollection('admins');
            $admin->addMediaFromRequest('image')->toMediaCollection('admins');
        }

        Session::flash('result', 3); 
        return redirect('/admin/admins');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        Session::flash('result', 1); 
        return redirect('/admin/admins');
    }




}