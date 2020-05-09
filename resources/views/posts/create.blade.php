@foreach($comments as $comment)
<div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
    <strong>{{ $post->username }}</strong>

    <p>
    @if( $comment->is_gif == TRUE )
    <img src="{{ $comment->content }}">
    @else
    {{ $comment->content }}
    @endif
    </p>

    <a href="#" id="reply"></a>


    <div class="float-right" id="app" >
        <comment-create-form submission-url="{{route('comments.store')}}" post-id="{{ $post_id }}" comment-id="{{ $comment->id }}" v-model="content" > 
            @csrf
        </comment-create-form> 
        <Giphy v-on:image-clicked="imageClicked" /> 
    </div>

    <div class="form-group">
        <a href="{{ route('comments.edit', $comment->id) }}" post-id="{{ $post_id }}" comment-id="{{ $comment->id }}" class="btn btn-primary">Edit Comment</a>
    </div>

    <div class="form-group">
        <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger" type="submit" value="Delete Comment">
        </form>
    </div>


    @include('posts.commentsDisplay', ['comments' => $comment->replies])
</div>

@endforeach