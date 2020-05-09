<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'post_id', 'parent_id', 'content', 'is_gif'];

    public function users()
    {
        return $this->belongsTo( 'App\User' );
    }

    public function posts()
    {
        return $this->belongsTo( 'App\Post' );
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    
}
