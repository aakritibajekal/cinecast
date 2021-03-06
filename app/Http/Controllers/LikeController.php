<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use App\Post;
use App\User;

class LikeController extends Controller
{
    public function Like ( $id )
    {
        $post = Post::findOrFail( $id );
        $post->save();
        return $post;
    }

    public function unlike ( $id )
    {
        $post = Post::findOrFail( $id );
        $post->save();
        return $post;
    }

    public function toggleLike(Request $request, $id)
    {
        $action = $request->get('action');
        switch ($action) {
            case 'Like':
                Post::where('id', $id)->increment('likes_count');
                break;
            case 'Unlike':
                Post::where('id', $id)->decrement('likes_count');
                break;
        }
        
        return '';
    }
}
