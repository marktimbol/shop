<?php

namespace App\Http\Controllers;

use App\Item;
use App\Http\Requests;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
    	$items = Item::latest()->get();
    	return view('pages.home', compact('items'));
    }
}
