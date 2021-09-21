<div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('phone', 'Telephone') !!}
                {!! Form::text('phone', $phone??null, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('cell_phone', 'Mobile') !!}
                {!! Form::text('cell_phone', $cell_phone??null, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('email', 'E-mail') !!}
                {!! Form::email('email', $email??null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
</div>
