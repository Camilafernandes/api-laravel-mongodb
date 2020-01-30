<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersValidation extends Request
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
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'cpf' => 'required|integer',
            'gender' => 'required',
            'date_of_birth' => 'required|date|date_format:Y-m-d',
            'rg' => 'required|integer',
            'agency' => 'required',
            'marital_status' => 'required',
            'nationality' => 'required',
            'place_of_birth' => 'required',
            'occupation' => 'required',
            'postcode' => 'required|integer',
            'address' => 'required',
            'number' => 'required',
            'secondary_address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            "contact.*"  => [
                'type' => 'required',
                'value' => 'required',   // input must be of type string
            ],
            'license' => 'required|mimes:pdf,docx,jpeg,png,gif|max:3072', //3MB
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campos obrigatórios não informados'
        ];
    }
}
