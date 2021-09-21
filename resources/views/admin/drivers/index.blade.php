@extends('adminlte::page')

@section('title', config('app.name'))

@section('content_header')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @can('admin.drivers.create')
        <a class="btn btn-secondary btn-sm float-right mr-1" href="{{route('admin.drivers.create')}}">Add Driver</a>
    @endcan
    <h1>Driver List</h1>
@stop

@section('content')
    @livewire('driver-index')
@stop


