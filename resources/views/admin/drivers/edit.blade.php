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
            <h1>Edit Driver</h1>
        </div>
        <div class="col">
            <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary btn-sm float-right">Driver list</a>
        </div>
    </div>
@stop

@section('content')
    {!! Form::model($driver ,['route' => ['admin.drivers.update', $driver], 'method'=>'put'], [ 'class' => 'card'] ) !!}

    <div class="card-body">

        @include('admin.drivers.partials.form')
        @livewire('address-component', $driver->address?$driver->address->toArray():[] )
        @livewire('contact-component', $driver->contact?$driver->contact->toArray():[] )
        {!! Form::submit('Update Driver', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@stop
