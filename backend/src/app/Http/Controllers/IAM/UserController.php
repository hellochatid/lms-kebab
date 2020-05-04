<?php

namespace App\Http\Controllers\IAM;

use App\Http\Controllers\Controller;
use App\Traits\RestExceptionHandlerTrait;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Validator, DB, Hash;
use Storage;

class UserController extends Controller
{
    use RestExceptionHandlerTrait;

    public function __construct()
    {
        $this->middleware('auth.jwt', ['except' => ['registerExistingUser', 'register', 'verifyUser', 'isUserExists']]);
    }

    /**
     * API Register existing user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    // TODO: add swager annotations here    
    public function registerExistingUser(Request $request)
    {
        if (!isset($request->email) || !isset($request->password) || !isset($request->role)) {
            return $this->jsonResponse(400, 'Bad request');
        }

        $credentials = $request->only('email', 'password');
        if (!Auth::guard()->attempt($credentials)) {
            return $this->jsonResponse(401, 'invalid credentials');
        }

        // is user already registered
        $authUser = Auth::user();
        $authUser->roles;
        $userRoles = [];
        foreach ($authUser->roles as $v) {
            array_push($userRoles, $v->name);
        }

        if (in_array($request->role, $userRoles)) {
            return $this->jsonResponse(200, 'User already registered');
        }

        // add user role 
        $acceptedRole = ['member', 'affiliate'];
        try {
            $role  = Role::where('name', $request->role)->first();
            if ($role === null || !in_array($request->role, $acceptedRole)) {
                return $this->jsonResponse(400, 'Invalid role name');
            }
            $authUser->roles()->attach($role);
        } catch (\Illuminate\Database\QueryException $error) {
            return $this->jsonResponse(500, $error);
        }

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * API Register User
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Post(
     *   path="/iam/register",
     *   tags={"IAM"},
     *   summary="Register",
     *   operationId="register",
     *   @SWG\Parameter(
     *     name="name",
     *     in="query",
     *     description="Name",
     *     required=true,
     *     type="string"
     *   ),
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
     *   @SWG\Parameter(
     *     name="confirm_password",
     *     in="query",
     *     description="Confirm Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="confirmation_url",
     *     in="query",
     *     description="confirmation URL",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function register(Request $request)
    {
        // Validate form
        $credentials = $request->all();
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
            'confirm_password' => 'required|same:password',
            'confirmation_url' => 'required',
            'role' => 'required'
        ];

        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return $this->jsonResponse(400, $validator->messages());
        }

        // create new user
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        // Add user role
        $acceptedRole = ['member', 'affiliate'];
        $role  = Role::where('name', $request->role)->first();
        if ($role === null || !in_array($request->role, $acceptedRole)) {
            return $this->jsonResponse(400, 'Invalid role name');
        }
        $user->roles()->attach($role);

        // create user verification code
        $verificationCode = bin2hex(random_bytes(30));
        $expiredDate = date('Y-m-d H:i:s', strtotime(' + 3 days'));
        DB::table('user_verifications')->insert([
            'user_id' => $user->id,
            'token' => $verificationCode,
            'expired_date' => $expiredDate
        ]);

        // Send email verification
        try {
            $subject = "Please verify your email address.";
            $data = [
                'name' => $name,
                'verificationCode' => str_rot13($verificationCode),
                'confirmation_url' => $request->confirmation_url
            ];
            Mail::send(
                'email.verify',
                $data,
                function ($mail) use ($email, $name, $subject) {
                    $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $mail->to($email, $name);
                    $mail->subject($subject);
                }
            );
        } catch (\Throwable $th) {
            return $this->jsonResponse(400, 'cant send email verification');
        }

        return response()->json([
            'success' => true,
            'message' => 'Thanks for signing up! Please check your email to complete your registration.'
        ]);
    }

    /**
     * API Verify User
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    // TODO: add swager annotations here
    public function verifyUser(Request $request)
    {
        $verificationCode = $request->verification_code;
        $verification = DB::table('user_verifications')->where('token', str_rot13($verificationCode))->first();

        if (!is_null($verification)) {

            // check if token expired
            if (strtotime($verification->expired_date) < time()) {
                return $this->jsonResponse(200, 'The verification code was expired.');
            }

            // check is user already verified
            $user = User::find($verification->user_id);
            if ($user->is_verified) {
                return $this->jsonResponse(200, 'Account already verified');
            }

            // verified user
            DB::table('users')->where('id', $verification->user_id)->update(['is_verified' => true]);

            // delete token
            DB::table('user_verifications')->where('token', str_rot13($verificationCode))->delete();

            return response()->json([
                'success' => true,
                'message' => 'You have successfully verified your email address.'
            ]);
        }

        return $this->jsonResponse(200, 'Verification code is invalid.');
    }

    /**
     * API get user detail
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    // TODO: add swager annotations here
    public function me(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'member', 'affiliate']);
        $authUser = Auth::user();

        $response['id'] = $authUser->id;
        $response['name'] = $authUser->name;
        $response['email'] = $authUser->email;
        $response['display_image'] = $authUser->display_image !== '' && $authUser->display_image !== null ? url('') . Storage::url('images/' . $authUser->display_image) : null;

        return response()->json([
            'success' => true,
            'data' => $response
        ]);
    }

    /**
     * API check is user exists
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    // TODO: add swager annotations here
    public function isUserExists(Request $request)
    {
        try {
            $query = DB::table('users')
                ->where('email', '=', $request->email)
                ->whereNull('deleted_at')
                ->select('name', 'display_image');

            $data = $query->first();
        } catch (\Illuminate\Database\QueryException $error) {
            return $this->jsonResponse(500, $error);
        }

        // response
        if ($data === null) {
            return response()->json([
                'exists' => false
            ]);
        }

        $response = [
            'name' => $data->name,
            'display_image' => $data->display_image !== '' && $data->display_image !== null ? url('') . Storage::url('images/' . $data->display_image) : null
        ];

        return response()->json([
            'exists' => true,
            'data' => $response,
        ]);
    }
}
