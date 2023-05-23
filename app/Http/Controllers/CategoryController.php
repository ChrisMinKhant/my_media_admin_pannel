<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryData = Category::orderBy('created_at', 'desc')->paginate(6);
        return view('Category.index', compact('categoryData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => ['required', 'mimes:png,jpg,jpeg,webp'],
            'title' => ['required', 'unique:categories,title'],
            'description' => ['required', 'unique:categories,description'],
        ]);

        $fileName =  uniqid() . $request->file('image')->getClientOriginalName();
        $validatedData['image'] = $request->file('image')->storeAs('image/category', $fileName, 'public');

        Category::create($validatedData);

        return back()->with(['status' => 'You Created Successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoryData = Category::where('id', $id)->first();
        return view('Category.show', compact('categoryData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoryData = Category::where('id', $id)->first();
        return view('Category.edit', compact('categoryData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validatedData = $request->validate([
            'image' => ['mimes:png,jpg,jpeg,webp'],
            'title' => ['required', 'unique:categories,title,' . $id],
            'description' => ['required', 'unique:categories,description,' . $id],
        ]);

        if ($request->hasFile('image')) {
            // Delete Old Image
            $dbData = Category::where('id', $id)->first('image')->toArray();
            if ($dbData['image'] != null) {
                Storage::disk('public')->delete($dbData['image']);
            };

            //Store New Image
            $fileName =  uniqid() . $request->file('image')->getClientOriginalName();
            $validatedData['image'] = $request->file('image')->storeAs('image/category', $fileName, 'public');
        }

        Category::where('id', $id)->update($validatedData);

        return back()->with(['status' => 'You Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::where('id', $id)->delete();
        return back();
    }
}
