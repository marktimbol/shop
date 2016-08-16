<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PagesTest extends TestCase
{
	use DatabaseMigrations;
	
    public function test_it_displays_the_homepage()
    {
    	$this->visit('/')
    		->see('Shop');
    }
}
