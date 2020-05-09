<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Profile;
use App\User;
use App\Comment;
use App\Follower;


class ProfileController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::query( )
        ->join( 'users', 'profiles.user_id', '=', 'users.id' ) // faster to do both queries together
        ->get(); // we want them all because we are looping through them in our index

        $posts = Post::all();
       
        $profile = Profile::find($profile_id);
       

    return view('profiles.index', compact('profiles', 'posts' , 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ( $user ) // we are logged in and can create a profile
            return view('profiles.create');
        else // not logged in, can not make posts. redirect to index
            return redirect('/posts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ( $user = Auth::user() ) //only store data if user is logged in. 
        {

        $validatedData = $request->validate(array( 
            'username' => 'required|max:25',
            'bio' => 'max:255'
           

        ));
        $user = Auth::user();

        $profile = Profile::where("user_id", "=", $user->id)->firstOrFail();

        $profile->user_id = $user->id;
        $profile->username = $validatedData['username'];
        $profile->bio = $validatedData['bio'];
        $profile->picture = 'picture';
        $profile->save();
        
    
         return redirect('/posts')->with('success', 'Profile saved.');
        }// redirect by default
         return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::findOrFail($id);

        $post = Post::findOrFail($id);

        $posts = Post::query( )
            ->join( 'profiles', 'posts.profile_id', '=', 'profiles.id' )
            ->select( 'posts.id',
            'profiles.id as profile_ID',
            'profiles.username',
            'profiles.bio',
            'profiles.picture',
            'posts.posted_at',
            'posts.posted_at',
            'posts.content',
            'posts.picture',
            'posts.likes_count',  )
            ->orderBy('posts.id', 'desc')
            ->get(); 

        return view ('profiles.show', compact('profile', 'post', 'posts') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ( $user = Auth::user() ) {

            $profile = profile::findOrFail($id);


            return view( 'profiles.edit', compact('profile') );
        }
        return redirect('/posts');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ( $user = Auth::user() ) {
            $validatedData = $request->validate(array( 
                'username' => 'required|max:25',
                'bio' => 'max:255',
             ));
    
             Profile::whereId($id)->update($validatedData);
             return redirect('/posts')->with('success', 'Profile updated.');
            }
            return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( $user = Auth::user() ) {
            $profile = Profile::findOrFail($id);
    
            $profile->delete();
    
            return redirect('/posts')->with('success', 'Profile deleted.');
        }
        return redirect('/posts');
    }

    public function showPost($id)
    {
        $posts = Post::query( )
        ->join( 'posts', 'posts.profile_id', '=', 'profiles.id' ) // faster to do both queries together
        ->get(); // we want them all because we are looping through them in our show

    }

    public function getUserByUsername($username)
    {
        return User::with('profile')->wherename($username)->firstOrFail();
    }

    
    public function followProfile($id)
    {
        $follow = New Follower;
        $follow->profile_id = profile()->id;
        $follow->follower_id = $id;
        $follow->followed = 1;
        $follow->save();

        return redirect()->back();

    }

    public function UnfollowProfile($id)
    {
        $follow = Follower::where('profile_id', profile()->id)
                    ->where('follower_id', $id)
                    ->delete();

                    return redirect()->back();
    }

    

    

}

