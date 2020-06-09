<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Response;
use App\User;
class apiForgotPassword extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function sendLink(Request $request)
    {

        if($request->email == '')
        {
            return response(['success'=>0,'message'=> "Please enter email first"]); 
        }
        $user = User::where('email',$request->email)->count();
        if(!$user)
        {
            return response(['success'=>0,'message'=> "Invalid Email"]); 
        }
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response(['success'=>1,'message'=> trans($response)]);  
        // return response(['message'=> trans($response)]);
    }
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response(['success'=>0,'message'=> trans($response)]);
        // return response(['error'=> trans($response)], 422);
    }
}
