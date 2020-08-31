<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeatureTitle extends Model
{
    protected $table = "feature_titles";
    protected $fillable = [
    	
    	'title','image','status'
    ];
    public function overviews(){

    	return $this->hasMany('App\FeatureOverview', 'feature_id');
    }
}
