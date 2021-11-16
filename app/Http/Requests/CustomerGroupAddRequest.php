<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerGroupAddRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'form_add_customer_id' => 'required',
            'form_add_group_id' => 'required',
        ];
    }


    public function authorize(): bool
    {
        return true;
    }
}
