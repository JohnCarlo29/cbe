<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('departments')
                    ->where('company_id', $this->isMethod('PUT') ? $this->department->company_id : $this->company_id)
                    ->ignore(optional($this->department)->id)
            ]
        ];

        if ($this->isMethod('POST')) {
            $rules['company_id'] = [
                'required',
                'numeric',
                'exists:companies,id',
            ];
        }

        return $rules;
    }
}
