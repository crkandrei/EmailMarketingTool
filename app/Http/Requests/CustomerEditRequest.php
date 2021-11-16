<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerEditRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'form_edit_email' => 'required|email',
            'form_edit_first_name' => 'required|string|max:50',
            'form_edit_last_name' => 'required|string|max:50'
        ];
    }


    public function authorize(): bool
    {
        return true;
    }
}
