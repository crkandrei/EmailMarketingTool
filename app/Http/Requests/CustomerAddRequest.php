<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:customers',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'first_name.required' => 'First name is required!',
            'last_name.required' => 'Last name is required!',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
