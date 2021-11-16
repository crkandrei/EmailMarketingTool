<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemplateEditRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'form_edit_subject' => 'required|string|max:100',
            'form_edit_message' => 'required|string'
        ];
    }


    public function authorize(): bool
    {
        return true;
    }
}
