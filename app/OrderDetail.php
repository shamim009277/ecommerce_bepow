<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "order_details";

    protected $fillable = [
        'order_id','user_id','shipping_id','item_name','image','price','quantity','status'
    ];
}
