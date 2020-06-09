<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\pizzaResetPassword;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','address','phone','city','state','country','imgname','preference','code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute(){
        if($this->imgname){
            return (filter_var($this->imgname, FILTER_VALIDATE_URL))?$this->imgname:url('/userAssets/userImage/'.rawurlencode($this->imgname));
        }
        return '';
    }
    public function location(){
      return $this->hasOne(\App\userLocation::class,'userid','id')->latest();
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new pizzaResetPassword($token,$this->email));
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

}
