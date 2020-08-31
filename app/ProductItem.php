<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
	protected $table = "product_items";
	protected $fillable = [
        'item_name','overview','price','rating','status'
	];
    public function images(){
         
         return $this->hasMany('App\ProductImage', 'product_id');
    }

    public function codes(){

    	return $this->hasMany('App\PromoCode', 'product_id');
    }
}
