<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Profile;
use App\User;
use App\Comment;

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
        if ( $user ) 
            return view('comments.create');
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
            'content' => 'required|max:360',
           
        ));

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
     
        if ( isset($input['is_gif']  ) && ($input['is_gif'] === 'true') ) {
         
            $input['is_gif'] = 1;
            
        }

        Comment::create($input);
   
    
       
         return redirect('/posts')->with('success', 'You commented is saved.');
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
        $comment = Comment::findOrFail($id);

        $post = Post::findOrFail($id);

        $profile = Profile::findOrFail($post->profile_id);


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
                'content' => 'required|max:360',
             ));
    
             Comment::whereId($id)->update($validatedData);
             
             return redirect('/posts')->with('success', 'Your comment is updated.');
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
    
            return redirect('/posts')->with('success', 'Your comment is deleted.');
        }
        return redirect('/posts');
    }
}
