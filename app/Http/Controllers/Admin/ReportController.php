<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\FileDetail;
use App\Models\Admin\FileHeader;
use App\Models\Admin\ProccessedReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.report.sales.purchases')->only('salespurchases');
        $this->middleware('can:admin.report.sales.earnings')->only('earnings');
        $this->middleware('can:admin.report.sales.proccessed')->only('proccessed','show', 'print', 'payout');

    }

    public function salesPurchases(){

        return view('admin.reports.sales_puchase');

    }

    public function earnings(){

        return view('admin.reports.earnings');

    }

    public function proccessed(){

        return view('admin.reports.proccessed');

    }
    public function show(ProccessedReport $processedreport){

        $processedreport->with('driver','proccessed_report_details');

        $totales= FileHeader::leftJoin('file_details','file_headers.id', '=', 'file_details.file_header_id')
        ->leftJoin('drivers', 'file_headers.driver_id', '=', 'drivers.id')
        ->leftJoin('zip_codes', 'file_details.zip_code', '=', 'zip_codes.code')

        ->whereIn('file_headers.id',$processedreport->proccessed_report_details()->select('id')->pluck('id')->toArray())
        ->select(
        DB::raw(" sum(ifnull(case when file_details.active=1 then zip_codes.purchase_price else zip_codes.purchase_price_duplicate end,0) )  as purchase") ,
        DB::raw(" sum(ifnull(case when file_details.active=1 then zip_codes.sale_price else zip_codes.sale_price_duplicate end,0) )  as sale"),
        DB::raw(" sum(ifnull(case when file_details.active=1 then zip_codes.purchase_price else zip_codes.purchase_price_duplicate end,0) -
                        ifnull(case when file_details.active=1 then zip_codes.sale_price else zip_codes.sale_price_duplicate end,0)  )  as earning"),
                  DB::raw(" count(*) as entries")

        )
        ->first();

        $stops = FileDetail::whereIn('file_header_id',$processedreport->proccessed_report_details()->select('id')->pluck('id')->toArray())
        ->select( 'address')
        ->groupByRaw('address')
        ->get()->count();


        $report =
        FileHeader::leftJoin('file_details','file_headers.id', '=', 'file_details.file_header_id')
        ->leftJoin('drivers', 'file_headers.driver_id', '=', 'drivers.id')
        ->leftJoin('zip_codes', 'file_details.zip_code', '=', 'zip_codes.code')
        ->whereIn('file_headers.id',$processedreport->proccessed_report_details()->select('id')->pluck('id')->toArray())
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

        return view('admin.reports.show', compact('processedreport','totales','stops', 'report'));


    }
    public function print(ProccessedReport $processedreport){


        $processedreport->with('driver','proccessed_report_details');

        $totales= FileHeader::leftJoin('file_details','file_headers.id', '=', 'file_details.file_header_id')
        ->leftJoin('drivers', 'file_headers.driver_id', '=', 'drivers.id')
        ->leftJoin('zip_codes', 'file_details.zip_code', '=', 'zip_codes.code')
        ->whereIn('file_headers.id',$processedreport->proccessed_report_details()->select('id')->pluck('id')->toArray())
        ->select(
        DB::raw(" sum(ifnull(case when file_details.active=1 then zip_codes.purchase_price else zip_codes.purchase_price_duplicate end,0) )  as purchase") ,
        DB::raw(" sum(ifnull(case when file_details.active=1 then zip_codes.sale_price else zip_codes.sale_price_duplicate end,0) )  as sale"),
        DB::raw(" sum(ifnull(case when file_details.active=1 then zip_codes.purchase_price else zip_codes.purchase_price_duplicate end,0) -
                        ifnull(case when file_details.active=1 then zip_codes.sale_price else zip_codes.sale_price_duplicate end,0)  )  as earning"),
                  DB::raw(" count(*) as entries")
        )
        ->first();
        $stops = FileDetail::whereIn('file_header_id',$processedreport->proccessed_report_details()->select('id')->pluck('id')->toArray())
        ->select( 'address')
        ->groupByRaw('address')
        ->get()->count();


        $report =
        FileHeader::leftJoin('file_details','file_headers.id', '=', 'file_details.file_header_id')
        ->leftJoin('drivers', 'file_headers.driver_id', '=', 'drivers.id')
        ->leftJoin('zip_codes', 'file_details.zip_code', '=', 'zip_codes.code')
        ->whereIn('file_headers.id',$processedreport->proccessed_report_details()->select('id')->pluck('id')->toArray())
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

        return view('admin.reports.print', compact('processedreport','totales','stops', 'report'));

    }

    public function payout($id){

        DB::unprepared("
            update  proccessed_reports c
            left join proccessed_report_details a on c.id = a.proccessed_report_id
            left join file_details b on a.file_header_id = b.file_header_id
            set b.processed =2, c.active =2
            where c.id=$id
        ");

        return ["success" => true];

    }
}
