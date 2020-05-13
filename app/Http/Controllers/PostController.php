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

            $comments_count = Post::count("comments_count");
          
            $follower = Follower::where("follower_id", "=", $user->id)->find('followed');

            $posts = Post::query( )
            ->join( 'users', 'posts.user_id', '=', 'users.id' )
            ->select( 'posts.id',
            'users.id as user_id',
            'users.name',
            'posts.posted_at',
            'posts.posted_at',
            'posts.content',
            'posts.picture',
            'posts.likes_count',
            'posts.comments_count',  )
            ->orderBy('posts.id', 'desc')
            ->simplePaginate(10);
            
            $post = Post::where("user_id", "=", $user->id)->first();   

        return view('posts.index', compact('posts', 'post', 'follower', 'comments_count', 'profile', 'user')  );

        }  else 

            $posts = Post::query()
                ->join( 'users', 'posts.user_id', '=', 'users.id' )
                ->select( 'posts.id',
                'users.id as user_id',
                'users.name',
                'posts.posted_at',
                'posts.posted_at',
                'posts.content',
                'posts.picture',
                'posts.likes_count',
                'posts.comments_count',  )
                ->orderBy('posts.id', 'desc')
                ->get();

          
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
        if ( $user ) 
            return view('posts.create');
        else 
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
        if ( $user = Auth::user() ) 
        {

        $validatedData = $request->validate(array( 
            'content' => 'required|max:255',
           
        ));
        $post = new Post();
        $post->user_id = $user->id;
        $post->content = $validatedData['content'];
        $post->picture = 'picture';
        $post->save();
        
    
         return redirect('/posts')->with('success', 'Post saved.');
        }
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

        $comment = new Comment();

        $user = User::findOrFail($post->user_id);

        $profile = Profile::where("user_id", "=", $user->id)->firstOrFail(); 

        return view( 'posts.show', compact('post', 'comment', 'profile', 'user') );

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

    public function getlike(Request $request)
    {
        $post = Post::find($request->post);
        return response()->json([
            'post' => $post,
        ]);
    }

    public function like(Request $request)
    {
        $post = Post::find($request->post);
        $value = $post->like;
        $post->like = $value + 1;
        $post->save();
        return response()->json([
            'message' => 'Thanks',
        ]);
    }

    }

