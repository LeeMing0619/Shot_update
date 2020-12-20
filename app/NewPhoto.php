<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class NewPhoto extends Model
{
    public function user(){
      $this->belongsTo(User::class);
    }
    protected $guarded = [];
}
