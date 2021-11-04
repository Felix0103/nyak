<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text"  class="form-control" placeholder='Type something to find' />
        </div>
        @if ($zip_codes->count())
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

                             <th wire:click="order('code')"  >
                                 Code
                                 @if ($sort == 'code')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th wire:click="order('description')"  >
                                Description
                                @if ($sort == 'description')
                                <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                @endif
                                <i class="fas fa-sort float-right mt-1"></i>
                            </th>
                             <th wire:click="order('purchase_price')"  >
                                Purchase Price
                                @if ($sort == 'purchase_price')
                                <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                @endif
                                <i class="fas fa-sort float-right mt-1"></i>
                            </th>
                            <th wire:click="order('sale_price')"  >
                                Sale Price
                                @if ($sort == 'sale_price')
                                <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                @endif
                                <i class="fas fa-sort float-right mt-1"></i>
                            </th>
                             <th colspan="2"></th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($zip_codes as $zipCode)
                             <tr>
                                 <td >{{$zipCode->id}}</td>
                                 <td >{{$zipCode->code}}</td>
                                 <td >{{$zipCode->description}}</td>
                                 <td >{{$zipCode->purchase_price}}</td>
                                 <td >{{$zipCode->sale_price}}</td>

                                 <td width="10px">
                                     @can('admin.zipcodes.edit')
                                         <a class="btn btn-primary btn-sm" href="{{route('admin.zipcodes.edit', $zipCode)}}">Edit</a>
                                     @endcan
                                 </td>
                                 <td width="10px" style="padding-right: 50px !important;">
                                    @can('admin.zipcodes.destroy')
                                        {!! Form::open(['route'=>['admin.zipcodes.destroy', $zipCode], 'method'=>'delete']) !!}
                                            {!! Form::submit( ($zipCode->active==1?'Deactivate':'Active'), ['class'=> "btn btn-".($zipCode->active==0?'success':'danger')." btn-sm"] ) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                             </tr>
                         @endforeach
                     </tbody>
                     </table>
             </div>
             <div class="card-footer">
                 {{$zip_codes->links()}}
             </div>
        @else
              <div class="card-body">
                  <strong>No record found</strong>
              </div>
        @endif
    </div>

 </div>
