@extends('adminlte::page')

@section('title', config('app.name'))


@section('content_header')
<div class="row">
    <div class="col">
        <h1>Zip code register</h1>
    </div>
    <div class="col">
        <a href="{{ route('admin.zipcodes.index') }}" class="btn btn-secondary btn-sm float-right">Zip code list</a>
    </div>
</div>
@stop

@section('content')
{!! Form::open(['route' => 'admin.zipcodes.store', 'class' => 'card']) !!}

<div class="card-body">

    @include('admin.zipcodes.partials.form')

    {!! Form::submit('Save zip code', ['class' => 'btn btn-primary']) !!}
</div>

{!! Form::close() !!}
@stop
