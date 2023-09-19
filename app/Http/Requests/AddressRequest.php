<?php

namespace App\Http\Requests;

class AddressRequest extends AbstractApiRequest
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

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'address' => '住所',
            'type' => '種類', 
            'use_start_date' => '利用開始日', 
            'contract_end_date' => '契約終了日', 
            'rent' => '家賃＋共益費', 
            'capacity' => '定員', 
            'contract_type' => '契約タイプ', 
            'status' => 'スターテス', 
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
            'address.required' => ':attributeは必須です',
            'type.required' => ':attributeは必須です',
            'use_start_date.required' => ':attributeは必須です',
            'contract_end_date.required' => ':attributeは必須です',
            'rent.required' => ':attributeは必須です',
            'capacity.required' => ':attributeは必須です',
            'contract_type.required' => ':attributeは必須です',
            'status.required' => ':attributeは必須です',
            'registration_date.required' => ':attributeは必須です',
            'registration_time.required' => ':attributeは必須です',
        ];
    }
}
