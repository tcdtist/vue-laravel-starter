<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'full_name' => 'required|string|min:7|max:255',
            'phone_number' => 'required|string|min:7|max:255',
            'address' => 'nullable|string|min:3|max:255',
            'status' => 'required|integer|between:0,1',
        ];

        switch ($this->method()) {
            case 'POST':
                $rules['identification_number'] = 'required|string|min:8|max:255|unique:users';
                $rules['email'] = 'required|email|unique:users';
                $rules['password'] = 'required|min:6|max:15|string|confirmed';
                break;

            case 'PUT':
                $rules['identification_number'] = 'required|string|min:8|max:255|unique:users,identification_number,'.$this->id;
                $rules['email'] = 'required|email|unique:users,email,'.$this->id;
                $rules['password'] = 'nullable|min:6|max:15|confirmed';
                break;
        }

        return $rules;
    }

    protected function passedValidation()
    {
        if ($this->password) {
            $this->merge([
                'password' => bcrypt($this->password),
            ]);
        }
    }
}
