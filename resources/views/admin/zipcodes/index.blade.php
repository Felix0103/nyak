@extends('adminlte::page')

@section('title', config('app.name'))

@section('content_header')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @can('admin.zipcodes.create')
        <a class="btn btn-secondary btn-sm float-right mr-1" href="{{route('admin.zipcodes.create')}}">Add Zip Code</a>
    @endcan
    <h1>Zip Code List</h1>
@stop

@section('content')
    @livewire('zip-code-index')
@stop


