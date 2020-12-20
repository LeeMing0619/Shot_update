<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewHire extends Model
{
    //
    public function user(){
        $this->belongsTo(User::class);
    }
    
    protected $guarded = [];
}
