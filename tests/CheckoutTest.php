<?php

use App\Events\UserPlacedAnOrder;
use App\Listeners\SendOrderDetailsToAdmin;
use App\Listeners\SendOrderDetailsToUser;
use App\Order;
use App\ShoppingCart\ShoppingCart;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use MailThief\Facades\MailThief;
use MailThief\Testing\InteractsWithMail;

class CheckoutTest extends TestCase
{
	use DatabaseMigrations, InteractsWithMail;

	protected $cart;

	public function setUp()
	{
		$this->cart = new ShoppingCart;
		parent::setUp();
	}

    public function test_it_redirects_to_cart_page_if_the_cart_it_empty_when_visiting_the_checkout_page()
    {
        $this->visit('/checkout');
        $this->seePageIs('/cart')
            ->see('Shopping cart is empty');
    }

    public function test_it_displays_the_checkout_page()
    {
        $item = factory(App\Item::class)->create();
        $this->cart->store($item);

    	$this->visit('/checkout')
    		->see('Checkout');
    }

    public function test_it_shows_all_the_items_in_the_cart_during_checkout()
    {
    	$item = factory(App\Item::class)->create();
    	$this->cart->store($item);

    	$this->visit('checkout')
    		->see($item->name);
    }

    public function test_it_displays_the_errors_if_we_did_not_fill_up_the_required_field()
    {
        $item = factory(App\Item::class)->create();
        $this->cart->store($item);

        $this->visit('/checkout')
            ->press('Place order');

        $this->see('The email field is required.')
            ->see('The name field is required.')
            ->see('The phone field is required.');
    }

    public function test_unauthenticated_users_are_required_to_fillup_the_checkout_form_when_placing_an_order()
    {
        $item = factory(App\Item::class)->create();
        $this->cart->store($item);

    	$this->visit('/checkout');
    	$this->fillupBillingForm();
        $this->select('cash', 'payment');
        $this->press('Place order');

		$this->seeInDatabase('orders', [
			'id'	=> 1,
			'user_id'	=> 1,
			'date'	=> Carbon::now(),
			'paid'	=> false
		]);

        foreach( $this->cart->all() as $item )
        {
    		$this->seeInDatabase('order_details', [
    			'order_id'	=> 1,
    			'item_id'	=> $item->id,
    			'quantity'	=> $item->qty,
    			'subtotal'	=> $item->subtotal
    		]);
        }

        // Flash message

        return redirect('/');

    }

    public function test_an_authenticated_user_does_not_need_to_fillup_the_checkout_form_to_place_an_order()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);

        $item = factory(App\Item::class)->create();
        $this->cart->store($item);

        $this->visit('/checkout')
            ->see($user->name)
            ->see($user->phone)
            ->see($user->address)
            ->see($user->city)
            ->see($user->state)
            ->see($user->country)
            ->dontSee('Email address')
            ->dontSee('Create your account')

            ->select('cash', 'payment')
            ->check('terms')
            ->press('Place order');
    }

    public function test_it_sends_an_email_to_user_with_his_or_her_order_details()
    {
        MailThief::hijack();

        $event = $this->userPlacedAnOrder();
        $sendToUser = new SendOrderDetailsToUser();        
        $sendToUser->handle($event);

        $this->seeMessageFor('mark.timbol@hotmail.com');
        $this->seeMessageWithSubject('Your order details');
        $this->assertTrue(MailThief::lastMessage()->contains('Total: AED 99.0'));
    }

    public function test_it_sends_an_email_to_admin_with_the_new_order_details()
    {
        MailThief::hijack();

        $event = $this->userPlacedAnOrder();
        $sendToAdmin = new SendOrderDetailsToAdmin();        
        $sendToAdmin->handle($event);

        $this->seeMessageFor('admin@marktimbol.com');
        $this->seeMessageWithSubject('New Order');
        $this->assertTrue(MailThief::lastMessage()->contains('Total: AED 99.0'));
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

    protected function submitBillingForm()
    {
        $this->post('/checkout', [
            'email' => 'mark.timbol@hotmail.com',
            'name'  => 'Mark Timbol',
            'phone' => '0097144519562',
            'address'   => 'Dubai',
            'city'  => 'Dubai',
            'state' => 'Dubai',
            'country'   => 'UAE',
            'password'  => 'password123',
            'password_confirmation' => 'password123',
            'payment'   => 'cash',
            'terms' => 1,
        ]);
    }

    protected function userPlacedAnOrder()
    {
        $user = factory(App\User::class)->create([
            'email' => 'mark.timbol@hotmail.com'
        ]);

        $order = factory(App\Order::class)->create([
            'user_id'   => $user->id,
            'date'  => Carbon::now(),
            'paid'  => false,
        ]);

        $item = factory(App\Item::class)->create([
            'price' => 99
        ]);

        $order->details()->create([
            'item_id'   => $item->id,
            'quantity'  => 1,
            'subtotal'  => 99
        ]);

        return new UserPlacedAnOrder($user, $order);
    }

}
