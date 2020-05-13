<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Profile extends Model 
{
   
    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo( 'App\User' );
    }

    
    protected $fillable = [
        'username', 'user_id', 'bio', 'profile_pic'
    ];
}
