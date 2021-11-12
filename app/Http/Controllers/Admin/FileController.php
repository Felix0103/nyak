<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\Imports\FilesImport;
use App\Models\Admin\Driver;
use App\Models\Admin\FileHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.files.index')->only('index');
        $this->middleware('can:admin.files.edit')->only('edit','update');
        $this->middleware('can:admin.files.destroy')->only('destroy');
    }
    public function index()
    {

        return view('admin.files.index');

    }

    public function create()
    {
        $drivers = Driver::select('id', DB::raw("concat(first_name, ' ', last_name) as name"))
        ->orderBy('name')->pluck('name','id');

        if(!$drivers->count()){
            return redirect()->route('admin.drivers.create')->with('info', 'Must create a driver before loading a file');
        }
        return view('admin.files.create', compact('drivers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FileRequest $request)
    {

        DB::beginTransaction();

        try {

            if(!$request->hasFile('file_to_load')){
                throw new \Exception("Must select a file to load");
            }

            $fileName =$request->file('file_to_load')->getClientOriginalName();

            $fileHeader = FileHeader::create(
                [
                    'user_id'=>auth()->user()->id, 'driver_id'=>$request->input('driver_id'),
                    'work_date'=>$request->input('work_date'),
                    'file_name' => $fileName
                ]
            );
            $file= $request->file_to_load;

            Excel::import(new FilesImport($fileHeader->id), $file);


            DB::commit();

            DB::unprepared("
                update file_details a
                left join zip_codes b on a.address like CONCAT('%', b.city,'%')
                set a.zip_code = b.code
                where a.file_header_id={$fileHeader->id} and b.id is not null
            ");
            DB::unprepared("
                update file_details a
                left join file_details b on a.barcode=b.barcode and a.file_header_id<>b.file_header_id and b.active in(1,3)
                set a.active =2
                where a.file_header_id={$fileHeader->id} and b.id is not null
            ");
            DB::unprepared("
                update file_details set active =3
                where id in
                (select * from (select id from file_details
                where file_header_id={$fileHeader->id} and id not in (select min(a.id) from `file_details` as a where a.file_header_id={$fileHeader->id} and a.active =1 group by a.address having count(*) >1 )
                and address in (select b.address from `file_details` as b where b.file_header_id={$fileHeader->id} and b.active =1 group by b.address having count(*) >1 ) and active =1 ) as J )

            ");

            // Estatus 1--Esta Ok, 2--Esta dos veces la misma entrada, 3--Pago por duplicidad, 4-Procesado

            return redirect()->route('admin.files.edit',$fileHeader)->with('info', 'This files has been loaded successfully');

        }
        catch(\Maatwebsite\Excel\Validators\ValidationException $e)
        {
            $failures = $e->failures();
            foreach ($failures as  $failure) {
               $failure->row();
               $failure->attribute();
               $failure->errors();
               $failure->values();
            }
            DB::rollback();
        }
        catch (\Throwable $th) {
            DB::rollback();
            echo $th->getMessage();
        }

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
    public function edit(FileHeader $file)
    {
        $drivers = Driver::select('id', DB::raw("concat(first_name, ' ', last_name) as name"))
        ->orderBy('name')->pluck('name','id');
        return view('admin.files.edit', compact('drivers', 'file'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileHeader $fileheader)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fileheader = FileHeader::findOrFail($id);
        $fileheader->active =0;
        $fileheader->update();
        return $fileheader;
    }


}
