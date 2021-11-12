<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Driver;
use App\Models\Admin\ProccessedReport;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Proccessed extends Component
{
    use WithPagination;

    public $date1;
    public $date2;
    public $driver_id;
    public $canFind;
    public $sort = 'id';
    public $direction = 'desc';

    public function updatingDate1(){
        $this->canFind = 0;
    }
    public function updatingDate2(){
        $this->canFind = 0;
    }
    public function updatingDriverId(){
        $this->canFind = 0;
    }
    public function mount(){

        $this->date1 = date('Y-m-d', strtotime("-6 days"));
        $this->date2 = date('Y-m-d');
        $this->driver_id =0;
        $this->canFind = 0;

    }
    public function render()
    {
        $processed = ProccessedReport::with('user','driver')
        ->where(function($query) {
            $query->whereBetween('start_date', [$this->date1, $this->date2])
            ->orWhereBetween('end_date', [$this->date1, $this->date2]);
        })
        ->where('driver_id', ($this->driver_id==0?'!=': '=') , $this->driver_id)
        ->whereRaw($this->canFind.'=?',1 )
        ->paginate(10);
        $drivers = Driver::select('id', DB::raw("concat(first_name, ' ', last_name) as name"))
        ->orderBy('name')->pluck('name','id');
        // $this->canFind =0;
        return view('livewire.admin.proccessed', compact('processed', 'drivers'));
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

    public function search(){
        $this->canFind =1;
        $this->render();
    }
}
