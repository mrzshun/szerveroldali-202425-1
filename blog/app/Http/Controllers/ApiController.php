<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
        ],[
            'required' => ':attribute megadása kötelező',
            'string' => ':attribute csak szöveg lehet',
            'email' => ':attribute csak helyesen formázott email lehet',
            'unique' => ':attribute email cím már foglalt',
        ],[
            'name' => 'A név',
            'email' => 'Az email',
            'password' => 'A jelszó',
        ]);
        if($validator->fails()) {
            return response()->json([
                'error' => $validator->messages(),
            ], 400);
        }
        $validated = $validator->validated();

        $user = User::create($validated);

        $token = $user->createToken($user->email);

        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string',
        ],[
            'required' => ':attribute megadása kötelező',
            'string' => ':attribute csak szöveg lehet',
            'email' => ':attribute csak helyesen formázott email lehet',
        ],[
            'email' => 'Az email',
            'password' => 'A jelszó',
        ]);
        if($validator->fails()) {
            return response()->json([
                'error' => $validator->messages(),
            ], 400);
        }
        $validated = $validator->validated();
        $user = User::where('email',$validated['email'])->first();
        if(!$user) {
            return response()->json([
                'error' => 'hibás email cím',
            ],404);
        }
        if(Auth::attempt($validated)) {
            $token = $user->createToken($user->email);
            return response()->json([
                'token' => $token->plainTextToken,
            ]);
        }
        else {
            return response()->json([
                'error' => 'hibás jelszó!',
            ],401);
        }
    }

    public function logout(Request $request) {
        $user = Auth::user();
        $request->user()->currentAccessToken()->delete();
        return response()->json([],204);
    }

    public function user(Request $request) {
        return $request->user();
    }
}
