<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'description', 'purchase_price', 'sale_price', 'purchase_price_duplicate', 'sale_price_duplicate','active', 'state_id'];
}
