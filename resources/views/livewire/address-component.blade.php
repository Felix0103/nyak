<div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('description', 'Address') !!}
                {!! Form::text('description', ($description??null), ['class'=>'form-control', 'placeholder'=>'Type a address']) !!}
            </div>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('country_id', 'Country') !!}
                {!! Form::select('country_id', $countries, ($country_id??null), ['class'=>'form-control', 'placeholder'=> 'Select a country']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('state_id', 'State') !!}
                {!! Form::select('state_id', $states, ($state_id??null), ['class'=>'form-control', 'placeholder'=> 'Select a state', 'wire:model.prevent' =>'state_id']) !!}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('city_id', 'City (Zip Code)') !!}
                {!! Form::select('city_id', $cities, ($city_id??null), ['class'=>'form-control', 'placeholder'=> 'Select a city (zip code)']) !!}
            </div>
        </div>
    </div>
</div>
