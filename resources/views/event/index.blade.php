@extends('layout.master')

@section('content')

    <div class="row">
        <div class="col-md-9 col-md-offset-2">
            <h1>Events
                <div class="pull-right">
                    <a href="{{route('events.create')}}" class="btn btn-success">Create new Event</a>
                </div>
            </h1>

        </div>
    </div>

    @foreach($dates as $date => $events)
        <div class="row">

            <div class="col-md-9 col-md-offset-2">
                <h3>{{\Carbon\Carbon::parse($date)->toFormattedDateString()}}</h3>

                @foreach($events as $event)
                    <div class="panel panel-default">
                        <div class="panel-body">

                            @if(Auth::user()->can('update', $event))
                                <div class="btn-group pull-right" role="group">
                                    <a href="{{route('events.delete', $event->id)}}" class="btn btn-danger">remove</a>

                                    <a href="{{route('events.announce', $event->id)}}" class="btn btn-info">
                                        <span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>
                                    </a>

                                    <a href="{{route('events.edit', $event->id)}}" class="btn btn-default">edit</a>
                                </div>
                            @endif

                            <dl class="dl-horizontal" id="vue">
                                <dt>Title</dt>
                                <dd><a href="{{route('events.show', $event->id)}}">{{$event->title}}</a></dd>

                                <dt>Date & Time</dt>
                                <dd><timezone date="{{$event->due}}"></timezone></dd>

                                <dt>Description</dt>
                                <dd>{!! nl2br($event->description) !!}</dd>
                            </dl>

                        </div>

                        <div class="panel-footer">
                            <span class="pull-left">Created by: {{ $event->creator->name }}</span>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <hr />
    @endforeach


    <div class="row">
        <div class="col-md-9 col-md-offset-2">
            <div class="pull-right">
                {{ $raw_events->links() }}
            </div>
        </div>
    </div>


@endsection