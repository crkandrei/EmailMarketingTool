<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAddRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'form_add_email' => 'required|email|unique:customers,email',
            'form_add_first_name' => 'required|string|max:50',
            'form_add_last_name' => 'required|string|max:50'
        ];
    }


    public function authorize(): bool
    {
        return true;
    }
}
