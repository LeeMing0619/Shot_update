<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ProSchedule extends Model
{
    protected $fillable = [
      'user_id', 'payment_method', 'deposit', 'refundable', 'days'
    ];
    public function user(){
      $this->belongsTo(User::class);
    }
}
