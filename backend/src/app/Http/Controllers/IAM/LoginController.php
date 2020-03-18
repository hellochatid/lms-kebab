<?php

namespace App\Http\Controllers\IAM;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Traits\RestExceptionHandlerTrait;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    use RestExceptionHandlerTrait;

    /**
     * Login user.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Post(
     *   path="/iam/login",
     *   tags={"IAM"},
     *   summary="Login",
     *   operationId="login",
     *   @SWG\Parameter(
     *     name="email",
     *     in="query",
     *     description="Email",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="query",
     *     description="Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function login(Request $request)
    {
        if (!isset($request->email) || !isset($request->password)) {
            return $this->jsonResponse(400, 'Bad request');
        }

        $credentials = $request->only('email', 'password');
        if (!Auth::guard()->attempt($credentials)) {
            return response()->json(['success' => false, 'message' => 'incorect email and password combination']);
        }

        $authUser = Auth::user();

        // get user roles
        $authUser->roles;
        $userRoles = [];
        foreach ($authUser->roles as $v) {
            array_push($userRoles, $v->name);
        }

        if(!in_array($request->role, $userRoles)){
            return $this->jsonResponse(401, 'unauthorized');
        }

        try {
            if (!$token = JWTAuth::fromUser($authUser)) {
                return $this->jsonResponse(401, 'invalid credentials');
            }
        } catch (JWTException $e) {
            return $this->jsonResponse(500, 'could not create token');
        }

        return response()->json([
            'access_token' => $token
        ]);
    }
}
