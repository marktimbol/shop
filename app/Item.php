<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	protected $fillable = ['brand_id', 'name', 'slug', 'price'];
	
	public function getRouteKeyName()
	{
		return 'slug';
	}

	public function scopeByBrand($query, $brand = [])
	{
		return $query;
	}
}
