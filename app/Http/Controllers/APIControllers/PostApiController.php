<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    //get all post
    public function getAllPosts()
    {
        $postData = Post::join('categories', 'categories.id', 'posts.category_id')
            ->select('posts.*', 'categories.title as cateogry')
            ->get();

        return response()->json([
            'posts' => $postData,
        ], 200);
    }
}
