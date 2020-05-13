<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\User;
use App\Comment;
use App\Profile;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            return view('comments.create');
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

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        $input['post_id'] = $request->input('post_id');

        if ( isset($input['is_gif']  ) && ($input['is_gif'] === 'true') ) {

            $input['is_gif'] = 1;

        }

        Comment::create($input);



         return redirect('/posts')->with('success', 'Comment saved.');
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
        $comment = Comment::findOrFail($id);

        $post = Post::findOrFail($id);

        $user = User::findOrFail($post->user_id);


        return view( 'comments.show', compact('comment') );
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

            $comment = Comment::findOrFail($id);

            $profile = Profile::where("user_id", "=", $user->id)->firstOrFail(); 

            if ( isset($comment->is_gif ) && ($comment->is_gif === 'true') ) {
         
                $comment->is_gif = 1;
                
            }

            return view( 'comments.edit', compact('comment') );
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
    
             Comment::whereId($id)->update($validatedData);

             return redirect('/posts')->with('success', 'Comment updated.');
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
            $comment = Comment::findOrFail($id);
    
            $comment->delete();
    
            return redirect('/posts')->with('success', 'Comment deleted.');
        }
        return redirect('/posts');
    }
}
