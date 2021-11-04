@extends('adminlte::page')

@section('title', config('app.name'))


@section('content_header')
    <div class="row">
        <div class="col">
            <h1>Edit Uploaded File</h1>
        </div>
        <div class="col">
            <a href="{{ route('admin.files.index') }}" class="btn btn-secondary btn-sm float-right">File List</a>
        </div>
    </div>
@stop

@section('content')
    {!! Form::model($file,['route' => ['admin.files.update', $file], 'method'=>'put'],['class' => 'card']) !!}

    <div class="card-body small">
        @include('admin.files.partials.form')
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('file_name', 'File Name') !!}
                    {!! Form::text('file_name', null, ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('status', 'File Status') !!}
                    {!! Form::text('status', $file->fileStatus(), ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('total_row', 'Total Entries') !!}
                    {!! Form::text('total_row', $file->file_details->count(), ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                   <label style="color:white;">a</label>

                    {!! Form::submit('Update Info', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    @livewire('admin.file-details',  ['file' => $file])

@stop
@section('js')
    <script src="{{ asset('js/bs-custom-file-input.min.js') }}" defer></script>
    <script>
        $(function () {
          bsCustomFileInput.init();
        });
        </script>



@stop
