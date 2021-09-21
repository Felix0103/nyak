<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('first_name', 'First Name') !!}
            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Type a first name']) !!}
            @error('first_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('last_name', 'Last Name') !!}
            {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Type a last name']) !!}
            @error('last_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

