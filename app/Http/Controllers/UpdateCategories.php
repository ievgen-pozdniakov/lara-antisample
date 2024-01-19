<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCategotyRequest;
use App\Models\Category;

class UpdateCategories extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateCategotyRequest $request, $categoryId)
    {
        $enableInactive = $request->get('showHidden');

        if ($enableInactive) {
            $category = Category::withoutGlobalScope('active')->find($categoryId);
        } else {
            $category = Category::find($categoryId);
        }

        $category->name = $request->getDataArray()['name'];
        $category->description = $request->getDataArray()['description'];

        $category->save();

        return $category;
    }
}
