<?php

namespace App\Http\Controllers;

use App\ShoppingCart\ShoppingCart;
use App\Http\Requests;
use App\Item;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
	protected $cart;

	public function __construct(ShoppingCart $cart)
	{
		$this->cart = $cart;
	}

	public function index()
	{
		$cart = $this->cart->all();
		$subtotal = $this->cart->subtotal();
		return view('cart.index', compact('cart', 'subtotal'));
	}

    public function store(Request $request)
    {
    	$item = Item::findOrFail($request->item_id);
    	$this->cart->store($item);

    	return back();
    }
}
