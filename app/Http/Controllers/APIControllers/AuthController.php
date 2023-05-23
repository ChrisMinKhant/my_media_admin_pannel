<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login user
    public function login(Request $request)
    {
        $dbUser = User::where('email', $request['email'])->first();

        if (!empty($dbUser)) {
            if (Hash::check($request['password'], $dbUser->password)) {
                return response()->json([
                    'user' => $dbUser,
                    'apiToken' => $dbUser->createToken(Carbon::now())->plainTextToken,
                ]);
            }
        }

        return response()->json([
            'user' => null,
            'apiToken' => null,
        ], $status = 200);
    }

    //register user
    public function register(Request $request)
    {
        AccountApiController::createAccount($request);

        return response()->json([
            'status' => 'Account Has Been Created Successfully!',
        ], $status = 200);
    }
}
