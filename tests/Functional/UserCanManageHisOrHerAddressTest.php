<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCanManageHisOrHerAddressTest extends TestCase
{
	use DatabaseMigrations;

    public function test_an_unauthenticated_user_cannot_access_dashboard()
    {
    	$this->visit('/dashboard')
    		->seePageIs('/login');
    }

    public function test_an_authenticated_user_can_update_his_or_her_address_book()
    {
    	$user = factory(App\User::class)->create([
    		'name'	=> 'John Doe'
    	]);
    	$this->actingAs($user);

    	$this->visit('/dashboard/address/edit')
    		->see($user->name)
    		->see('Update address')
    		->type('John Doe Jr.', 'name')
			->type('0097144519562', 'phone')
			->type('Dubai', 'address')
			->type('Dubai', 'city')
			->type('Dubai', 'state')
			->type('United Arab Emirates', 'country')
			->press('Save')

			->seeInDatabase('users', [
				'id'	=> $user->id,
				'email'	=> $user->email,
				'name'	=> 'John Doe Jr.',
				'phone'	=> '0097144519562',
				'address'	=> 'Dubai',
				'city'	=> 'Dubai',
				'state'	=> 'Dubai',
				'country'	=> 'United Arab Emirates'
			]);
    }

    public function test_an_authenticated_user_cannot_update_his_or_her_address_book_without_filling_up_the_required_fields()
    {
    	$user = factory(App\User::class)->create();
    	$this->actingAs($user);

    	$this->visit('/dashboard/address/edit')
    		->type('', 'name')
    		->type('', 'phone')
    		->type('', 'address')
    		->type('', 'city')
    		->type('', 'state')
    		->type('', 'country')
    		->press('Save')

    		->see('The name field is required')
    		->see('The phone field is required')
    		->see('The address field is required')
    		->see('The city field is required')
    		->see('The state field is required')
    		->see('The country field is required');
    }
}
