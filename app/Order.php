<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'date', 'paid'];
    protected $with = ['user', 'details'];
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function details()
    {
    	return $this->hasMany(OrderDetails::class);
    }
}
