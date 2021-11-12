<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProccessedReport extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' ,    'start_date' ,    'end_date' ,    'driver_id' ,    'active']  ;

    public function driver(){
        return $this->belongsTo(Driver::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function proccessed_report_details(){
        return $this->hasMany(ProccessedReportDetail::class);
    }

}
