<?php

use App\ShoppingCart\ShoppingCart;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CheckoutTest extends TestCase
{
	use DatabaseMigrations;

	protected $cart;

	public function setUp()
	{
		$this->cart = new ShoppingCart;
		parent::setUp();
	}

    public function test_it_displays_the_checkout_page()
    {
    	$this->visit('/checkout')
    		->see('Checkout');
    }

    public function test_it_shows_empty_cart_when_visiting_checkout_without_items_on_the_cart()
    {
    	$this->visit('/checkout')
    		->see('Shopping cart is empty.');
    }

    public function test_it_shows_all_the_items_in_the_cart_during_checkout()
    {
    	$item = factory(App\Item::class)->create();
    	$this->cart->store($item);

    	$this->visit('checkout')
    		->see($item->name);
    }

    public function test_it_accepts_a_cash_on_delivery()
    {
    	$item = factory(App\Item::class)->create();
    	$this->cart->store($item);

    	$this->visit('/checkout')
			->type('mark.timbol@hotmail.com', 'email')
			->type('Mark Timbol', 'name')
			->type('0097144519562', 'phone')
			->type('Dubai', 'address')
			->type('Dubai', 'city')
			->type('Dubai', 'state')
			->type('UAE', 'country')
			->type('password123', 'password')
			->type('password123', 'password_confirmation')
			->select('cash', 'payment')
			->check('terms')
			->press('Place order')

			->seeInDatabase('orders', [
				'id'	=> 1,
				'user_id'	=> 1,
				'date'	=> Carbon::now(),
				'paid'	=> false
			])

			->seeInDatabase('order_details', [
				'order_id'	=> 1,
				'item_id'	=> $item->id,
				'quantity'	=> 1,
				'subtotal'		=> $this->cart->subtotal(),
			]);

			// ->assertRedirectedToRoute('checkout.success');
    }

}
