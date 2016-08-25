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

    public function test_it_displays_all_the_items_on_the_shop_page()
    {
    	$item = factory(App\Item::class)->create();
    	
    	$this->visit('/shop')
    		->see($item->name);
    }

    public function TODO_test_it_filters_the_items_per_brand()
    {
        $brand = factory(App\Brand::class)->create([
            'name'  => 'Apple'
        ]);
        $item = factory(App\Item::class)->create([
            'brand_id'  => $brand->id
        ]);

        $brand->items()->save($item);

        // $samsungItem = factory(App\Item::class)->create();
        // $samsung = factory(App\Brand::class)->create([
        //     'name'  => 'Samsung'
        // ]);
        // $samsung->items()->save($samsungItem);

        $this->visit('/shop')
            ->check('brand')
            ->press('Filter')

            ->see($item->name);
            // ->dontSee($samsungItem->name);
    }
}
