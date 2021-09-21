<?php

use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\HomeController;
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
