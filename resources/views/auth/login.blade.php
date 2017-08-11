@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="jumbotron text-center">
                <a href="{{route('auth.login')}}"><img class="login" src="{{asset('/img/login.png')}}"></a>
            </div>

        </div>
    </div>
@endsection
