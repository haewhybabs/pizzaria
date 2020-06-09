<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name','companyID','storeID','type','price','topping','pizzaImage',
    ];


    public function store(){
    	return $this->belongsTo(\App\Store::class,'storeID','id');
    }
    public function category(){
    	return $this->belongsTo(\App\PizzaCategory::class,'type','id');
    }
    public function company(){
        return $this->belongsTo(\App\Franchise::class,'companyID','id');
    }
   
}
