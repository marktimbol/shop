<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ItemsTest extends TestCase
{
	use DatabaseMigrations;

    public function test_it_displays_items_on_the_homepage()
    {
    	$item = factory(App\Item::class)->create();

    	$this->visit('/')
    		->see($item->name);
    }
}
