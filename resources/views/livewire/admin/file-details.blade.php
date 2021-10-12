<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="address" type="text"  class="form-control" placeholder='Ingrese el nombre o apellido de un cliente' />
        </div>
        @if ($fileDetails->count())
             <div class="card-body">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th wire:click="order('barcode')" class="pointer">
                                 Barcode
                                 @if ($sort == 'barcode')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th wire:click="order('status')">
                                 Status
                                 @if ($sort == 'status')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th wire:click="order('name')" >
                                 Name
                                 @if ($sort == 'name')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th wire:click="order('address')"  >
                                Address
                                @if ($sort == 'address')
                                <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                @endif
                                <i class="fas fa-sort float-right mt-1"></i>
                            </th>
                            <th wire:click="order('zipcode')"  >
                                Zip Code
                                @if ($sort == 'zipcode')
                                <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                @endif
                                <i class="fas fa-sort float-right mt-1"></i>
                            </th>
                             <th colspan="2"></th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($fileDetails as $fileDetail)
                             <tr>
                                 <td >{{$fileDetail->barcode}}</td>
                                 <td >{{$fileDetail->status}}</td>
                                 <td>{{$fileDetail->name}}</td>
                                 <td>{{$fileDetail->address}}</td>
                                 <td>{{$fileDetail->zipcode}}</td>
                                 <td width="10px">
                                     @can('admin.clients.edit')
                                         <a class="btn btn-primary btn-sm" href="{{route('admin.clients.edit', $client)}}">Editar</a>
                                     @endcan
                                 </td>
                                 <td width="10px">
                                    @can('admin.clients.destroy')
                                        {!! Form::open(['route'=>['admin.clients.destroy', $client], 'method'=>'delete']) !!}
                                            {!! Form::submit( ($client->active==1?'Desactivar':'Activar'), ['class'=> "btn btn-".($client->active==0?'success':'danger')." btn-sm"] ) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                             </tr>
                         @endforeach
                     </tbody>
                     </table>
             </div>
             <div class="card-footer">
                 {{$fileDetails->links()}}
             </div>
        @else
              <div class="card-body">
                  <strong>This file does not have any delivery</strong>
              </div>
        @endif
    </div>

 </div>
