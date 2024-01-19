<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListCategories extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $enableInactive = $request->get('showHidden');

        if ($enableInactive) {
            return Category::withoutGlobalScope('active')->get();
        }
        else {
            return DB::table('categories')->distinct()->get();
        }
    }
}
