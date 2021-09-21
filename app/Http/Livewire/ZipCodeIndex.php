<?php

namespace App\Http\Livewire;

use App\Models\Admin\ZipCode;
use Livewire\Component;
use Livewire\WithPagination;

class ZipCodeIndex extends Component
{
    use WithPagination;
    protected $paginationTheme ='bootstrap';
    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {

        $zip_codes = ZipCode::where('description','like', '%'.$this->search.'%')
        ->orWhere('code','like', '%'.$this->search.'%')
        ->orderBy($this->sort, $this->direction)
        ->paginate(10);
        return view('livewire.zip-code-index', compact('zip_codes'));

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


