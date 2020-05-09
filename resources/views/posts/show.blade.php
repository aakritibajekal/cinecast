@extends('layout')

@section('title')
View Post
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <h4> See posts one by one</h4>
                    @include('partials.errors')

                    <strong> Username: </strong>
                    <br>

                    {{ $profile->username ?? '' }}
                    <br>

                    <strong> Content: </strong>
                    <br>

                    <p>{{ $post->content }}</p>

                    <h4>Display Comments</h4>

                    @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])

                    <h4>Add comment</h4>

                    <form method="post" action="{{ route('comments.store'   ) }}">

                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="content"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Add Comment" />
                        </div>

                        

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection