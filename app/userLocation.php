<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userLocation extends Model
{
    //
    protected $fillable = [
       'userid','type','latitude','	longitude'
    ];
    
}
