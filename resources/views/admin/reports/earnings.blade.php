@extends('adminlte::page')

@section('title', config('app.name'))

@section('content_header')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <h1>Earnings Report</h1>
@stop

@section('content')
    @livewire('admin.earning-report')
@stop


