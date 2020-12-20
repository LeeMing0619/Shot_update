<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ProPackage extends Model
{
  protected $fillable = [
  'user_id', 'category', 'currency', 'price', 'details', 'equipment', 'lenses'
  ];
    public function user(){
      $this->belongsTo(User::class);
    }
}
