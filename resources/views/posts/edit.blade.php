@extends('layout')

@section('title')
Edit Post
@endsection

@section('content')


<h1 class="text-center"> Use this form to edit your Post!</h1>

@include('partials.errors')

<div class="container-fluid">
    <div class="row h-100 justify-content-center align-items-center">

        <form method="post" action="{{ route( 'posts.update', $post->id) }}">

            <div class="form-group container h-100">
                @csrf {{-- cross site request forgery. a security mesaure --}}
                @method('PATCH')

                <div class="form-group container h-100">
                    <label for="content">
                    <strong> Post content: </strong>
                    <br>
                    <textarea name="content" id="content" cols="30" rows="10">{{ $post->content }}</textarea>
                    </label>
                </div>

            <div class="form-group container h-100">
                <input class="btn btn-primary btn-customized align-bottom" type="submit" value="Update Post">
                </form>
            </div>

            <div class="form-group container h-100">
                <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                @csrf 
                @method('DELETE')
                <input class="btn btn-danger" type="submit" value="Delete Post">
            </div>  
                </form>
           


</div>
   
</div>

@endsection