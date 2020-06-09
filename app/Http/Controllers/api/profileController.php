<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator,Hash;
use JWTAuth;
use App\Franchise;
use App\PizzaCategory;
use DB;
use Image;
use Auth;
class profileController extends Controller
{
    //return auth()->user();
    public function getuser()
    {
    	if(!auth()->check())
    	{
    		  return response(['success'=>0,'message'=> "User is not logged in"]); 
    	}
        /*$img = auth()->user()->imgname;
        $link = url(asset('userAssets/userImage/')."/$img");
        $user = auth()->user();
        $user->imgname = $link;
    	return auth()->user();*/
        
        $id = auth()->user()->id;
        $user = User::where('id',$id)->first();
        return response(['success'=>1,'user'=>$user]);
    }
    public function checkdetails()
    {
    	if(!auth()->check())
    	{
    		  return response(['success'=>0,'message'=> "User is not logged in"]); 
    	}
    	$id = auth()->user()->id;
    	$user = User::find($id);
    	if(!$user)
    	{
    		return response(['success'=>0,'message'=> "Opps ! something went wrong please try again"]); 
    	}
        $user = User::where('id',$id)->first();
    	if($user->address == null || $user->phone == null ||$user->city == null || $user->state == null || $user->country == null || $user->preference == null )
    	{
    		return response(['success'=>1,'message'=>"Details is missing","filldetails"=>true,'user'=>$user]);
    	}
    	else
    	{
    		return response(['success'=>1,'message'=>"Details is there","filldetails"=>false,'user'=>$user]);
    	}
    }
    public function filldetails(Request $req)
    {

    	$credentials = $req->only('address','city', 'state', 'country','imgname','preference','delivery_method','pizza_size','fav_com','buffet');

    	$rules = [
            'address'=>'required',
            'city' => 'required',
            'state' => 'required',
            'country'=>'required',
            'imgname'=>'mimes:jpeg,png,jpg',
            'preference'=>'required',
            'delivery_method'=>'required',
            'pizza_size'=>'required|numeric',
            'fav_com'=>'required',
            'buffet'=>'required|numeric'
        ];

        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) 
        {
            // print_r($validator->messages());die;
            $msg=array();
            if($validator->messages()->has('address'))
            {
                 $msg['address']=$validator->errors()->first('address');
            }
            if($validator->messages()->has('city'))
            {
                 $msg['city']=$validator->errors()->first('city');
            }
            if($validator->messages()->has('state'))
            {
                 $msg['state']=$validator->errors()->first('state');
            }
            if($validator->messages()->has('country'))
            {
                 $msg['country']=$validator->errors()->first('country');
            }
            if($validator->messages()->has('imgname'))
            {
                $msg['imgname']=$validator->errors()->first('imgname');
            }
            if($validator->messages()->has('preference'))
            {
                $msg['preference']=$validator->errors()->first('preference');
            }
            if($validator->messages()->has('delivery_method'))
            {
                $msg['delivery_method']=$validator->errors()->first('delivery_method');
            }
            if($validator->messages()->has('pizza_size'))
            {
                $msg['pizza_size']=$validator->errors()->first('pizza_size');
            }
             if($validator->messages()->has('fav_com'))
            {
                $msg['fav_com']=$validator->errors()->first('fav_com');
            }
            if($validator->messages()->has('buffet'))
            {
                $msg['buffet']=$validator->errors()->first('buffet');
            }
             return response()->json(['success'=> 0, 'messages'=> implode(",",$msg)]);
        }
        if($req->buffet != '0' && $req->buffet != '1')
        {
        	 return response()->json(['success'=> 0, 'error'=>"Invalid buffet value.It should be 0 or 1"]);
        }
        $del = $req->delivery_method;
        $mth = Array("delivery","ubereats","postmates","grubhub","doordash","pickup","eat-in");
        $methods1 = Array("Delivery","Ubereats","Postmates","Grubhub","Doordash","Pickup","Eat-in");
        $methods2 = array_flip(array_change_key_case(array_flip($mth),CASE_UPPER));
        $methods=array_merge($mth,$methods1,$methods2);
       
        if(!in_array($del, $methods))
        {
        	return response()->json(['success'=> 0, 'error'=>"Invalid delivery method value."]);
        }
       	$pref =  implode(',', array_filter($req->preference));
       	$com =  implode(',', array_filter($req->fav_com));
       	$name = Auth::user()->name;

        $id = auth()->user()->id;
        $user = User::find($id);
        if($req->imgname)
        {
            $file = $req->imgname;
            $img = Image::make($file->getRealPath());
            $img->resize(300, 300);
            $imgname = time().$name.".".$file->getClientOriginalExtension();
            $img->save('userAssets/userImage/'.$imgname); 
        }
        else
        {
            $imgname = $user->imgname;
        }
       

        $user->address = $req->address;
       	$user->city = $req->city;
       	$user->state = $req->state;
       	$user->country = $req->country;
       	$user->imgname = $imgname;
       	$user->preference = $pref;
       	$user->delivery_method =$del;
        $user->pizza_size = $req->pizza_size;
       	$user->fav_com = $com;
       	$user->buffet = $req->buffet;
       	$save = $user->save();

        $user_data = User::where('id',$id)->first();
       	return response()->json(['success'=> 1, 'message'=>"User details has been saved",'user'=>$user_data]);

    }
    public function updateprofile(Request $req)
    {

        $id = auth()->user()->id;
        $user = User::find($id);
       
        $credentials = $req->only('name', 'phone', 'address','city', 'state', 'country','imgname','preference','delivery_method','pizza_size','fav_com','buffet');

        $pref =  implode(',', array_filter($req->preference));
        $com =  implode(',', array_filter($req->fav_com));
        $name = Auth::user()->name;

        if($req->imgname)
        {
            $file = $req->imgname;
            $img = Image::make($file->getRealPath());
            $img->resize(300, 300);
            $imgname = time().$name.".".$file->getClientOriginalExtension();
            $img->save('userAssets/userImage/'.$imgname); 
        }
        else
        {
            $imgname = $user->imgname;
        }

        $user->name = $req->name;
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->city = $req->city;
        $user->state = $req->state;
        $user->country = $req->country;
        $user->imgname = $imgname;
        $user->preference = $pref;
        $user->delivery_method = $req->delivery_method;
        $user->pizza_size = $req->pizza_size;
        $user->fav_com = $com;
        $user->buffet = $req->buffet;
        $save = $user->save();

        $user_data = User::where('id',$id)->first();
        // print_r($user_data->imgname);
        return response()->json(['success'=> 1, 'message'=>"User details has been updated successfully.", 'user'=>$user_data]);
    }
    public function updatepassword(Request $req)
    {
       
        $credentials = $req->only('current_password','new_password', 'confirm_password');

        $rules = [
            'current_password'=>'required|min:8',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ];

        $validator = Validator::make($credentials, $rules);
        if($validator->fails())
        {            
            $arr = json_decode($validator->messages());            
            foreach ($arr as $value) {
                return response()->json(['success'=> 0, 'error'=> $value[0]]);
            }
        }
        else
        {            
            $id = auth()->user()->id;
            $user = User::find($id);
            if (Hash::check($req->current_password, $user->password)){ 
                // $user->fill(['current_password'=>Hash::make($req->new_password)])->save();
                if (Hash::check($req->new_password, $user->password)) {
                    return response()->json(['success'=> 0, 'message'=>"New Password cannot be same as current password."]);   
                }
                else{
                    $user->password = bcrypt($req->new_password);
                    $user->save();
                    return response()->json(['success'=> 1, 'message'=>"Password has been updated successfully."]);                    
                }
            }
            else{
                return response()->json(['success'=> 0, 'message'=>"Incorrect current password."]);
            }
        }
        // return response()->json(['success'=> 1, 'message'=>"Password has been updated successfully."]);
    }
}
