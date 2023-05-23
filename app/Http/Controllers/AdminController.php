<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    use PasswordValidationRules;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adminListData = User::orderBy('created_at', 'desc')->paginate(7);

        return view('Admin.list', compact('adminListData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'profileImage' => ['mimes:png,jpg,webp,jpeg'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'password_confirmation' => ['required', 'same:password'],
            'phone'  => ['required', 'numeric', 'max_digits:13'],
            'address' => ['required', 'string'],
        ]);

        $fileName = uniqid() . $request->file('profileImage')->getClientOriginalName();
        $filePath = $request->file('profileImage')->storeAs('image', $fileName, 'public');

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'profile_photo_path' => $filePath,
        ]);

        return redirect()->back()->with(['status' => 'You Created Successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $adminData = User::where('id', $id)->first();

        return view('Admin.show', compact('adminData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $adminData = User::where('id', $id)->first();

        return view('Admin.edit', compact('adminData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'profile_photo_path' => ['mimes:png,jpg,webp,jpeg'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'phone'  => ['required', 'numeric', 'max_digits:13'],
            'address' => ['required', 'string'],
        ]);

        if ($request->hasFile('profile_photo_path')) {
            // Delete Old Image
            $dbData = User::where('id', $id)->first('profile_photo_path')->toArray();
            if ($dbData['profile_photo_path'] != null) {
                Storage::disk('public')->delete($dbData['profile_photo_path']);
            };

            // Store New Image
            $fileName = uniqid() . $request->file('profile_photo_path')->getClientOriginalName();
            $filePath = $request->file('profile_photo_path')->storeAs('image/admin', $fileName, 'public');
            $validatedData['profile_photo_path'] = $filePath;
        }

        User::where('id', $id)->update($validatedData);

        return redirect()->back()->with(['status' => 'You Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();

        return redirect()->route('admin.index');
    }
}
