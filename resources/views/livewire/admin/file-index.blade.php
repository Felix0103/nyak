<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text"  class="form-control" placeholder='type some driver/file name' />
        </div>
        @if ($fileHeaders->count())
        @csrf
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

                             <tr id="file_{{$file->id}}">
                                 <td >{{ \Carbon\Carbon::parse($file->work_date)->format('d/M/Y')}}</td>
                                 <td >{{$file->driver_name}}</td>
                                 <td >{{$file->file_name}}</td>
                                 <td >{{$file->fileStatus()}}</td>
                                 <td width="10px">
                                     @if ($file->fileStatus()=="duplicate file")
                                         <div><h6 class="badge badge-danger">Duplicate</h6></div>
                                    @elseif ($file->fileStatus()=="no deliveries")
                                        <div><h6 class="badge badge-warning">No Deliveries</h6></div>
                                     @else
                                        @can('admin.files.edit')
                                            <a class="btn btn-primary btn-sm" href="{{route('admin.files.edit', $file->id)}}">Edit</a>
                                        @endcan
                                     @endif

                                 </td>
                                 <td width="10px">
                                    @can('admin.files.destroy')
                                        <button onclick="delete_file({{$file->id}})" class="btn btn-{{($file->active==0?'success':'danger')}} btn-sm">{{($file->active==1?'Cancel':'Active')}}</button>
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
 @section('js')


 <script  language="javascript">

     function delete_file(file_id){

        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {


            fetch('/admin/files/'+file_id, {
                method: 'DELETE',
                headers: {
                'Content-Type': 'application/json'
                },
                body: '{"_token": "'+$('[name="_token"]').val()+'"}'
            })
            .then(response => {

                $('#file_'+file_id).hide();
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
                // return response.json( )
            })




        }
        })
     }
 </script>


  @stop
