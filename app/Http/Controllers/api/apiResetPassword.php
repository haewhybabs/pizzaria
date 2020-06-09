<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Response,Validator;

class apiResetPassword extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
 

    /**
     * Create a new controller instance.
     *
     * @return void
     */


	protected function sendResetResponse(Request $request, $response)
    {
        return response(['success'=>1,'message'=> trans($response)]);
    }
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response(['success'=>0,'error'=> trans($response)]);
    }

    protected function reset_password(Request $request)
    {
        $credentials = $request->only(
            'email','token','password', 'password_confirmation'
        );

        $rules = [
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ];
        $validator = Validator::make($credentials, $rules);

        if ($validator->fails()) {
            // return response()->json($validator->errors());
            $arr = json_decode($validator->messages());            
            foreach ($arr as $value) {
                return response()->json(['success'=> 0, 'error'=> $value[0]]);
            }
        }

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
    }

    // public function reset_password(Request $request)
    // {
    //     echo "hello";
    //     $credentials = $request->only(
    //         'email', 'password', 'password_confirmation', 'token'
    //     );

    //     $rules = [
    //         'email' => 'required|email',
    //         'token' => 'required',
    //         'password' => 'required|confirmed|min:8',
    //     ];
    //     $validator = Validator::make($credentials, $rules);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors());
    //     }

    //     $email = $request->email;
    //     $user = User::find($email);

    //     if($user)
    //     {
    //         $user->password = Hash::make($password);

    //         $user->remember_token(Str::random(60));

    //         $user->save();

    //         return response()->json(['success'=>'1','email'=>$email]);
    //     }
    //     else
    //     {
    //         return response()->json(['error'=>'0','email'=>'Email not found.']);
    //     }
}

