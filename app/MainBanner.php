<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainBanner extends Model
{
    protected $table = "main_banners";
    protected $fillable = [
    	
    	'title','content','image'
    ];
}
