<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'date', 'paid'];

    public function details()
    {
    	return $this->hasMany(OrderDetails::class);
    }
}
