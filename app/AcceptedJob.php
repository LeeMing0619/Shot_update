<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcceptedJob extends Model
{
    //
    public function user(){
        $this->belongsTo(User::class);
    }
    
    protected $guarded = [];
}
