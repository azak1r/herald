<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>C0RE :: Timer</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>
<body>
<div id="wrap">

    @include('layout.partials.navigation')

    <div class="container content">

        <div id="vue" class="panel panel-default panel-primary">
            <div class="panel-body">

                <countdown date="{{$event->due}}"></countdown>

                <div class="clearfix"></div>
                <hr>

                <dl class="dl-horizontal text-left">
                    <dt>Title</dt>
                    <dd>{{$event->title}}</dd>

                    <dt>Created by</dt>
                    <dd>{{$event->creator->name}}</dd>

                    <dt>Date & Time</dt>
                    <dd><timezone date="{{$event->due}}"></timezone></dd>

                    <dt>Description</dt>
                    <dd>{!! nl2br($event->description) !!}</dd>

                </dl>
                <div class="clearfix"></div>
                <small class="created text-center">Created at <timezone date="{{$event->created_at}}"></timezone> | Target: <timezone date="{{$event->due}}"></timezone></small>
            </div>


        </div>

    </div>

    <script src="{{ mix('js/app.js') }}"></script>

</body>
</html>