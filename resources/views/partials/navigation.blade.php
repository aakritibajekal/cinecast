<nav class="navbar" role="navigation">
    
<ul class="navbar-nav">

<li class="nav-item" class="mx-auto">
    <a  href="./">
    <figure  >
        <img class="img-responsive" hspace="20" alt="logo" src="{{URL( '/images/cinecast.png' )}}">
    </figure>
    </a>
</li>

<li class="nav-item">
    <a class="navbar-brand" href="{{ route( 'posts.index' ) }}">
    Casts
    </a>
</li>
<li class="nav-item">
    <a class="navbar-brand" href="{{ route( 'posts.index' ) }}">
    Why Casts
    </a>
</li>
@auth
<li class="nav-item">
<a class="navbar-brand" href="{{ route( 'posts.create' ) }}">
    Create New Post
    </a>
</li>

<li class="nav-item">
<a class="navbar-brand" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
<form id="logout-form" action="{{ route('logout') }}"       method="POST" style="display: none;">
        {{ csrf_field() }}
</form>
</li>
@endauth
@guest
<li class="nav-item">
<a class="navbar-brand" href="{{ route( 'login') }}">
    Login
    </a>
</li>

<li class="nav-item">
<a class="navbar-brand" href="{{ route( 'register') }}">
    Register
    </a>
</li>
@endauth
</ul>
</nav>