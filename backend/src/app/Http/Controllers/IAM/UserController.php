<?php

namespace App\Http\Controllers\IAM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth.jwt', ['except' => ['login']]);
    }
    
    public function me(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        return response()->json(Auth::guard()->user());
    }
}
