<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    public function user(){
        $this->belongsTo(User::class);
    }
    
    protected $guarded = [];
}
