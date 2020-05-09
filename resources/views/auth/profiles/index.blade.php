@extends('layout')


@section('title')
Profiles Index
@endsection

@section('content')

@if ( session()->get('success') )
<div role="alert">
    {{ session()->get('success') }}
</div>
@endif

<p> List of Profiles:</p>
@foreach($profiles as $profile)
<div class="card" style="width: 36rem;">

    <ul>    
        <div class="card-body"> 
            <li>
                <h3>
                    {{ $profile->username }}
                </h3>
                <figure>
                    <img class="profilePic" class="img-responsive" src="{{ $profile->picture }}" alt="Profile picture" style="width:10%" />
                </figure>
                <p>
                    {{ $profile->bio}}
                </p>
            </li>
        </div>       
    </ul>
</div>
@endforeach
@endsection

@auth 

@endauth