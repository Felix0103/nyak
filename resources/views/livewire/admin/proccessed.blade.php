<div>




    <div class="card">
        <div class="card-header">
            <div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('driverId', 'Start Date') !!}
                            {!! Form::select('driverId', $drivers, null, ['class' => 'form-control', 'placeholder' => 'All
                            Drivers', 'wire:model'=>'driver_id']) !!}
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

                            {{-- <button wire:click='proccess' class="btn btn-success">Process</button> --}}


                        </div>

                    </div>
                </div>
            </div>
        </div>
        @if ($processed->count())
            @csrf
             <div class="card-body">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th wire:click="order('id')" class="pointer">
                                 Proccess ID
                                 @if ($sort == 'id')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th>Start Date</th>
                             <th>End Date</th>
                             <th >
                                 Driver Name
                             </th>
                             <th   class="d-none d-sm-block">
                                 Processed By
                             </th>
                             <th >
                                Payment Status
                            </th>
                             <th colspan="2"></th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($processed as $process)
                             <tr>
                                 <td >{{$process->id}}</td>
                                 <td >{{ \Carbon\Carbon::parse($process->start_date)->format('d/M/Y')}}</td>
                                 <td >{{ \Carbon\Carbon::parse($process->end_date)->format('d/M/Y')}}</td>
                                 <td >{{$process->driver->first_name}} {{$process->driver->last_name}}</td>
                                 <td class="d-none d-sm-block">{{$process->user->name}}</td>
                                 <td>
                                    <div><h6 class="badge badge-{{ ($process->active == 1? "warning":"success") }}">{{ ($process->active == 1? "Waiting for pay":"Paid Out") }}</h6></div>
                                </td>
                                 <td width="10px">
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.report.sales.proccessed.show', $process)}}">Details</a>
                                 </td>
                                <td width="10px">
                                    <a target="_blank" class="btn btn-warning btn-sm" href="{{route('admin.report.sales.proccessed.print', $process)}}">Print</a>
                                </td>
                                <td width="10px">
                                    @if ($process->active == 1)
                                        <button id="b_{{$process->id}}" onclick="pay_processed({{$process->id}})" class="btn btn-success btn-sm" >Pay</a>
                                    @endif
                                </td>
                             </tr>
                         @endforeach
                     </tbody>
                     </table>
             </div>
             <div class="card-footer">
                 {{$processed->links()}}
             </div>
        @else
              <div class="card-body">
                  <strong>No record found</strong>
              </div>
        @endif
    </div>

 </div>

 @section('js')


 <script  language="javascript">

     function pay_processed(file_id){

        Swal.fire({
        title: 'Are you sure?',
        text: "You want to pay this report!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, pay it!'
        }).then((result) => {
        if (result.isConfirmed) {


            fetch('/admin/report/processed/payout/'+file_id, {
                method: 'PUT',
                headers: {
                'Content-Type': 'application/json'
                },
                body: '{"_token": "'+$('[name="_token"]').val()+'"}'
            })
            .then(response => {

                $('#b_'+file_id).hide();
                Swal.fire(
                'PAID OUT!',
                'This report has been paid!!.',
                'success'
                )
                // return response.json( )
            })
        }
        })
     }
 </script>


  @stop
