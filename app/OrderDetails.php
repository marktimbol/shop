<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = ['item_id', 'quantity', 'subtotal'];

    protected $with = ['item'];

    public function item()
    {
    	return $this->belongsTo(Item::class);
    }
}
