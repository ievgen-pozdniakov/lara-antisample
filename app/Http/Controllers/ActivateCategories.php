<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryActiveRequest;
use App\Models\Category;

class ActivateCategories extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CategoryActiveRequest $request, $categoryId)
    {
        $category = Category::find($categoryId);

        $category->isActive = !$category->isActive;

        $category->save();

        return $category;
    }
}
