<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $table = "promo_codes";
    protected $fillable = [
        
        'product_id','name','code','type','value','status'
    ];

    public function product(){

    	return $this->belongsTo('App\ProductItem');
    }
}
