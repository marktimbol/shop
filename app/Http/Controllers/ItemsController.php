<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Http\Requests;
use App\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
	public function index(Request $request)
	{
		$items = Item::latest()->get();
		$brands = Brand::latest()->get();
		
		return view('pages.items.index', compact('items', 'brands'));
	}

    public function show($item)
    {
    	$relatedItems = Item::latest()->get();
    	return view('pages.items.show', compact('item', 'relatedItems'));
    }
}
