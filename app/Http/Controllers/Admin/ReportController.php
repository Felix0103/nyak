<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function salesPurchases(){

        return view('admin.reports.sales_puchase');

    }

    public function earnings(){

        return view('admin.reports.earnings');

    }
}
