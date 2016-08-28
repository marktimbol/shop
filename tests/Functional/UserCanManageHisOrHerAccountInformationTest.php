<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCanManageHisOrHerAccountInformationTest extends TestCase
{
	use DatabaseMigrations;

    public function test_it_redirects_to_login_page_if_unauthenticated_user_is_trying_to_access_dashboard_account_edit_page()
    {
    	$this->visit('/dashboard/account/edit')
    		->seePageIs('/login');
    }

    public function test_it_shows_edit_account_information_page()
    {
    	$user = factory(App\User::class)->create();
    	$this->actingAs($user);

    	$this->visit('/dashboard/account/edit')
    		->see('Edit account information');
    }

    public function test_it_updates_the_name_and_email_on_the_users_table()
    {
    	$user = factory(App\User::class)->create();
    	$this->actingAs($user);

    	$this->visit('/dashboard/account/edit')
    		->type('Mark Jayson Turla Timbol', 'name')
    		->press('Save')

    		->seeInDatabase('users', [
    			'id'	=> $user->id,
    			'email'	=> $user->email,
    			'name'	=> 'Mark Jayson Turla Timbol',
    		]);
    }

    public function test_it_shows_an_error_message_when_the_required_fields_are_empty()
    {
    	$user = factory(App\User::class)->create();
    	$this->actingAs($user);

    	$this->visit('/dashboard/account/edit')
    		->type('', 'name')
    		->press('Save')
    		->see('The name field is required.');
    }

}
