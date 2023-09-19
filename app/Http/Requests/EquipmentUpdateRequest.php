<?php

namespace App\Http\Requests;

class EquipmentUpdateRequest extends EquipmentRequest
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
            'equipment_name' => 'required', 
            'purchase_year' => 'required', 
            'maker' => 'required', 
            'model' => 'required', 
            'status' => 'required', 
            'address_id' => 'required',
            'registration_date' => 'required', 
            'registration_time' => 'required'
        ];
    }
}
