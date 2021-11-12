<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\FileDetail;
use Illuminate\Support\Facades\DB;
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
    public $onlywithOutZipCode = false;
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
                ->orWhereRaw("length('".($this->address??"")."')=?",0)
                ->orWhere('zip_code','like', '%'.$this->address.'%');
        })
        ->whereRaw("length(zip_code) ". ($this->onlywithOutZipCode?"=":">=")."?", 0 )
        ->orderBy($this->sort, $this->direction)
        ->paginate(10);




        return view('livewire.admin.file-details', compact('fileDetails'));
    }
    public function allZipCode(){
        $this->onlywithOutZipCode = !$this->onlywithOutZipCode;
        $this->resetPage();

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

    public function assignZipCode(){

        DB::unprepared("
        update file_details a
        left join zip_codes b on a.address like CONCAT('%', b.city,'%')
        set a.zip_code = b.code
        where a.file_header_id={$this->fileId} and b.id is not null
        ");
        $this->allZipCode();

        session()->flash('message', "The Zip Code has been assigned successfully");

    }
}
