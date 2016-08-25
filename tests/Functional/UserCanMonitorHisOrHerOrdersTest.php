<?php

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserCanMonitorHisOrHerOrdersTest extends TestCase
{
	use DatabaseMigrations;

	public function test_an_unauthenticated_user_cannot_access_the_orders_page()
	{
		$this->visit('/dashboard/orders')
			->seePageIs('/login');
	}

    public function test_a_user_can_view_all_of_his_or_her_orders()
    {
        $item = factory(App\Item::class)->create();
        $this->userOrdersThis($item);

        $this->visit('/dashboard/orders')
        	->see('Your orders')
        	->see('Not paid');
    }

 	public function test_a_user_can_view_his_or_her_order_details()
 	{
        $item = factory(App\Item::class)->create([
            'name'  => 'Rolex',
            'price' => 99,
        ]);
        $order = $this->userOrdersThis($item);

        $this->visit('/dashboard/orders/'.$order->id)
        	->see('Order details')
        	->see('Rolex')
        	->see('Total: AED 99');
 	}

    protected function userOrdersThis($item)
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);

        $order = factory(App\Order::class)->create([
            'user_id'   => $user->id,
            'date'  => Carbon::now(),
            'paid'  => false,
        ]);

        $order->details()->create([
            'item_id'   => $item->id,
            'quantity'  => 1,
            'subtotal'  => 99
        ]);

        return $order;
    }

}
