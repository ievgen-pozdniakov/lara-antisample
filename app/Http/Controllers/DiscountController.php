<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    public function setProductDiscount(Request $request, $productId)
    {
        DB::table('products')
            ->where('id', $productId)
            ->update(['discount' => $request->get('discount', 0)]);

        return response()->noContent();
    }

    public function setCategoryDiscount(Request $request, $categoryId)
    {
        DB::table('products')
            ->where('category_id', $categoryId)
            ->update(['discount' => $request->get('discount', 0)]);

        return response()->noContent();
    }

    public function resetDiscount()
    {
        DB::table('products')
            ->where('amount', '>=', 0)
            ->update(['discount' => 0]);

        return response()->noContent();
    }
}
