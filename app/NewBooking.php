<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class NewBooking extends Model
{
  protected $fillable = [
    'user_id', 'pro_type', 'looking_to_shoot', 'event_address', 'street_number', 'route', 'locality', 'area', 'postal_code', 'country', 'address_details',
    'duration_', 'hours_', 'event_date', 'start_time', 'time_zone', 'done_hiring'
  ];
  public function user(){
    $this->belongsTo(User::class);
  }
}
