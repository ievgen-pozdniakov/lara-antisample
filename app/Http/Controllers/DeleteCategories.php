<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DeleteCategories extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $categoryId)
    {
        $enableInactive = $request->get('showHidden');

        $category = Category::find($categoryId);
        if ($enableInactive) {
            $category = Category::withoutGlobalScope('active')->find($categoryId);
        }

        $category->delete();

        return response()->noContent();
    }
}
