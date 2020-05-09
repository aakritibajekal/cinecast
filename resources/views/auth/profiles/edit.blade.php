@extends('layout')

@section('title')
Update Profile Form
@endsection

@section('content')

<h1 class="text-center"> Fill out this form to update your profile!</h1>

@include('partials.errors')

<div class="container-fluid">
    <div class="row h-100 justify-content-center align-items-center">

        <form method="post" action="{{ route( 'profiles.store' ) }}" enctype="multipart/form-data">
        <div class="form-group container h-100">
             @csrf {{-- cross site request forgery. a security mesaure --}}

            <label for="username">
                <strong> Username: </strong>
                <input type="text" id="username" name="username" value="{{ $profile->username}}">
            </label>
        </div>

        <div class="form-group container h-100">
            <label for="bio">
                <strong> Update Post Content: </strong>
                <textarea class="form-control" name="bio" id="bio" cols="30" rows="10"> {{ $profile->bio }} </textarea>
            </label>
        </div>


        <div class="form-group container h-100">
            <label for="picture">
                Select image to upload:
                <input type="file" name="picture" id="picture">
            </label>
        </div>


        <div class="form-group container h-100">
            <input class="btn btn-primary btn-customized align-bottom" type="submit" value="Update Profile">
        </div>
    
        </form>

    </div>
</div>

@endsection