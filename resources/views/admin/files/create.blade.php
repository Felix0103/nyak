@extends('adminlte::page')

@section('title', config('app.name'))


@section('content_header')
    <div class="row">
        <div class="col">
            <h1>New File to Load</h1>
        </div>
        <div class="col">
            <a href="{{ route('admin.files.index') }}" class="btn btn-secondary btn-sm float-right">File List</a>
        </div>
    </div>
@stop

@section('content')
    {!! Form::open(['route' => 'admin.files.store', 'class' => 'card', "enctype"=>"multipart/form-data"]) !!}

    <div class="card-body">
        @include('admin.files.partials.form')
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">

                    {!! Form::label('file_to_load', 'Delivery File') !!}
                    <div class="input-group">
                        <div class="custom-file">
                            {!! Form::file('file_to_load', ['class' => 'custom-file-input', 'placeholder' => 'Select a File', 'accept'=>".xls,.xlsx,.csv"]) !!}
                            {!! Form::label('file_to_load', 'Choose Delivery File', ['class' => 'custom-file-label']) !!}
                        </div>
                    </div>
                    @error('file_to_load')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {!! Form::submit('Load File', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

    @error('barcode')
    <span class="text-danger">{{ $message }}</span>
@enderror
@stop
@section('js')
    <script src="{{ asset('js/bs-custom-file-input.min.js') }}" defer></script>
    <script>
        $(function () {
          bsCustomFileInput.init();
        });
        </script>
@stop
