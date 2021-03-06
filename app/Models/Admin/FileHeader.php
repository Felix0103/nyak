<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FileHeader extends Model
{
    use HasFactory;
    protected $fillable = ['driver_id', 'work_date', 'active','user_id','file_name'];


    public function file_details(){
        return $this->hasMany(FileDetail::class);
    }

    public function proccessed_report_details(){
        return $this->hasMany(ProccessedReportDetail::class);
    }

    public function fileStatus(){

        $total =$this->file_details()->count();
        if($total==0){
            return 'no deliveries';
        }
        else if ($this->file_details()->where('processed', 1)->count() == $total  ) //All ready
        {
           return 'Processed and waiting for Pay';
        }
        else if ($this->file_details()->where('processed', 2)->count() == $total  ) //All ready
        {
           return 'Paid Out';
        }
        else if ($this->file_details()->where(DB::raw("length(zip_code)") ,'=',0)->count() >0  ) //All ready
        {
            return 'zip code missing' ;


        }
        else if ($this->file_details()->where('active',2)->count() == $total  ) //All ready
        {
           return 'duplicate file';
        }


        return 'Ready to pay';
    }

    // Estatus 1--Esta Ok, 2--Esta dos veces la misma entrada, 3--Pago por duplicidad, 4-Porcesado


}
