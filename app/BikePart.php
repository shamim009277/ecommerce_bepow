<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BikePart extends Model
{
    protected $table = "bike_parts";
    
    protected $fillable = [
         'title','image','short_description','status'
    ];
}
