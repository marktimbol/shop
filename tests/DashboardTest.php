<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DashboardTest extends TestCase
{
	use DatabaseMigrations;

	public function test_unauthenticated_users_cannot_access_dashboard_page()
	{
		$this->visit('/dashboard')
			->seePageIs('/login');
	}

    public function test_it_displays_the_users_dashboard_page()
    {
    	$user = factory(App\User::class)->create();
    	$this->actingAs($user);

    	$this->visit('/dashboard')
    		->see("Hello, {$user->name}");
    }
}
