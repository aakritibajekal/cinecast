<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Profile;
use App\User;
use App\Comment;
use App\Follower;


class PostController extends Controller 
{
  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        if ( $user = Auth::user() ) 
        {
            $profile = Profile::where("user_id", "=", $user->id)->firstOrFail(); 
          
            $follower = Follower::where("follower_id", "=", $profile->id)->find('followed');

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
            
            $post = Post::where("profile_id", "=", $profile->id)->first();   

        return view('posts.index', compact('posts', 'profile', 'follower')  );

        }  else 

            $posts = Post::all();
           
            return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ( $user ) // we are logged in and can create posts
            return view('posts.create');
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
            'content' => 'required|max:255',
           
        ));
        $profile = Profile::where("user_id", "=", $user->id)->firstOrFail();

        $post = new Post();
        $post->profile_id = $profile->id;
        $post->content = $validatedData['content'];
        $post->picture = 'picture';
        $post->save();
        
    
         return redirect('/posts')->with('success', 'Post saved.');
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
        $post = Post::findOrFail($id);

        $profile = Profile::findOrFail($post->profile_id);

        return view( 'posts.show', compact('post', 'profile') );

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
            
            $post = Post::findOrFail($id);

            return view( 'posts.edit', compact('post') );
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
                'content' => 'required|max:255',
             ));
    
             Post::whereId($id)->update($validatedData);

             return redirect('/posts')->with('success', 'Post updated.');
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
            $post = Post::findOrFail($id);
    
            $post->delete();
    
            return redirect('/posts')->with('success', 'Post deleted.');
        }
        return redirect('/posts');
    }

    public function showProfile($id)
    {
        $profiles = Profile::query( )
        ->join( 'profiles', 'posts.profile_id', '=', 'profiles.id' ) // faster to do both queries together
        ->get(); // we want them all because we are looping through them in our show

    }

    }

