<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\ProPackage;
use App\ProSchedule;
use App\NewPhoto;
use App\AcceptedJOB;
use App\NewBooking;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'account_type',
        'pro_type',
        'phone_number',
        'receive_text',
        'moto',
        'business_adress',
        'street_number',
        'route',
        'locality',
        'area',
        'postal_code',
        'country',
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

    public function packages(){
      $this->hasMany(ProPackage::class);
    }
    public function schedules(){
      $this->hasMany(ProSchedule::class);
    }
    public function newphotos(){
      $this->hasMany(NewPhoto::class);
    }
    public function acceptedjobs(){
      $this->hasMany(AcceptedJOB::class);
    }
    public function newbookings(){
      $this->hasMany(NewBooking::class);
    }
}
