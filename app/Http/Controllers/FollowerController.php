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
   
    public function followProfile(int $id)
    {
        if ( $user = Auth::user() ) 
        {
            $profile = Profile::where("user_id", "=", $user->id)->firstOrFail();

            $follower = New Follower;
            $follower->profile_id = $id;
            $follower->follower_id = $profile->id;
            $follower->followed = 1;
            $follower->save();

            return redirect('/posts')->with('success', 'Started following Profile.');
        }
        if(! $user) {
    
            return redirect('/posts');
        }
    }

    public function UnfollowProfile($id)
    {
        if ( $user = Auth::user() ) 
        {

        $profile = Profile::where("user_id", "=", $user->id)->firstOrFail();

        $follower = Follower::where( 'profile_id', '=', $id )
                    ->where('follower_id', $profile->id)
                    ->delete();

    
                    return redirect('/posts')->with('success', 'Stopped following Profile.');
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