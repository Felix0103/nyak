<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileDetail extends Model
{
    use HasFactory;
    protected $fillable =[ 'file_header_id','barcode','status','name','address','seq_no','zip_code','active'];

    public function file_header(){
        return $this->belongsTo(FileHeader::class);
    }
}
