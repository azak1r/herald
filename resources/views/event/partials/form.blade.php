<div class="form-group">
    {{ Form::label('title', null, ['class' => 'control-label']) }}
    {{ Form::text('title', null, ['class' => 'form-control', 'required']) }}
</div>

<div class="form-group">
    {{ Form::label('description', null, ['class' => 'control-label']) }}
    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '5', 'required']) }}
</div>

<div class="form-group">
    {{ Form::label('due', null, ['class' => 'control-label']) }}
    {{ Form::text('due', null, ['class' => 'flatpickr form-control', 'required', 'placehodler' => 'Select Date...', 'data-id' => 'datetime']) }}
</div>


<div class="form-group">
    {{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
</div>