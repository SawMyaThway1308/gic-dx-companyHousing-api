<?php

namespace App\Http\Requests;

class AddressUpdateRequest extends AddressRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'address' => 'required',
            'type' => 'required', 
            'use_start_date' => 'required', 
            'contract_end_date' => 'required', 
            'rent' => 'required', 
            'capacity' => 'required', 
            'contract_type' => 'required', 
            'status' => 'required', 
            'registration_date' => 'required', 
            'registration_time' => 'required', 
        ];
    }
}
