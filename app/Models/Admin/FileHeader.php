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

    public function fileStatus(){

        $result = $this->file_details;
        $total =$result->count();
        if($result->count()==0){
            return 'no deliveries';
        }
        else if ($result->where('active',1)->count() == $total  ) //All ready
        {
            if($result->where(DB::raw("len(zip_code)") ,'<',0)->count() < $total ){
                return 'zip code missing';
            }
        }
        else if ($result->where('active',2)->count() == $total  ) //All ready
        {
           return 'duplicate file';
        }
        else if ($result->where('active',4)->count() == $total  ) //All ready
        {
           return 'Paid Out';
        }

        return 'Ready to pay';
    }

    // Estatus 1--Esta Ok, 2--Esta dos veces la misma entrada, 3--Pago por duplicidad, 4-Porcesado


}
