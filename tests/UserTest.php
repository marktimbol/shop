<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserTest extends TestCase
{
	use DatabaseMigrations;

    public function test_it_returns_the_users_latest_orders()
    {
    	$user = factory(App\User::class)->create();
    	$this->actingAs($user);

    	$this->newOrderFor($user);
    	$this->newOrderFor($user);
    	$this->newOrderFor($user);

    	$userOrders = $user->orders;
    	$userLatestOrders = $user->latestOrders();

    	$this->assertEquals($userLatestOrders, $userOrders);
    }

    protected function newOrderFor(User $user)
    {
        $order = factory(App\Order::class)->create([
            'user_id'   => $user->id,
            'date'  => Carbon::now(),
            'paid'  => false,
        ]);

        $item = factory(App\Item::class)->create();

        $order->details()->create([
            'item_id'   => $item->id,
            'quantity'  => 1,
            'subtotal'  => $item->price
        ]);

        return $order;
    }
}
