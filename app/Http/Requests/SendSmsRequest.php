<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendSmsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'employee_ids' => ['required_without_all:department_id,employee_id', 'array'],
            'employee_ids.*' => ['numeric', 'exists:employees,id'],
            'department_id' => ['required_without_all:employee_ids,employee_id', 'numeric', 'exists:departments,id'],
            'employee_id' => ['required_without_all:department_id,employee_ids', 'numeric', 'exists:employees,id']
        ];
    }
}
