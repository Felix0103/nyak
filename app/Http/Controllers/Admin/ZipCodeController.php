<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ZipCodeRequest;
use App\Models\Admin\ZipCode;
use App\Models\State;
use Illuminate\Http\Request;

class ZipCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.zipcodes.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::orderBy('name')->pluck('name','id');
        return view('admin.zipcodes.create', compact('states'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ZipCodeRequest $request)
    {
        $zipCode = ZipCode::create($request->all());


        return redirect()->route('admin.zipcodes.edit',$zipCode)->with('info', 'The zipcode has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\ZipCode  $zipCode
     * @return \Illuminate\Http\Response
     */
    public function show(ZipCode $zipCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\ZipCode  $zipCode
     * @return \Illuminate\Http\Response
     */
    public function edit(ZipCode $zipcode)
    {
        $states = State::orderBy('name')->pluck('name','id');
        return view('admin.zipcodes.edit', compact('states','zipcode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\ZipCode  $zipCode
     * @return \Illuminate\Http\Response
     */
    public function update(ZipCodeRequest $request, ZipCode $zipcode)
    {
        // dd($request->all());
        $zipcode->update($request->all());

        return redirect()->route('admin.zipcodes.edit',$zipcode)->with('info', 'The zipcode has been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\ZipCode  $zipCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(ZipCode $zipcode)
    {
        $zipcode->active = $zipcode->active ==1?0:1;
        $zipcode->update();

         return redirect()->route('admin.zipcodes.index')->with('info', 'This zip code has been '.($zipcode->active ==1? 'activated' : 'desabled').' successfully');
    }
}
