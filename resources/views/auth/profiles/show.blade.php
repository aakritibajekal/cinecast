@extends('layout')

@section('title')
View Profile
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                   

                    <br>
                    <br>
                    <br>

                    <h4> See single Profile</h4>

                    
                    <a class="float-right" href="{{ route('profile.follow', $profile->id ) }}">Follow Profile</a>

                    <br>

                    <a class="float-right" href="{{ route('profile.unfollow', $profile->id ) }}">Unfollow Profile</a>

                    @include('partials.errors')

                    <figure>
                        <img class="profilePic" class="rounded" class="img-responsive" src="{{ $profile->picture }}" alt="Profile picture" style="width:40%" />
                    </figure>

                    <strong> Username: </strong>
                    {{ $profile->username }}

                    <br>

                    <strong> Bio: </strong>
                    <p>{{ $profile->bio }}</p>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection