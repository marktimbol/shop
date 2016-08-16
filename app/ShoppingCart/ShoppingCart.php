<?php
namespace App\ShoppingCart;

use App\Item;
use Cart;

class ShoppingCart
{
	public function all()
	{
		return Cart::content();
	}

	public function store(Item $item)
	{
		Cart::add($item->id, $item->name, 1, $item->price);
	}

	public function subtotal()
	{
		return Cart::subtotal();
	}

	public function count()
	{
		return Cart::count();
	}
}