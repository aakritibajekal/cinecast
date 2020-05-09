@extends('layout')


@section('title')
CineCast
@endsection

@section('content')

@if ( session()->get('success') )
<div role="alert">
    {{ session()->get('success') }}
</div>
@endif

<div id="app">

</div>

@foreach($posts as $post)
<div class="card" class="gridCard m-b-md" style="width: 36rem;">

    <ul>
        <div class="card-body"> 
            <li> 
                @auth
                <a href="{{ route('profiles.show', $post->profile_ID) }}" class="text-dark" class="nav-link" ><strong>{{ $post->username }}</strong></a>
                @endauth

                @guest
                <strong>{{ $post->username }}</strong>
                @endguest


                <div class="float-right">
                    @if($follower->followed ?? '') 
                    <small>You are following</small>

                    @else 
                    <small>You are not following</small>

                    @endif
                </div>

                <!--
                <figure>
                    <img class="rounded-circle z-depth-2" class="img-responsive" src="{{ $post->picture }}" alt="Profile picture" style="width:10%" />
                </figure>
                -->

                <p>
                    {{ $post->content }}    
                </p>

                @auth 
                <a href="{{ route('posts.show', $post->id ) }}" class="btn btn-primary">View Reviews</a>
                
                <a href="{{ route('posts.edit', $post->id ) }}" class="btn btn-primary">Edit Review</a>
                
                <div class="float-right">
                    <button  onclick="actOnPost(event);" data-post-id="{{ $post->id }}">Like</button>
                    <span id="likes-count-{{ $post->id }}">{{ $post->likes_count }}</span>
                </div>
            
                @endauth
               
            </li> 
        </div>       
    </ul>
</div>
@endforeach
@endsection

@auth 
@endauth