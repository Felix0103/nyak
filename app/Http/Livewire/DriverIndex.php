<?php

namespace App\Http\Livewire;

use App\Models\Admin\Driver;
use Livewire\Component;
use Livewire\WithPagination;

class DriverIndex extends Component
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

        $drivers = Driver::where('first_name','like', '%'.$this->search.'%')
        ->orWhere('last_name','like', '%'.$this->search.'%')
        ->orderBy($this->sort, $this->direction)
        ->paginate(10);
        return view('livewire.driver-index', compact('drivers'));
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
