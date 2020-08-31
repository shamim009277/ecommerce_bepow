<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shipping extends Model
{
    protected $table = "shippings";

    protected $fillable = [
        
        'first_name','last_name','company_name','country','address1','address2','city','state','zip','phone',	'email','message','type'	
    ];

}
