<?php

namespace App\Http\Requests;

class EmployeeRequest extends AbstractApiRequest
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
            'employee_id' => 'required|max:5|unique:t_employee,employee_id',
            'employee_name' => 'required|max:20',
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
            'employee_id' => '社員ID',
            'employee_name' => '社員名',
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
            'employee_id.required' => ':attributeは必須です',
            'employee_name.required' => ':attributeは必須です',
        ];
    }
}
