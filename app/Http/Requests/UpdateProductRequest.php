<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'sku' => ['required', 'string'],
            'name' => ['required', 'string'],
            'description' => ['sometimes', 'string'],
            'price' => ['required', 'integer'],
            'amount' => ['sometimes', 'integer'],
            'discount' => ['sometimes', 'integer'],
            'category_id' => ['required', 'integer'],
            'preview' => ['file'],
        ];
    }

    public function getPostData()
    {
        $result = [];

        if ($this->get('sku')) {
            $data['sku'] = $this->get('sku');
        }
        if ($this->get('name')) {
            $data['name'] = $this->get('name');
        }
        if ($this->get('description')) {
            $data['description'] = $this->get('description');
        }
        if ($this->get('price')) {
            $data['price'] = $this->get('price');
        }
        if ($this->get('amount')) {
            $data['amount'] = $this->get('amount');
        }
        if ($this->get('discount')) {
            $data['discount'] = $this->get('discount');
        }
        if ($this->get('category_id')) {
            $data['category_id'] = $this->get('category_id');
        }
        if ($this->hasFile('preview')) {
            $data['file'] = $this->file('preview');
        }

        return $result;
    }
}
