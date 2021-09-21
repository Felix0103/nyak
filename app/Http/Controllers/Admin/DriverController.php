<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Models\Admin\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.drivers.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DriverRequest $request)
    {
        
        $driver = Driver::create($request->all());
        $driver->address()->create($request->all());
        $driver->contact()->create($request->all());

        return redirect()->route('admin.drivers.edit',$driver)->with('info', 'This driver has been created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        
        return view('admin.drivers.edit', compact('driver'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(DriverRequest $request, Driver $driver)
    {
        $driver->update($request->all());
        if($driver->address){
            $driver->address->update($request->all());
        }else{
            $driver->address()->create($request->all());
        }
        if($driver->contact){
            $driver->contact->update($request->all());
        }else{
            $driver->contact()->create($request->all());
        }
        return redirect()->route('admin.drivers.edit',$driver)->with('info', 'This driver has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $driver->active = $driver->active ==1?0:1;
        $driver->update();

        return redirect()->route('admin.drivers.index')->with('info', 'This driver has been '.($driver->active ==1? 'activated' : 'desabled').' successfully');
    }
}
