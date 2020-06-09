<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PizzaCategory extends Model
{
    //
     protected $fillable = [
        'category', 'isActive',
    ];
}
