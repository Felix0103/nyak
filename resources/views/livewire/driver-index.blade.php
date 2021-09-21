<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text"  class="form-control" placeholder='Type something to find' />
        </div>
        @if ($drivers->count())
             <div class="card-body">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th wire:click="order('id')" class="pointer">
                                 ID
                                 @if ($sort == 'id')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th wire:click="order('first_name')">
                                 First Name
                                 @if ($sort == 'first_name')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th wire:click="order('last_name')"  class="d-none d-sm-block">
                                 Last Name
                                 @if ($sort == 'last_name')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th colspan="2"></th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($drivers as $driver)
                             <tr>
                                 <td >{{$driver->id}}</td>
                                 <td >{{$driver->first_name}}</td>
                                 <td class="d-none d-sm-block">{{$driver->last_name}}</td>
                                 <td width="10px">
                                     @can('admin.drivers.edit')
                                         <a class="btn btn-primary btn-sm" href="{{route('admin.drivers.edit', $driver)}}">Edit</a>
                                     @endcan
                                 </td>
                                 <td width="10px">
                                    @can('admin.drivers.destroy')
                                        {!! Form::open(['route'=>['admin.drivers.destroy', $driver], 'method'=>'delete']) !!}
                                            {!! Form::submit( ($driver->active==1?'Deactivate':'Active'), ['class'=> "btn btn-".($driver->active==0?'success':'danger')." btn-sm"] ) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                             </tr>
                         @endforeach
                     </tbody>
                     </table>
             </div>
             <div class="card-footer">
                 {{$drivers->links()}}
             </div>
        @else
              <div class="card-body">
                  <strong>No record found</strong>
              </div>
        @endif
    </div>

 </div>
