<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contactMessage extends Model
{
    //
    protected $fillable = [
        'name', 'email','subject','comment'
    ];
}
