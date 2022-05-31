<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function index()
    {
        $rows = User::get();
        return view('admin.users.index', compact('rows'));
    }


    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    { 
        $request->validate([
            'first_name'        => ['required', 'string', 'max:255'],
            'last_name'         => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'          => ['required', 'string', 'min:8'],
            'activation'        => ['required'],
            'image'             => ['required', 'mimes:jpg,jpeg,png'],
        ]);

        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'activation'    => $request['activation'],
        ]);

        $user->addMediaFromRequest('image')->toMediaCollection('users');


        Session::flash('result', 2); 
        return redirect('/admin/users');

    }

    public function edit($id)
    {
        $row = User::find($id);

        return view('admin.users.edit', compact('row'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['required', 'string', 'max:255'],
            'email'         => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password'      => ['nullable', 'string', 'min:8'],
            'activation'    => ['required'],
        ]);

        if(!$request->password)
            $request->offsetUnset('password');

        $request['password'] = Hash::make($request['password']);

        $user->update($request->all());

        if($request->image){
            $user->clearMediaCollection('users');
            $user->addMediaFromRequest('image')->toMediaCollection('users');
        }

        Session::flash('result', 3); 
        return redirect('/admin/users');
    }

    public function destroy(User $user)
    {
        $user->delete();
        Session::flash('result', 1); 
        return redirect('/admin/users');
    }




}