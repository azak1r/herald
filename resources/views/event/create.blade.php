@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <form>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Title" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
                </div>


                <div class="form-group">
                    <label for="due">Date & Time</label>
                    <input class="flatpickr form-control" name="due" placeholder="Select Date.." data-id="datetime" required>
                </div>
                



            </form>


        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css"  href="{{ mix('/css/flatpickr.css') }}">
@endpush