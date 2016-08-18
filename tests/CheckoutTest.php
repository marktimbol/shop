<?php

use App\Events\UserPlacedAnOrder;
use App\ShoppingCart\ShoppingCart;
use Carbon\Carbon;
use MailThief\Facades\MailThief;
use MailThief\Testing\InteractsWithMail;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CheckoutTest extends TestCase
{
	use DatabaseMigrations, InteractsWithMail;

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

    	$this->visit('/checkout');
    	$this->fillupBillingForm();
		$this->select('cash', 'payment')
			->press('Place order');

		$this->seeInDatabase('orders', [
			'id'	=> 1,
			'user_id'	=> 1,
			'date'	=> Carbon::now(),
			'paid'	=> false
		])

		->seeInDatabase('order_details', [
			'order_id'	=> 1,
			'item_id'	=> $item->id,
			'quantity'	=> 1,
			'subtotal'	=> $this->cart->subtotal(),
		]);
    }

    public function test_it_accepts_credit_card_payment()
    {
    	$item = factory(App\Item::class)->create();
    	$this->cart->store($item);

    	$this->visit('/checkout');
    	$this->fillupBillingForm();
    	$this->select('card', 'payment');
    	$this->fillUpCreditCardForm();
 		$this->press('Place order');
    }

    protected function fillupBillingForm()
    {
    	$this->type('mark.timbol@hotmail.com', 'email')
			->type('Mark Timbol', 'name')
			->type('0097144519562', 'phone')
			->type('Dubai', 'address')
			->type('Dubai', 'city')
			->type('Dubai', 'state')
			->type('UAE', 'country')
			->type('password123', 'password')
			->type('password123', 'password_confirmation')
			->check('terms');
    }

    protected function fillUpCreditCardForm()
    {
    	$this->type('Mark Jayson Timbol', 'card_name')
    		->type('4242424242424242', 'card_number')
    		->type('01', 'card_expiry_month')
    		->type('2020', 'card_expiry_year')
    		->type('123', 'card_cvc');
    }

    // TODO
    public function a_test_it_sends_an_email_to_user_once_the_order_has_been_placed()
    {
    	$this->expectsEvents(UserPlacedAnOrder::class);

    	$item = factory(App\Item::class)->create();
    	$this->cart->store($item);

    	$this->fillupBillingForm();

		$this->seeMessageFor('mark.timbol@hotmail.com');
		$this->seeMessageWithSubject('Your order details');
		$this->assertTrue(MailThief::lastMessage()->contains('Your order details.'));
    }

}
