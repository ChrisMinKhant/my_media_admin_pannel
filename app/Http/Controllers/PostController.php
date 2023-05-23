<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LikeComment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postData = Post::join('categories', 'posts.category_id', 'categories.id')
            ->select('posts.*', 'categories.title as category')
            ->orderBy('created_at', 'asc')
            ->paginate(5);

        $categoryData = Category::get();

        return view('Post.index', compact('postData', 'categoryData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => ['required', 'mimes:png,jpg,jpeg'],
            'title' => ['required', 'unique:posts,title'],
            'description' => ['required', 'unique:posts,description'],
            'category_id' => ['required'],
        ]);

        $fileName =  uniqid() . $request->file('image')->getClientOriginalName();
        $filePath = $request->file('image')->storeAs('image/post', $fileName, 'public');

        $validatedData['image'] = $filePath;

        Post::create($validatedData);

        return back()->with(['status' => 'You Created Successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $likeCountData = LikeComment::where('post_id', $id)->where('like', 1)->get()->count();
        $commentCountData = LikeComment::where('post_id', $id)->where('comment', '!=', null)->get()->count();

        $postData = Post::where('posts.id', $id)
            ->join('categories', 'posts.category_id', 'categories.id')
            ->select('posts.*', 'categories.title as category')
            ->first();

        return view('post.show', compact('postData', 'likeCountData', 'commentCountData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $postData = Post::where('posts.id', $id)->first();
        $categoryData = Category::get();

        return view('post.edit', compact('postData', 'categoryData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'image' => ['mimes:png,jpg,jpeg'],
            'title' => ['required', 'unique:posts,title,' . $id],
            'description' => ['required', 'unique:posts,description,' . $id],
            'category_id' => ['required'],
        ]);

        if ($request->hasFile('image')) {
            // Delete Old Image
            $dbData = Post::where('id', $id)->first('image')->toArray();
            if ($dbData['image'] != null) {
                Storage::disk('public')->delete($dbData['image']);
            };

            //Store New Image
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $validatedData['image'] = $request->file('image')->storeAs('image/post', $fileName, 'public');
        }

        Post::where('id', $id)->update($validatedData);

        return back()->with(['status' => 'You updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::where('id', $id)->delete();

        return back()->with(['status' => 'You deleted successfully!']);
    }
}
