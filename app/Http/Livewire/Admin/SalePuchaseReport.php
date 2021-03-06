<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Driver;
use App\Models\Admin\FileDetail;
use App\Models\Admin\FileHeader;
use App\Models\Admin\ProccessedReport;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\PseudoTypes\True_;

class SalePuchaseReport extends Component
{

    public $date1;
    public $date2;
    public $driver_id;
    public $search;

    public $sale;
    public $purchase;
    public $earning;
    public $entries;

    public function mount(){

        $this->date1 = date('Y-m-d');
        $this->date2 = date('Y-m-d');
        $this->driver_id =0;
        $this->search;

    }

    public function render()
    {
        $report_info = null;
        if($this->search ==1){
            $report_info = $this->report();
            $this->search =0;
        }

        $drivers = Driver::select('id', DB::raw("concat(first_name, ' ', last_name) as name"))
        ->orderBy('name')->pluck('name','id');
        return view('livewire.admin.sale-puchase-report', compact('drivers', 'report_info' ));
    }

    public function search(){
        $this->search =1;
    }

    public function proccess(){

        $totales= FileHeader::leftJoin('file_details','file_headers.id', '=', 'file_details.file_header_id')
        ->leftJoin('drivers', 'file_headers.driver_id', '=', 'drivers.id')
        ->leftJoin('zip_codes', 'file_details.zip_code', '=', 'zip_codes.code')
        ->whereBetween('work_date', [$this->date1, $this->date2])
        ->where('drivers.id', ($this->driver_id==0?'!=': '=') , $this->driver_id)
        ->whereIn('file_details.active',[1,3])
        ->select(
            DB::raw(" sum( case when length(file_details.zip_code) =0 then 1 else 0 end ) as missing_code") ,
            DB::raw(" sum( case when length(file_details.zip_code) >0 and zip_codes.id is null then 1 else 0 end ) as no_created") ,
            DB::raw(" count(*) as entries")
        )
        ->first();

        $message ="";
        if($totales->missing_code >0)
        {
            $message  = "$totales->missing_code unassigned zip code missing";
        }
        if($totales->no_created >0)
        {
            $message  .= (strlen( $message ) > 0?" and ":"")."you have $totales->no_created  zip code without creating";
        }

        if(strlen( $message ) > 0){
            session()->flash('message_error', $message);
            // return;
        }

        $toProccess = FileHeader::leftJoin('file_details','file_headers.id', '=', 'file_details.file_header_id')
        ->leftJoin('drivers', 'file_headers.driver_id', '=', 'drivers.id')
        ->leftJoin('zip_codes', 'file_details.zip_code', '=', 'zip_codes.code')
        ->whereBetween('work_date', [$this->date1, $this->date2])
        ->where('drivers.id', ($this->driver_id==0?'!=': '=') , $this->driver_id)
        ->whereIn('file_details.active',[1,3])
        ->orderBy('work_date','desc')
        ->orderBy('address', 'desc')
        ->orderBy('file_details.active', 'asc')
        ->select('file_details.id')
        ->pluck('id');

        FileDetail::whereIn('id', $toProccess->toArray())
        ->update(['processed' => 1]);

        $processed = ProccessedReport::create([
            'user_id' => Auth::id(),
            'start_date' => $this->date1,
            'end_date' => $this->date2,
            'driver_id' => $this->driver_id,
            'active' => 1
        ]);
        $headers = FileDetail::whereIn('id', $toProccess->toArray())
        ->select('file_header_id',  DB::raw(" 1 as active") )
        ->groupByRaw('file_header_id')
        ->get();

        $processed->proccessed_report_details()->createMany($headers->toArray());
        session()->flash('message', "Report processed successfully");
    }

    private function report(){


        $totales= FileHeader::leftJoin('file_details','file_headers.id', '=', 'file_details.file_header_id')
        ->leftJoin('drivers', 'file_headers.driver_id', '=', 'drivers.id')
        ->leftJoin('zip_codes', 'file_details.zip_code', '=', 'zip_codes.code')
        ->whereBetween('work_date', [$this->date1, $this->date2])
        ->where('drivers.id', ($this->driver_id==0?'!=': '=') , $this->driver_id)
        ->whereIn('file_details.active',[1,3])
        ->select(
        DB::raw(" sum(ifnull(case when file_details.active=1 then zip_codes.purchase_price else zip_codes.purchase_price_duplicate end,0) )  as purchase") ,
        DB::raw(" sum(ifnull(case when file_details.active=1 then zip_codes.sale_price else zip_codes.sale_price_duplicate end,0) )  as sale"),
        DB::raw(" sum(ifnull(case when file_details.active=1 then zip_codes.purchase_price else zip_codes.purchase_price_duplicate end,0) -
                        ifnull(case when file_details.active=1 then zip_codes.sale_price else zip_codes.sale_price_duplicate end,0)  )  as earning"),
                  DB::raw(" count(*) as entries")
        )
        ->first();

        $this->sale = $totales->sale;
        $this->purchase = $totales->purchase;
        $this->entries = $totales->entries;
        $this->earning = $totales->earning;

       return $this->report =
        FileHeader::leftJoin('file_details','file_headers.id', '=', 'file_details.file_header_id')
        ->leftJoin('drivers', 'file_headers.driver_id', '=', 'drivers.id')
        ->leftJoin('zip_codes', 'file_details.zip_code', '=', 'zip_codes.code')
        ->whereBetween('work_date', [$this->date1, $this->date2])
        ->where('drivers.id', ($this->driver_id==0?'!=': '=') , $this->driver_id)
        ->whereIn('file_details.active',[1,3])
        ->orderBy('work_date','desc')
        ->orderBy('address', 'desc')
        ->orderBy('file_details.active', 'asc')
        ->select('file_headers.work_date' , 'file_details.*' ,DB::raw("concat(first_name,' ', last_name ) as driver_name"),
        DB::raw(" ifnull(case when file_details.active=1 then zip_codes.purchase_price else zip_codes.purchase_price_duplicate end,0)   as purchase") ,
        DB::raw(" ifnull(case when file_details.active=1 then zip_codes.sale_price else zip_codes.sale_price_duplicate end,0)   as sale"),
        DB::raw(" ifnull(case when file_details.active=1 then zip_codes.purchase_price else zip_codes.purchase_price_duplicate end,0) -
                  ifnull(case when file_details.active=1 then zip_codes.sale_price else zip_codes.sale_price_duplicate end,0)   as earning")
        )
        ->get();



    }
}
// id	state_id	description	code		sale_price			active	created_at	updated_at
// 1	39	Codigo Test	12300	1.00	1.50	0.50	0.50	1	2021-11-02 04:34:54	2021-11-02 04:34:54
