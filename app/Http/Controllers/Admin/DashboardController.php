<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\Order;
use App\Models\Place;
use App\Models\Restaurant;
use App\Models\Store;
use App\Models\User;
use App\Models\Village;

class DashboardController extends Controller
{

    public function index()
    {
        $orders = Order::count();
        $users = User::count();
        $hotels = Hotel::count();
        $hospitals = Hospital::count();
        $stores = Store::count();
        $villages = Village::count();
        $rooms = HotelRoom::count();
        $restaurants = Restaurant::count();

        return view('admin.dashboard', compact(
            'orders', 'users', 'hotels', 'hospitals', 'stores', 'villages', 'rooms', 'restaurants'
        ));
    }

}