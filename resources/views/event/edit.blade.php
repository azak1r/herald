@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            @include('event.partials.errors')

            {{Form::model($event, ['route' => ['events.update', $event->id], 'method' => 'put'] )}}

                @include('event.partials.form')

            {{Form::close()}}


        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css"  href="{{ mix('/css/flatpickr.css') }}">
@endpush