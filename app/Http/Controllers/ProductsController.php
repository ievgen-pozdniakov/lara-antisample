<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(StoreProductRequest $request)
    {
        $product = new Product();

        $data = $request->getPostData();
        $product->sku = $data['sku'];
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->amount = $data['amount'];
        $product->discount = $data['discount'];
        $product->category_id = $data['category_id'];

        $product->save();

        /** @var UploadedFile $file */
        $file = $data['file'];
        Storage::putFileAs('product-preview/' . $product->id . '/',
            $file,
            $product->sku
        );

        return $product;
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->getPostData();

        if (array_key_exists('sku', $data)) {
            $product->sku = $data['sku'];
        }
        if (array_key_exists('name', $data)) {
            $product->name = $data['name'];
        }
        if (array_key_exists('description', $data)) {
            $product->description = $data['description'];
        }
        if (array_key_exists('price', $data)) {
            $product->price = $data['price'];
        }
        if (array_key_exists('amount', $data)) {
            $product->amount = $data['amount'];
        }
        if (array_key_exists('discount', $data)) {
            $product->discount = $data['discount'];
        }
        if (array_key_exists('category_id', $data)) {
            $product->category_id = $data['category_id'];
        }

        $product->save();

        if (array_key_exists('category_id', $data)) {
            /** @var UploadedFile $file */
            $file = $data['file'];
            Storage::purge('product-preview/' . $product->id . '/' . $product->sku);
            Storage::putFileAs('product-preview/' . $product->id . '/',
                $file,
                $product->sku
            );
        }

        return $product;
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->noContent();
    }
}
