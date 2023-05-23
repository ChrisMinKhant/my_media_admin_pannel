<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Empty_;

use function PHPUnit\Framework\isEmpty;

class AccountApiController extends Controller
{
    //create user account
    public static function createAccount(Request $request)
    {
        $validatedData = (new self)->validateData($request);

        $validatedData['password'] = Hash::make($request['password']);

        User::create($validatedData);

        return response()->json([
            'status' => 'Success',
        ]);
    }

    //get the specific user from the database
    public function getAccount($id)
    {
        $requestedAccount = User::where('id', $id)->first();

        return response()->json([
            'status' => 'Success',
            'accountData' => $requestedAccount,
        ]);
    }

    //update specific user from the database
    public function updateAccount(Request $request)
    {
        $id = $request['id'];

        //Validating all the user given data
        $this->validateData($request);

        //Formatting requested data to get only needed data for updatting database
        $request = array_diff($request->toArray(), [$request['id']]);

        User::where('id', $id)->update($request);

        return response()->json([
            'status' => 'You Successfully Updated Your Account!',
        ], $status = 200);
    }

    //change password
    public function changePassword(Request $request, $id)
    {
        $dbData = User::where('id', $id)->first();

        if (!Hash::check($request->oldPassword, $dbData->password)) {
            return response()->json([
                'status' => 'Your Old Password Is Incorrect!',
            ], 403);
        }

        User::where('id', $id)->update(['password' => Hash::make($request->newPassword)]);

        return response()->json([
            'status' => 'Success',
        ], 200);
    }

    //change profile photo
    public function changeProfilePhoto(Request $request)
    {
        $request->validate(['profilePhoto' => 'required|mimes:png,jpg,webp,jpeg']);

        if ($request->hasFile('profilePhoto')) {
            $fileName = uniqid() . $request->file('profilePhoto')->getClientOriginalName();
            $filePath = $request->file('profilePhoto')->storeAs('image/admin', $fileName, 'public');

            User::where('id', $request->id)->update(['profile_photo_path' => $filePath]);

            return response()->json([
                'status' => 'Profile Photo Has Been Changed Successfully! Please Log Out And Log In Again.',
            ], $status = 200);
        }
    }

    //data validation for user data
    private function validateData(Request $request)
    {
        if (!isset($request['password'])) {
            return $this->validate($request, [
                'name' => 'required',
                'email' => 'required|unique:users,email,' . $request->id,
                'phone' => 'required|numeric',
                'address' => 'required'
            ]);
        }

        return $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password',
        ]);
    }
}
