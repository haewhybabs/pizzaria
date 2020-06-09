<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class storeUser extends Model
{
    //
     protected $fillable = [
        'name', 'email','store_id',
    ];
    
}
