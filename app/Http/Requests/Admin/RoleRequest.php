<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'status' => 'required|integer|between:0,1',
        ];

        switch ($this->method()) {
            case 'POST':
                $rules['name'] = 'required|string|min:3|max:250|unique:roles';
                break;

            case 'PUT':
                $rules['name'] = 'required|string|min:3|max:250|unique:roles,name,'.$this->id;
        }

        return $rules;
    }
}
