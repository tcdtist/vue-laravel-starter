<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
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
                $rules['title'] = 'required|string|min:3|max:250|unique:payment_methods';
                break;

            case 'PUT':
                $rules['title'] = 'required|string|min:3|max:250|unique:payment_methods,title,'.$this->id;
                break;
        }

        return $rules;
    }
}
