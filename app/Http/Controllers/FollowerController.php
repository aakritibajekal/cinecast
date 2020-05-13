<?php

namespace App\Http\Controllers;

use App\Follower;
use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Profile;
use App\User;
use App\Comment;

class FollowerController extends Controller
{
   
    public function followUser(int $id)
    {
        if ( $user = Auth::user() ) 
        {
            $follower = New Follower;
            $follower->user_id = $id;
            $follower->follower_id = $user->id;
            $follower->followed = 1;
            $follower->save();

            return redirect('/posts')->with('success', 'Started following User.');
        }
        if(! $user) {
    
            return redirect('/posts');
        }
    }

    public function UnfollowUser($id)
    {
        if ( $user = Auth::user() ) 
        {

        
        $follower = Follower::where( 'user_id', '=', $id )
                    ->where('follower_id', $user->id)
                    ->delete();

    
                    return redirect('/posts')->with('success', 'Stopped following User.');
        }           
    }

    public function Following($id)
    {
        if ( $user = Auth::user() ) 
        {
            $following = Follower::where('followed', '=', 1);
        }
    }

}