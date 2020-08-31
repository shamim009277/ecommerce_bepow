<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    
    protected $table="refunds";
    protected $fillable = [

       'order_id','transaction_id','payment_transaction_id','reason','amount','currency','status'
    ];
}
