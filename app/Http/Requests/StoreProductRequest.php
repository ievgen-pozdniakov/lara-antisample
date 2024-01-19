<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data.sku' => ['required', 'string'],
            'data.name' => ['required', 'string'],
            'data.description' => ['sometimes', 'string'],
            'data.price' => ['required', 'integer'],
            'data.amount' => ['sometimes', 'integer'],
            'data.discount' => ['sometimes', 'integer'],
            'data.category_id' => ['required', 'integer'],
            'preview' => ['file'],
        ];
    }

    public function getPostData()
    {
        return [
            'sku' => $this->get('data.sku') ?? 'default_sku',
            'name' => $this->get('data.name') ?? 'default_name',
            'description' => $this->get('data.description'),
            'price' => $this->get('data.price', 1),
            'amount' => $this->get('data.amount', 1),
            'discount' => $this->get('data.discount', 0),
            'category_id' => $this->get('data.category_id', null),
            'file' => $this->file('preview'),
        ];
    }
}
