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
}
