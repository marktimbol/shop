<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = ['item_id', 'quantity', 'subtotal'];
}
