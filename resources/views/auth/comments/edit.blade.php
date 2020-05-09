@extends('layout')

@section('title')
Edit Comment
@endsection

@section('content')


<h3 class="text-center">Edit your Comment!</h3>

@include('partials.errors')

<div class="container-fluid">
    <div class="row h-100 justify-content-center align-items-center">

  
    <p>
    @if( $comment->is_gif == TRUE )
    <img src="{{ $comment->content }}">
    @else
    {{ $comment->content }}
    @endif
    </p>

    <a href="#" id="reply"></a>


    <div class="float-right" id="app" >
        <comment-edit-form submission-url="{{ route( 'comments.update', $comment->id) }}" v-model="content" > 
            @csrf
            @method('PATCH')
        </comment-edit-form> 
        <Giphy v-on:image-clicked="imageClicked" /> 
    </div>
    </div>



        
    <div class="form-group container h-100">
        <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
            @csrf 
            @method('DELETE')
            <input class="btn btn-danger" type="submit" value="Delete Comment">
    </div>
        </form>

</div>
</div>

@endsection