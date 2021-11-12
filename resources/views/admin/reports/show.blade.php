@extends('adminlte::page')

@section('title', config('app.name'))

@section('content_header')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <h1>Proccessed Reports Details</h1>
    <a href="{{route('admin.report.sales.proccessed')}}" class="btn btn-secondary float-right">Processed Reposts</a>
@stop

@section('content')
    <div class="row text-center justify-content-center align-items-center">
        <div class="col-sm-2">
            <div class="form-group">
                <label for="total_entries"><span class="badge badge-secondary">Driver Name</span></label>
                <input type="text" value="{{$processedreport->driver->first_name}} {{$processedreport->driver->last_name}}" class="form-control text-center" disabled>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label for="total_sales"><span class="badge badge-success">Total Stops</span></label>
                <input type="text" value="{{$stops}}" class="form-control text-center small" disabled>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label for="total_purchases"><span class="badge badge-primary">Total Sales</span></label>
                <input type="text" value="{{$totales->sale}}" class="form-control text-center" disabled>
            </div>
        </div>
    </div>

    <div class="table-responsive">

        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">Work Date</th>
                    <th scope="col">Code Bar</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Zip Code</th>
                    <th scope="col">Sale Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($report as $item)
                <tr style="{{ $item->active==3? " background-color:#DDFF33 ":""}}">
                    <td> {{ \Carbon\Carbon::parse($item->work_date)->format('d/M/Y')}} </td>
                    <td> {{ $item->barcode }} </td>
                    <td> {{ $item->name }} </td>
                    <td> {{ $item->address }} </td>
                    <td> {{ $item->zip_code }} </td>
                    <td> {{ $item->sale }} </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop


