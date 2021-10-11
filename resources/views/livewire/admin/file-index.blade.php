<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text"  class="form-control" placeholder='type some driver/file name' />
        </div>
        @if ($fileHeaders->count())
             <div class="card-body">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th wire:click="order('work_date')" class="pointer">
                                 Work Date
                                 @if ($sort == 'work_date')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>

                             <th wire:click="order('driver_name')">
                                 Driver Name
                                 @if ($sort == 'driver_name')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th wire:click="order('file_name')" >
                                 File Name
                                 @if ($sort == 'file_name')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th  >
                                File Status
                            </th>
                             <th colspan="2"></th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($fileHeaders as $file)

                             <tr>
                                 <td >{{ \Carbon\Carbon::parse($file->work_date)->format('d/M/Y')}}</td>
                                 <td >{{$file->driver_name}}</td>
                                 <td >{{$file->file_name}}</td>
                                 <td >{{$file->fileStatus()}}</td>
                                 <td width="10px">
                                     @can('admin.files.edit')
                                         <a class="btn btn-primary btn-sm" href="{{route('admin.files.edit', $file->id)}}">Edit</a>
                                     @endcan
                                 </td>
                                 <td width="10px">
                                    @can('admin.files.destroy')
                                        {!! Form::open(['route'=>['admin.files.destroy', $file->id], 'method'=>'delete']) !!}
                                            {!! Form::submit( ($file->active==1?'Cancel':'Active'), ['class'=> "btn btn-".($file->active==0?'success':'danger')." btn-sm"] ) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                             </tr>
                         @endforeach
                     </tbody>
                     </table>
             </div>
             <div class="card-footer">
                 {{$fileHeaders->links()}}
             </div>
        @else
              <div class="card-body">
                  <strong>No record found</strong>
              </div>
        @endif
    </div>

 </div>
