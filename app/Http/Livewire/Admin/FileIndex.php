<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\FileHeader;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class FileIndex extends Component
{
    use WithPagination;
    protected $paginationTheme ='bootstrap';
    public $search;
    public $sort = 'work_date';
    public $direction = 'desc';

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {

        $fileHeaders = FileHeader::with('file_details')
        ->leftJoin('drivers', 'file_headers.driver_id', '=', 'drivers.id')
        ->where('file_headers.file_name','like', '%'.$this->search.'%')
        ->orWhere('drivers.first_name','like', '%'.$this->search.'%')
        ->orWhere('drivers.last_name','like', '%'.$this->search.'%')
        ->orderBy($this->sort, $this->direction)
        ->select('file_headers.*' ,DB::raw("concat(first_name,' ', last_name ) as driver_name"))
        ->paginate(10);
        return view('livewire.admin.file-index', compact('fileHeaders'));
    }

    public function order($sort){

        if($this->sort == $sort){
            if($this->direction=='desc'){
                $this->direction ='asc';
            }else{
                $this->direction ='desc';
            }
        }else{
            $this->sort =$sort;
            $this->direction ='asc';
        }
    }
}
