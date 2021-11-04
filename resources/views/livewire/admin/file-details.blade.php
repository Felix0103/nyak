<div>
    <div class="card small">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <input wire:model="address" type="text"  class="form-control" placeholder='Type some Client or Address' />
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="custom-control">
                        <button wire:click="allZipCode" class="btn btn-{{($onlywithOutZipCode?'success':'danger')}}">{{($onlywithOutZipCode?'All':'Missing Code')}}</button>
                    </div>
                </div>
            </div>
        </div>
        @if ($fileDetails->count())
        @csrf
             <div class="card-body">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th class="pointer" class="selected">
                                 <button onclick="check_all()" class="btn btn-success btn-xs">
                                     C/U All
                                </button>
                             </th>
                             <th wire:click="order('barcode')" class="pointer">
                                 Barcode
                                 @if ($sort == 'barcode')
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
                            <th wire:click="order('zip_code')"  >
                                Zip Code
                                @if ($sort == 'zip_code')
                                <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                @endif
                                <i class="fas fa-sort float-right mt-1"></i>
                            </th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($fileDetails as $fileDetail)
                             <tr >
                                 <td width="5%">{!! Form::checkbox('id', $fileDetail->id, null, ['class'=>'selected']) !!}</td>
                                 <td >{{$fileDetail->barcode}}</td>
                                 <td>{{$fileDetail->name}}</td>
                                 <td>{{$fileDetail->address}}</td>

                                 <td id="zip_codeupdate{{$fileDetail->id}}">
                                    @if (strlen($fileDetail->zip_code)>0)
                                        <button onclick="setZipCode({{$fileDetail->id}})" class="btn btn-warning btn-xs">{{$fileDetail->zip_code}}</button>
                                    @else
                                        <button onclick="setZipCode({{$fileDetail->id}})" class="btn btn-success btn-xs">New Zip</button>
                                    @endif
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

 @section('js')

    <script>




        allSelected = false;

        function check_all(){
            allSelected=!allSelected;
            $('.selected').prop('checked', allSelected);
        }

        async  function  setZipCode(file_detail_id) {


            const { value: zipCode } = await Swal.fire({
            title: 'Enter Zip code',
            input: 'number',
            inputLabel: 'Zip code',
            inputValue: '',
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                return 'You need to write a zip code!'
                }
            }
            })

            if (zipCode) {
                fetch('/admin/file/update_zip_code/'+file_detail_id, {
                    method: 'PUT',
                    headers: {
                    'Content-Type': 'application/json'
                    },
                    body: '{"_token": "'+$('[name="_token"]').val()+'", "zip_code": "'+zipCode+'" }'
                }).then(res => res.json())
                .catch(error => console.error('Error:', error))
                .then(response => {


                    $('#zip_codeupdate'+response.id).html(' <button onclick="setZipCode('+response.id+')" class="btn btn-warning btn-xs">'+zipCode+'</button>');
                    Swal.fire(
                    'Updated!',
                    'Your file has been updated.',
                    'success'
                    );
                });

            }

        }
    </script>



@stop


