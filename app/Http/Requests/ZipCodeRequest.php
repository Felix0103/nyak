<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZipCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $zipcode = $this->route()->parameter('zipcode');

        $rules = [
            'state_id' => 'required',
            'code' => "required|unique:zip_codes,code,$zipcode?->id",
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'purchase_price_duplicate' => 'required|numeric',
            'sale_price_duplicate' => 'required|numeric',
            'city' => "required|unique:zip_codes,city,$zipcode?->id",

        ];

        return $rules;
    }

    public function attributes(){
        return [
            'purchase_price' => 'purchase price',
            'sale_price' => 'sale price',
            'purchase_price_duplicate' => 'purchase price duplicate',
            'sale_price_duplicate' => 'sale price duplicate',
            'state_id' => 'state',

        ];
    }
}
