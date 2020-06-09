<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class adminLoginController extends Controller
{
    //
    public function showLoginForm(){
        //echo bcrypt("123456789");die;
    	//return view('auth.admin-login');
        return view('admin.minimal');
    }

    // public function logout(Request $request)
    // {
    //     //Auth::guard('admin')->logout();
    //     $this->guard()->logout();
    //     $request->session()->flush();
    //     $request->session()->regenerate();
    //     return redirect()->guest(route( 'admin.login' ));
    // }
    //     public function login( Request $request )
    // {
    //     // Validate form data

    //     $this->validate($request, [
    //         'email'     => 'required|email',
    //         'password'  => 'required|min:6'
    //     ]);
    //     // Attempt to authenticate user
    //     // If successful, redirect to their intended location


    //     if ( Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]) ) {
    //         //return redirect()->intended( route('admin.home') );
    //         return redirect()->route('admin.home');
    //     }
    //     // Authentication failed, redirect back to the login form
    //     return redirect()->back()->withInput( $request->only('email', 'remember') )->with('error','Incorrect details');
    // }
    protected function guard(){
    	return Auth::guard('admin');
    }
    use AuthenticatesUsers;
    protected $redirectTo="/admin/dashboard";

    public function __construct(){

    	$this->middleware('guest:admin')->except('logout');
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');
    }


}
