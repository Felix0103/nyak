<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
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
        // $driver = $this->route()->parameter('driver');
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required'
        ];


        return $rules;
    }

    public function attributes(){
        return [
            'first_name' => 'first name',
            'last_name' => 'last name',
        ];
    }
}
