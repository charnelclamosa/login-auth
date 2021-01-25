<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Login
    public function login(Request $request) {
        // Validate request
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:5'
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
                'status' => 422
            ]);
        }
        $user = User::where('email', $request->email)->first();
        if($user) {
            if(Hash::check($request->password, $user->password)) {
                return $user->createToken($user->name)->plainTextToken;
                // return response()->json([
                //     'token' => $token,
                //     'status' => 200
                // ]);
            } else {
                $response = ['message' => 'Password mismatch.'];
                return response()->json([
                    'message' => 'Password mismatch.',
                    'status' => 401
                ]);
            }
        } else {
            return response()->json([
                'message' => 'User does not exist',
                'status' => 401
            ]);
        }
    }

    // Logout
    public function logout(Request $request) {
        // Revoke user's token
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout successful.'
        ]);
    }
}
