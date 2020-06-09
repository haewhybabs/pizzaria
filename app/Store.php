<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Store extends Model
{
    //
    protected $fillable = [
        'name', 'latitude', 'longitude','address','street','city','state','zip_code','county','phone','url','country','companyID','status'
    ];

     protected $appends = ['company_logo'];

    public function getCompanyLogoAttribute(){
      if($this->company && $this->company->logo){
          return (filter_var($this->company->logo, FILTER_VALIDATE_URL))?$this->company->logo:url('/adminAssets/franchiseLogo/'.rawurlencode($this->company->logo));
        }
        return '';
    }

    public function schedule(){
    	return $this->hasOne(\App\schedule::class,'store_id','id');
    }
   	public function company(){
   		return $this->belongsTo(\App\Franchise::class,'companyID','id');
   	}

    public function products(){
      return $this->hasMany(\App\Product::class,'storeID','id');
    }
    public function Activeproducts(){
      return $this->hasMany(\App\Product::class,'storeID','id')->whereRaw('CAST(end_time AS DATE)>=?',[$today])->whereRaw('CAST(start_time AS DATE)<=?',[$today]);
      
    }
    public function userProducts(){
      $pref = auth()->user()->preference;
      return $this->hasMany(\App\Product::class,'storeID','id')->where('type',$pref);
    }
    public function owner()
    {
       return $this->hasOne(\App\storeUser::class,'store_id','id');
    }
}
