@extends('layout.master')

@section('content')

    @foreach($dates as $date => $events)
        <div class="row">

            <div class="col-md-6 col-md-offset-3">
                <h2>{{\Carbon\Carbon::parse($date)->toFormattedDateString()}}</h2>

                @foreach($events as $event)
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="btn-group pull-right" role="group">
                                <button type="button" class="btn btn-danger">remove</button>
                                <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span></button>
                                <button type="button" class="btn btn-default">edit</button>
                            </div>

                            <dl class="dl-horizontal">
                                <dt>Title</dt>
                                <dd>{{$event->title}}</dd>

                                <dt>Date & Time</dt>
                                <dd>{{$event->due}}</dd>

                                <dt>Description</dt>
                                <dd>{{$event->description}}</dd>
                            </dl>

                        </div>

                        <div class="panel-footer">
                            <span class="pull-left">Auto Announcement: 0 min, 15 min, 30min</span>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <hr />
    @endforeach

@endsection