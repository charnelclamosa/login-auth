<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request) {
        // Validate
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:5'
        ]);
        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors->all()], 400);
        }
        // Check if email already exist
        $user = User::where('email', $request->email)->first();
        if($user) {
            return response()->json(['message' => 'Email already taken'], 400);
        } else {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['message' => 'User successfully registered'], 201);
        }
        
    }

    public function index() {
        return User::all();
    }
}
