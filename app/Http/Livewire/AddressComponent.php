<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AddressComponent extends Component
{
    public $description;
    public $country_id;
    public $state_id;
    public $city_id;
 
    public function render()
    {
        $state = State::find($this->state_id);

        $countries = Country::orderBy('name')->pluck('name','id');
        $states = State::orderBy('name')->pluck('name','id');
        $cities = City::select('id', DB::raw("concat(name, ' (', zip, ')') as name"))->where('state_code',$state?->code  )->orderBy('name')->pluck('name','id');
        return view('livewire.address-component', compact('countries','states','cities'));
    }
}
