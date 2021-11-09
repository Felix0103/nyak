<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('state_id', 'State') !!}
            {!! Form::select('state_id', $states, null, ['class' => 'form-control', 'placeholder' => 'Select a State'])
            !!}
            @error('state_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('city', 'City') !!}

            {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Type some city']) !!}

            @error('city')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('code', 'Zip Code') !!}
            {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Type the zip code']) !!}
            @error('code')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('purchase_price', 'Purchase Price') !!}
            {!! Form::number('purchase_price', null, ['class' => 'form-control', 'placeholder' => 'Type the purchase price', 'step'=>'any']) !!}
            @error('purchase_price')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('sale_price', 'Sale Price') !!}
            {!! Form::number('sale_price', null, ['class' => 'form-control', 'placeholder' => 'Type the sale price', 'step'=>'any'])
            !!}
            @error('sale_price')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('purchase_price_duplicate', 'Purchase Price For Duplicate') !!}
            {!! Form::number('purchase_price_duplicate', null, ['class' => 'form-control', 'placeholder' => 'Type purchase price for duplicate', 'step'=>'any']) !!}
            @error('purchase_price_duplicate')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('sale_price_duplicate', 'Sale Price For Duplicate') !!}
            {!! Form::number('sale_price_duplicate', null, ['class' => 'form-control', 'placeholder' => 'Type sale price for duplicate', 'step'=>'any']) !!}
            @error('sale_price_duplicate')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

</div>

<div class="row">

    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('description', 'Description/Note') !!}

            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Type some description or note', 'rows'=>2]) !!}

            @error('description')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

</div>
