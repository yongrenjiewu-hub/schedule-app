<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

     //バリデーション
    public function rules()
    {
        return [
            'room_id' => 'required|int',
            'pt_name' => 'required|string|min:3|max:255',
            'sex' => 'required|in:0,1,2,3',
            'blood_type' => 'required',
            'birthday' => 'required|date|before:today',
            'disease_id' => 'required|int',
            'Dr_name' => 'required|string|min:3|max:255',
            
        
            //
        ];
    }
}
