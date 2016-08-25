<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OrdersController extends Controller
{
    public function index()
    {
    	$orders = auth()->user()->orders;
    	return view('dashboard.orders.index', compact('orders'));
    }

    public function show($order)
    {
    	return view('dashboard.orders.show', compact('order'));
    }
}
