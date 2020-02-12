<?php

namespace App\Http\Controllers\IAM;

use App\Http\Controllers\Controller;
use App\Traits\RestExceptionHandlerTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Validator, DB, Hash;

class UserController extends Controller
{
    use RestExceptionHandlerTrait;

    public function __construct()
    {
        $this->middleware('auth.jwt', ['except' => ['register', 'verifyUser']]);
    }

    /**
     * API Register User
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
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
            'confirmation_url' => 'required'
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

        // create user verification code
        $verification_code = bin2hex(random_bytes(30));
        $expiredDate = date('Y-m-d H:i:s', strtotime(' + 3 days'));
        DB::table('user_verifications')->insert([
            'user_id' => $user->id,
            'token' => $verification_code,
            'expired_date' => $expiredDate
        ]);

        // Send email verification
        $subject = "Please verify your email address.";
        $data = [
            'name' => $name,
            'verification_code' => str_rot13($verification_code),
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
    public function verifyUser($verification_code)
    {
        $check = DB::table('user_verifications')->where('token', str_rot13($verification_code))->first();

        if (!is_null($check)) {

            // check if token expired
            if (strtotime($check->expired_date) < time()) {
                return $this->jsonResponse(200, 'The verificationcode was expired.');
            }

            // check is user already verified
            $user = User::find($check->user_id);
            if ($user->is_verified) {
                return $this->jsonResponse(200, 'Account already verified');
            }

            // verified user
            DB::table('users')->where('id', $check->user_id)->update(['is_verified' => true]);

            // delete token
            DB::table('user_verifications')->where('token', str_rot13($verification_code))->delete();

            return response()->json([
                'success' => true,
                'message' => 'You have successfully verified your email address.'
            ]);
        }

        return $this->jsonResponse(200, 'Verification code is invalid.');
    }

    public function me(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        return response()->json(Auth::guard()->user());
    }
}
