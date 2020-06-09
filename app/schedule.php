<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    //
    protected $fillable = [
       'store_id','time',
    ];
    public $timestamps = false;
    // public function time(){

    // 	return $this->belongsTo(\App\Store::class);

    // }
}
