<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function actOnPost(Request $request, $id)
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
        broadcast(new PostAction($id, $action))->toOthers();
        return '';
    }
    public function likePost($id)
    {
        $this->handleLike('App\Post', $id);
        return redirect()->back();
    }
    public function likeComment($id)
    {
        $this->handleLike('App\Comment', $id);
        return redirect()->back();
    }
    public function handleLike($type, $id)
    {
        $existing_like = Like::withTrashed()->whereLikeableType($type)->whereLikesId($id)->where("profile_id", "=", $profile->id)->firstOrFail();
        if (is_null($existing_like)) {
            Like::create([
                'profile_id' => Profile::id(),
                'likes_id'   => $id,
                'likeable_type' => $type,
            ]);
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
            } else {
                $existing_like->restore();
            }
        }
    */
}
    }
