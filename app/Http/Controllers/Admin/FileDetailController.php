<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\FileDetail;
use Illuminate\Http\Request;

class FileDetailController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }

    public function updateZipCode(Request $request, FileDetail $filedetail){

        $filedetail->zip_code = $request->zip_code;
        $filedetail->update();

        return $filedetail;

    }
}
