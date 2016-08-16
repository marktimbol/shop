<?php

use App\ShoppingCart\ShoppingCart;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CartTest extends TestCase
{
	use DatabaseMigrations;

	protected $cart;

	public function setUp()
	{
	    $this->cart = new ShoppingCart;
	    parent::setUp();
	}

    public function test_it_adds_an_item_on_the_cart()
    {
    	$item = factory(App\Item::class)->create();
    	$this->visit('/items/'.$item->slug)
    		->press('Add to cart')
            ->assertEquals(1, $this->cart->count());
    }

    public function test_it_displays_the_items_in_cart()
    {
    	$item = factory(App\Item::class)->create();
    	$this->cart->store($item);

    	$this->visit('/cart')
  			->see($item->name);
    }
}
