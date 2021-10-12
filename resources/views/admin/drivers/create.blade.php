@extends('adminlte::page')

@section('title', config('app.name'))


@section('content_header')
    <div class="row">
        <div class="col">
            <h1>Driver Register</h1>
        </div>
        <div class="col">
            <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary btn-sm float-right">Driver list</a>
        </div>
    </div>
@stop

@section('content')
    @if (session('info'))
    <div class="alert alert-warning">
        <strong>{{session('info')}}</strong>
    </div>
    @endif
    {!! Form::open(['route' => 'admin.drivers.store', 'class' => 'card']) !!}

    <div class="card-body">

        @include('admin.drivers.partials.form')
        @livewire('address-component')
        @livewire('contact-component')
        {!! Form::submit('Guardar Cliente', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@stop
