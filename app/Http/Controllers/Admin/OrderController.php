<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{

    public function index()
    {
        $rows = Order::get();
        return view('admin.orders.index', compact('rows'));
    }

    public function show(Order $order)
    {
        $row = $order;
        return view('admin.orders.show', compact('row'));
    }


}