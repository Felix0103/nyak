
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('driver_id', 'Driver') !!}
            {!! Form::select('driver_id', $drivers, null, ['class' => 'form-control', 'placeholder' => 'Select a Driver']) !!}
            @error('driver_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('work_date', 'Work Date') !!}
            {!! Form::date('work_date', null, ['class' => 'form-control', 'placeholder' => 'Select a work date']) !!}
            @error('work_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
