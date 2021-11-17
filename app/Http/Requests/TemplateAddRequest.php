<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemplateAddRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'form_add_subject' => 'required|string|max:255',
            'form_add_name' => 'required|string|max:255',
            'form_add_message' => 'required|string'
        ];
    }


    public function authorize(): bool
    {
        return true;
    }

}
