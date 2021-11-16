<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupAddRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'form_add_name' => 'required|string|max:100'
        ];
    }


    public function authorize(): bool
    {
        return true;
    }

}
