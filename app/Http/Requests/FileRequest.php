<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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

        $rules = [
            'work_date' => 'required:date',
            'driver_id' => 'required',
            'file_to_load' => 'required|mimes:xls,xlsx,csv',
        ];


        return $rules;
    }

    public function attributes(){
        return [
            'work_date' => 'work date',
            'driver_id' => 'driver',
            'file_to_load' => 'delivery file',
        ];
    }
}
