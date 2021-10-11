@extends('adminlte::page')

@section('title', config('app.name'))

@section('content_header')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @can('admin.files.create')
        <a class="btn btn-primary btn-sm float-right mr-1" href="{{route('admin.files.create')}}">Load New File</a>
    @endcan
    <h1>File List</h1>
@stop

@section('content')
    @livewire('admin.file-index')
@stop


