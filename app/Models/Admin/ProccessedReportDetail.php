<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProccessedReportDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['proccessed_report_id', 'file_header_id','active'];

    public function file_header(){

        return $this->belongsTo(FileHeader::class);
    }
}
