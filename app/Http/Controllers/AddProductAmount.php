<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AddProductAmount extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($productId, $amount)
    {
        $product = Product::find($productId);

        $product->amount += $amount;

        if ($product->amount >= 0) {
            $product->save();
        }

        return $product;
    }
}
