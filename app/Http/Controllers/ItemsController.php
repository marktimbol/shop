<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ItemsController extends Controller
{
    public function show($item)
    {
    	return view('items.show', compact('item'));
    }
}
