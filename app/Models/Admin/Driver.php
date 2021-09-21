<?php

namespace App\Models\Admin;

use App\Models\Address;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name'];
    public function address(){
        return $this->morphOne(Address::class,'addressable');
    }
    public function contact(){
        return $this->morphOne(Contact::class,'contactable');
    }
}
