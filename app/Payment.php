<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "payments";

    protected $fillable = [
         'user_id','shipping_id','pay_id','transaction_id','payment_method','payment_type','card_number','currency', 'amount','payment_status','receipt_email','receipt_url','postal_code','status'
    ];
}
