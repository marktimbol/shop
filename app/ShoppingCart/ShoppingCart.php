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

	public function store(Item $item, $quantity = null)
	{
		Cart::add($item->id, $item->name, $quantity ?: 1, $item->price, [
			'item' => $item
		]);
	}

	public function destroy()
	{
		Cart::destroy();
	}

	public function subtotal()
	{
		return Cart::subtotal();
		// return Cart::subtotal($decimals, $decimalSeperator, $thousandSeperator);
	}

	public function count()
	{
		return Cart::count();
	}
}