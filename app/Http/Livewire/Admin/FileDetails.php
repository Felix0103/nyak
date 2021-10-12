<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\FileDetail;
use Livewire\Component;
use Livewire\WithPagination;

class FileDetails extends Component
{
    use WithPagination;
    protected $paginationTheme ='bootstrap';
    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    public $fileId;
    public $address;
    public function mount($file){


        $this->fileId = $file->id;
    }



    public function updatingAddress(){
        $this->resetPage();
    }
    public function render()
    {

        $fileDetails = FileDetail::where('file_header_id', $this->fileId)
        ->where(function($query) {
            $query->where('address', 'like',  '%'.$this->address.'%')
                ->orWhereRaw("length('".($this->address??"")."')=?",0);
        })
        ->orderBy($this->sort, $this->direction)
        ->paginate(10);




        return view('livewire.admin.file-details', compact('fileDetails'));
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