<?php

namespace App\Http\Requests;

class EquipmentRequest extends AbstractApiRequest
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

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'equipment_name' => '備品', 
            'purchase_year' => '購入年', 
            'maker' => 'メーカー', 
            'model' => 'モデル', 
            'status' => 'スターテス', 
            'address_id' => '住所ID',
            'registration_date' => '登録日付', 
            'registration_time' => '登録時間',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'equipment_name.required' => ':attributeは必須です', 
            'purchase_year.required' => ':attributeは必須です', 
            'maker.required' => ':attributeは必須です', 
            'model.required' => ':attributeは必須です', 
            'status.required' => ':attributeは必須です', 
            'address_id.required' => ':attributeは必須です',
            'registration_date.required' => ':attributeは必須です', 
            'registration_time.required' => ':attributeは必須です',
        ];
    }
}
