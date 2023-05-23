<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    //get all post
    public function getAllCategories()
    {
        $categoryData = Category::get();

        return response()->json([
            'categories' => $categoryData,
        ], 200);
    }
}
