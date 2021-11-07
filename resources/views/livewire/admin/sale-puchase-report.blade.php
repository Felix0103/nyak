<div>

    {{-- Headers busqueda --}}
    <div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                        {!! Form::label('driverId', 'Start Date') !!}
                        {!! Form::select('driverId', $drivers, null, ['class' => 'form-control', 'placeholder' => 'All Drivers', 'wire:model'=>'driver_id']) !!}
                    @error('driverId')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('date1', 'Start Date') !!}
                   {!! Form::date('date1', $date1, ['class' => 'form-control', 'wire:model'=>'date1']) !!}
                    @error('date1')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('date2', 'End Date') !!}
                   {!! Form::date('date2', $date2, ['class' => 'form-control', 'wire:model'=>'date2']) !!}
                    @error('date2')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                  <br>
                  <button wire:click='search' class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
        <div class="row text-center justify-content-center align-items-center">
            <div class="col-sm-2">
                <div class="form-group">
                 <label for="total_entries"><span class="badge badge-secondary">Total Entries</span></label>
                 <input type="text" value="{{$entries}}" class="form-control text-center" disabled>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                 <label for="total_sales"><span class="badge badge-success">Total Sales</span></label>
                 <input type="text" value="{{$sale}}" class="form-control text-center small" disabled>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                 <label for="total_purchases"><span class="badge badge-primary">Total Purchases</span></label>
                 <input type="text" value="{{$purchase}}" class="form-control text-center" disabled>
                </div>
            </div>
        </div>
    </div>

    {{-- detalles del reporte --}}

    @if ($report_info == null)
        <div class="row justify-content-center">
            <p class="display-4"><span class="badge badge-secondary">Select the filters and click to search</span></p>
        </div>
    @elseif ($report_info->count() ==0)
        <div class="row justify-content-center">
            <p class="display-4"><span class="badge badge-warning">No record found</span></p>
        </div>
    @else
        <div class="table-responsive">

            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                    <th scope="col">Work Date</th>
                    <th scope="col">Code Bar</th>
                    <th scope="col">Driver Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Zip Code</th>
                    <th scope="col">Purchase Price</th>
                    <th scope="col">Sale Price</th>
                    <th scope="col">Earning</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($report_info as $item)
                        <tr style="{{ $item->active==3? "background-color:#DDFF33 ":""}}">
                            <td> {{ \Carbon\Carbon::parse($item->work_date)->format('d/M/Y')}} </td>
                            <td> {{ $item->barcode }} </td>
                            <td> {{ $item->driver_name }} </td>
                            <td> {{ $item->address }} </td>
                            <td> {{ $item->zip_code }} </td>
                            <td> {{ $item->purchase }} </td>
                            <td> {{ $item->sale }} </td>
                            <td> {{ $item->earning }} </td>

                        </tr>
                    @endforeach
                </tbody>
                </table>
        </div>
    @endif
</div>
