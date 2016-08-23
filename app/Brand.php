<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'slug'];

    public function items()
    {
    	return $this->hasMany(Item::class);
    }
}
