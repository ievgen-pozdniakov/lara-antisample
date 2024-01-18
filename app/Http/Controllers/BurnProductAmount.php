<?php

namespace App\Http\Controllers;

use App\Models\Product;

class BurnProductAmount extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($productId)
    {
        $product = Product::find($productId);

        $product->amount = 0;

        $product->save();

        return response()->noContent();
    }
}
