<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    //
     protected $fillable = [
        'name', 'description','logo',
    ];
    public function stores(){
    	return $this->hasMany(Store::class,'companyID','id');
    }
}
