<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller
{
    use ThrottlesLogins;
    protected $maxAttempts = 5;
    protected $decayMinutes = 1;
    protected function username()
    {
        return 'error';
    }
    // Login
    public function login(Request $request) {
        // Validate request
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:5'
        ]);
        if($validator->fails()) {
            if($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);
				return $this->sendLockoutResponse($request);
            } else {
                $this->incrementLoginAttempts($request);
                return response()->json(['errors' => $validator->errors()->all()], 422);
            }
        }
        $user = User::where('email', $request->email)->first();
        if($user && Hash::check($request->password, $user->password)) {
            $this->clearLoginAttempts($request);
            $token = $user->createToken($user->name)->plainTextToken;
            return response($token, 201);
        } else {
            if($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);
				return $this->sendLockoutResponse($request);
            } else {
                $this->incrementLoginAttempts($request);
                return response()->json(['message' => 'User does not exist'], 404);
            }
        }
    }

    // Logout
    public function logout(Request $request) {
        // Revoke user's token
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logout successful.'
        ]);
    }
}
