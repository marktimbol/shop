<?php

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ItemsTest extends TestCase
{
	use DatabaseMigrations;

    public function test_it_displays_the_featured_items_on_the_homepage()
    {
    	$item = factory(App\Item::class)->create([
            'featured'  => false,
        ]);
        $featuredItem = factory(App\Item::class)->create([
            'featured'  => true
        ]);

    	$this->visit('/')
    		->see($featuredItem->name)
            ->dontSee($item->name);
    }

    public function test_it_displays_all_the_items_on_the_shop_page()
    {
    	$item = factory(App\Item::class)->create();
    	
    	$this->visit('/shop')
    		->see($item->name);
    }

    public function test_it_checks_whether_the_item_is_featured_or_no()
    {
        $item = factory(App\Item::class)->create([
            'featured'  => true
        ]);
        $notFeatured = factory(App\Item::class)->create([
            'featured'  => false
        ]);

        $featuredItems = App\Item::featured()->latest()->get();

        foreach( $featuredItems as $featuredItem ) {
            $this->assertEquals($item->name, $featuredItem->name);
            $this->assertNotEquals($notFeatured->name, $featuredItem->name);
        }
    }

    public function test_it_checks_whether_the_item_is_on_sale_or_no()
    {
        // On Sale
        $item = factory(App\Item::class)->create([
            'price' => 90,
            'old_price' => 100
        ]);

        $result = $item->isOnSale();

        $this->assertTrue($result);

        // Not on-sale
        $item = factory(App\Item::class)->create([
            'price' => 120,
            'old_price' => 100
        ]);

        $result = $item->isOnSale();

        $this->assertFalse($result);
    }

    public function test_it_checks_whether_the_item_is_new_or_no()
    {
        // Item is new
        $item = factory(App\Item::class)->create();
        $result = $item->isNew();

        $this->assertTrue($result);

        // Item is old
        $item = factory(App\Item::class)->create([
            'updated_at'    => Carbon::now()->subDays(10)
        ]);
        $result = $item->isNew();

        $this->assertFalse($result);
    }

    public function test_it_calculates_and_displays_the_discount_percentage_of_the_given_item()
    {
        $item = factory(App\Item::class)->create([
            'price' => 90,
            'old_price' => 100,
            'featured'  => true,
        ]);
        
        $discountPercentage = $item->getDiscountPercentage();

        $this->assertEquals('-10', $discountPercentage);
        $this->visit('/')
            ->see('-10%');
    }
}
