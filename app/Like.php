<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
   
    protected $fillable = ['likes_id', 'likeable_type', 'user_id']; 
    

    public function users()
    {
        return $this->belongsTo(User::class);
    }

   

    protected $table = 'likes';
    
    public function posts()
    {
        return $this->morphedByMany('App\Post', 'likes');
    }

    public function comments()
    {
        return $this->belongsTo('App\Like');
    }
    
}
