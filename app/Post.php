<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model 
{
    use SoftDeletes;

    public $timestamps = false;

    protected $guarded = [];

    protected $dates = ['deleted_at'];
    //
    protected $fillable = array(  
        'content',
        'picture',
        'likes_count',
        'comments_count',
        'posted_at'
    );

    public function users()
    {
        return $this->belongsTo( 'App\User' );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function likes()
    {
        return $this->morphToMany('App\User', 'likes')->whereDeletedAt(null);
    }

    public function getIsLikedAttribute()
    {
        $like = $this->likes()->whereUserId(User::id())->first();
        return (!is_null($like)) ? true : false;
    }

    public function author()
        {
            return $this->belongsTo(User::class, 'user_id', 'id');
        }

}
