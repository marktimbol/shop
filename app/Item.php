<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	protected $fillable = ['brand_id', 'name', 'slug', 'price'];
	protected $with = ['brand'];

	public function getRouteKeyName() { return 'slug'; }

	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}

	public function isNew()
	{
		$daysOldToBeConsideredAsNew = 7;
		$daysOld = $this->updated_at->subDays(7)->diffInDays();

		return $daysOld <= $daysOldToBeConsideredAsNew ? true : false;
	}

	public function isOnSale()
	{
		return $this->price < $this->old_price;
	}

	public function getDiscountPercentage()
	{
		$percentage = ($this->old_price - $this->price) / $this->old_price;
		return -round($percentage * 100);
	}
}
