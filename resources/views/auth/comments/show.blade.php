@extends('layout')

@section('title')
View Comments
@endsection

@section('content')


<h4> See Comments</h4>

@include('partials.errors')

<strong> Username: </strong>
    
<h3> {{ $profile->username }} </h3>

<p>{{ $post->content }}</p>
   
@endsection