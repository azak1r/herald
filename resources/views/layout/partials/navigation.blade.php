<div class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}">
                <span class="pull-left">CORE :: HERALD</span>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="#">My Events</a>
                </li>
                <li><a href="#">All Events</a></li>
                <li><a href="#">Past Events</a></li>


            </ul>

            @if(Auth::check())
                <p class="navbar-text navbar-right">
                    Signed in as <strong>{{ Auth::user()->name }}</strong>
                    (<a href="{{route('auth.logout')}}" class="navbar-link">Logout</a>)
                </p>
            @else
                <p class="navbar-text navbar-right">
                    <a href="{{route('auth.login')}}">Login</a>
                </p>
            @endif
        </div>
    </div>
</div>