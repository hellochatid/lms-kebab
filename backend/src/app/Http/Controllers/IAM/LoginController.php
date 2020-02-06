<?php

namespace App\Http\Controllers\IAM;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (!isset($request->email) || !isset($request->password)) {
            return response()->json(['error' => 'Bad request'], 400);
        }

        $credentials = $request->only('email', 'password');
        if (!$token = Auth::guard()->attempt($credentials)) {
            return response()->json(['success' => false, 'message' => 'incorect email and password combination']);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
        ]);
    }
}
