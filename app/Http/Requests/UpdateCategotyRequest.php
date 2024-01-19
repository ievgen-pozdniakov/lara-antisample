<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategotyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data.name' => ['required', 'string'],
            'data.description' => ['sometimes', 'required', 'string'],
        ];
    }

    public function getDataArray() {
        return [
            'name' => $this->get('data.name'),
            'description' => $this->get('data.description'),
        ];
    }
}
