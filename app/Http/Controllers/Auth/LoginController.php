<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
        $this->middleware('guest')->except('logout');

    }
     public function authenticated(Request $request, $user)
    {
        if(Session::has('latitude') && Session::has('longitude'))
        {
            session()->forget('latitude');
            session()->forget('longitude');
        }
       if($user->isActive == 0)
       {
            auth()->logout();
            return back()->with('warning','Sorry! you are blocked by admin');
       }
       return redirect()->intended($this->redirectPath());
    }
    public function showLoginForm(){
        return view('auth.login');
    }

}
