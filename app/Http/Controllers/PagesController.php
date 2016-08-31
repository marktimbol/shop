<?php

namespace App\Http\Controllers;

use App\Item;
use App\Http\Requests;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
    	$featuredItems = Item::featured()->latest()->get();

    	\JavaScript::put([
    		'featuredItems'	=> $featuredItems
    	]);

    	return view('pages.home', compact('items', 'featuredItems'));
    }
}
