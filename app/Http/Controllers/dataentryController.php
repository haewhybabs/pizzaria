<?php

namespace App\Http\Controllers;
use App\Admin;
use Illuminate\Http\Request;
use Response;
use Auth;
use App\User;
class dataentryController extends Controller
{
    //
    public function index(){

     	//dd(Auth::guard('admin')->user()->role);
         $user = Auth::guard('admin')->user();
        
    	$duser = Admin::where('id','<>',$user->id)->get();
        
    	return view('admin.data_entry.list',compact('duser'));
    }
    public function userView()
    {
        $user = User::get();
        return view('admin.data_entry.userlist',compact('user'));
    }
    public function deleteuser($id)
    {
        $user = User::find($id);
        $user->delete();
        $msg = array("success"=>1,"message"=>"User has been deleted");
        return Response::json($msg);
    }
    public function dashboard(){
       
         return view('admin.dashboard');
    }
    public function add(){
        
    	return view('admin.data_entry.add');
    }
    public function store(Request $request){

    	if($request->ajax())
    	{
    		$duser = new Admin;
    		$duser->name = $request->name;
    		$duser->email = $request->email;
    		$duser->password = \Hash::make($request->password);
    		$duser->role = $request->role;
    		$duser->save();
    		$msg = array("success"=>1,"message"=>"Record Inserted");
    		return Response::json($msg);
    	}
    	else
    	{
    		$msg = array("success"=>0,"message"=>"Something went wrong");
    		return Response::json($msg);
    	}
    }
    public function edit($id)
    {
    	$duser = Admin::find($id);
    	//print_r($duser);
        if($duser!=null)
        {
            return view('admin.data_entry.edit',compact('duser'));
        }
        else
        {
            return redirect()->route('admin.dataentry');
        }
		

    }
    public function update(Request $request)
    {
    	
    	if($request->ajax())
    	{
    		$duser = Admin::find($request->id);
    		$duser->name = $request->name;
    		if($request->password!="")
    		{
    			$duser->password = \Hash::make($request->password);
    		}
    		$duser->save();
    		$msg = array("success"=>1,"message"=>"Record Updated");
    		return Response::json($msg);
    	}
    	else
    	{
    		$msg = array("success"=>0,"message"=>"Something went wrong");
    		return Response::json($msg);
    	}
    }
    public function delete($id)
    {
    	$duser = Admin::find($id);
    	$duser->delete();
    	$msg = array("success"=>1,"message"=>"User has been deleted");
        return Response::json($msg);
    }
    public function validateemail(Request $request)
    {
        $email = $request->email;

        $user = Admin::where('email',$email)->count();
       
        if($user)
        {
           return Response::json(false);

        }
        else
        {
           return Response::json(true);
        }
        
    }
    public function changeStatus(Request $req)
    {
        if($req->ajax())
        {
            $user = User::find($req->id);
            if($req->checkbox == "on")
            {
                $user->isActive = 1;
            }
            else
            {
                $user->isActive = 0;
            }
            $user->save();
            $msg = array('success'=>1,'message'=>'status changed');
            return Response::json($msg);
        }
        else
        {
             $msg = array('success'=>0,'message'=>'Something went wrong');
            return Response::json($msg);
        }
    }
}
