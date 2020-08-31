<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oreder extends Model
{
    protected $table = "oreders";

    protected $fillable = [
          'shipping_id','user_id','payment_id','quantity','total','subtotal','shipping_cost','status'
    ];

 
    
}
