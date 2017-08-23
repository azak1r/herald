@extends('layout.master')

@section('content')

    @include('event.partials.errors')

    {{Form::model($settings, ['route' => ['settings.update'], 'method' => 'put'] )}}

        <div class="form-group">
            {{ Form::label('discord_guild_id', null, ['class' => 'control-label']) }}
            {{ Form::number('discord_guild_id', null, ['class' => 'form-control', 'required']) }}
        </div>

        <div class="form-group">
            {{ Form::label('annoucement_channel_id', null, ['class' => 'control-label']) }}
            {{ Form::number('annoucement_channel_id', null, ['class' => 'form-control', 'required']) }}
        </div>

        <div class="form-group">
            {{ Form::label('rsvp_emoji', null, ['class' => 'control-label']) }}
            {{ Form::text('rsvp_emoji', null, ['class' => 'form-control', 'required']) }}
        </div>

        <div class="form-group">
            {{ Form::submit('Save', ['class' => 'btn btn-default']) }}
        </div>

    {{Form::close()}}

@endsection