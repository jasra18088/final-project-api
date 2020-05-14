<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected function generateAccessToken($user)
    {
        $token = $user->createToken($user->email . '-' . now());

        return $token->accessToken;
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'operator',
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'registerSuccess' => true
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $this->scope = $user->role;

            $token = $user->createToken($user->email . '-' . now(), [$this->scope]);

            return response()->json([
                'token' => $token->accessToken,
                'loggedIn' => true
            ]);
        } else {
            return response()->json([
                'loggedIn' => false
            ]);
        }
    }
}
