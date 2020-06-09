<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Response;
use Hash;
use \App\Admin;
use \App\User;
use \App\Store;
use \App\Franchise;
use \App\Product;
class adminController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:admin');        
    }
    public function index(){
        $user = User::count();
        $store = Store::count();
        $com = Franchise::count();
        $pizza = Product::count();
    	return view('admin.dashboard',compact('user','store','com','pizza'));
    }
    public function profileView(){
    	$user = Auth::guard('admin')->user();
    	return view('admin.profile',compact('user'));
    }
    public function checkPass(Request $request)
    {
    	$pass  = $request->pass;

    	if(Hash::check($pass,Auth::guard('admin')->user()->password))
    	{
    		return Response::json(true);
    	}
    	else
    	{
    		return Response::json(false);
    	}
    	
    }
    public function changeProfile(Request $request)
    {
    	if($request->ajax())
    	{
			$user = Admin::find($request->id);
	    	$user->name = $request->name;
	    	$user->save();
	    	
	    	if($request->cpassword!="")
	    	{
	    		$user->password = Hash::make($request->cpassword);
	    	}
	    	$user->save();
	    	$msg = array("success"=>1,'message'=>"Profile change");
			return Response::json($msg);
	    	
	    }
    	else
    	{
    		$msg = array("success"=>0,'message'=>"Something went wrong");
			return Response::json($msg);
    	}

    }

}
