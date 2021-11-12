<?php

use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\FileDetailController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ZipCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->middleware('can:admin.home')->name('admin.home');


Route::resource('users', UserController::class)->only(['index','edit','update'])->names('admin.users');
Route::resource('roles', RoleController::class)->names('admin.roles');
Route::resource('zipcodes', ZipCodeController::class)->names('admin.zipcodes');
Route::resource('drivers', DriverController::class)->names('admin.drivers');
Route::resource('files', FileController::class)->names('admin.files');

Route::get('report/sales_purchases', [ReportController::class,'salespurchases'])->name('admin.report.sales.purchases');
Route::get('report/earnings', [ReportController::class,'earnings'])->name('admin.report.sales.earnings');
Route::get('report/processed', [ReportController::class,'proccessed'])->name('admin.report.sales.proccessed');
Route::get('report/processed/show/{processedreport}', [ReportController::class,'show'])->name('admin.report.sales.proccessed.show');
Route::get('report/processed/print/{processedreport}', [ReportController::class,'print'])->name('admin.report.sales.proccessed.print');
Route::put('report/processed/payout/{id}',[ReportController::class,'payout'] )->name('admin.report.sales.proccessed.payout');

Route::put('file/update_zip_code/{filedetail}', [FileDetailController::class,'updateZipCode'])->name('admin.file.update.zipcode');
