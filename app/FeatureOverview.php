<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeatureOverview extends Model
{
    protected $table = "feature_overviews";
    protected $fillable = [

    	'feature_id','overview','status'
    ];

    public function feature(){

    	return $this->belongsTo('App\FeatureTitle');
    }
}
