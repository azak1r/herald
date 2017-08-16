@extends('layout.master')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h2>Event Info

                @if(Auth::user()->can('update', $event))
                    <div class="btn-group pull-right" role="group">
                        <a href="{{route('events.delete', $event->id)}}" class="btn btn-danger">remove</a>
                        <a href="{{route('events.announce', $event->id)}}" class="btn btn-info">
                            <span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>
                        </a>
                        <a href="{{route('events.edit', $event->id)}}" class="btn btn-default">edit</a>
                    </div>
                @endif

            </h2>
        </div>
    </div>

    <div class="row">

        <div class="col-md-8">

            <div class="panel panel-default panel-primary" id="vue">
                <div class="panel-body">

                    <dl class="dl-horizontal">
                        <dt>Title</dt>
                        <dd>{{$event->title}}</dd>

                        <dt>Created by</dt>
                        <dd>{{$event->creator->name}}</dd>

                        <dt>Date & Time</dt>
                        <dd><timezone date="{{$event->due}}"></timezone></dd>

                        <dt>Description</dt>
                        <dd>{!! nl2br($event->description) !!}</dd>

                    </dl>

                </div>
            </div>
        </div>

        @if(Auth::user()->can('update', $event))
            <div class="col-md-4">

                @include('event.partials.errors')

                <div class="panel panel-default panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <form class="form-inline pull-right clearfix" method="post"
                              action="{{route('announcements.create', $event->id)}}">

                            {{csrf_field()}}

                            <div class="form-group form-group-sm">
                                <select class="form-control input-sm" name="date">
                                    <option value="{{$event->due}}">At the start of event</option>
                                    <option value="{{ $event->due->subMinute(10)->toDateTimeString() }}">10 min before
                                    </option>
                                    <option value="{{ $event->due->subHour(1)->toDateTimeString() }}">1 hour before
                                    </option>
                                    <option value="{{ $event->due->subHour(6)->toDateTimeString() }}">6 hours before
                                    </option>
                                    <option value="{{ $event->due->subHour(12)->toDateTimeString() }}">12 hours before
                                    </option>
                                    <option value="{{ $event->due->subHour(24)->toDateTimeString() }}">24 hours before
                                    </option>
                                    <option value="{{ $event->due->subHour(48)->toDateTimeString() }}">48 hours before
                                    </option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-default btn-xs">Add</button>
                        </form>

                        Annoucements
                    </div>

                    <!-- List group -->
                    <ul class="list-group">

                        @foreach($event->announcements as $announcement)
                            <li class="list-group-item">
                                Announcement in {{$announcement->date->diffForHumans()}}
                                <a class="btn btn-danger btn-xs pull-right"
                                   href="{{route('announcements.destroy', $announcement->id)}}">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

@endsection