@extends('adminlte::page')

@section('title', config('app.name'))


@section('content_header')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="row">
        <div class="col">
            <h1>Update Zip Code</h1>
        </div>
        <div class="col">
            <a href="{{ route('admin.zipcodes.index') }}" class="btn btn-secondary btn-sm float-right"> Zip code list</a>
        </div>
    </div>
@stop

@section('content')
    {!! Form::model($zipcode ,['route' => ['admin.zipcodes.update', $zipcode], 'method'=>'put'], [ 'class' => 'card'] ) !!}

    <div class="card-body">

        @include('admin.zipcodes.partials.form')
        {!! Form::submit('Update zip code', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@stop
