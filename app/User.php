<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    const VERIFIED_USER='1';
    const UNVERIFIED_USER='0';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'leader_name',
        'domain_name',
        'organisation',
        'email',
        'password',
        'verified',
        'verificationtoken'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
         'remember_token',
      //   'verificationtoken'
    ];

    public static function getverificationtoken()
    {
        return str_random(40);
    }

    public function events(){
        return $this->hasMany('App\Event');
    }
}
