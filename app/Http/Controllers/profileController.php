<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\PizzaCategory;
use \App\Franchise;
use Image;
use Response;
use Hash;
class profileController extends Controller
{
    public function userAccount()
    {
    	$user = User::find(Auth::user()->id);
    	$cate = PizzaCategory::get();
      $com = Franchise::get();
      // dd($user);
    	return view('user.userAccount',compact('user','cate','com'));
    }
    public function update(Request $req)
    {
      // dd($req->all());
      $pref =  implode(',',$req->pizzaType);
      $com =  implode(',',$req->pizzaStore);
      $user = User::find($req->id);
      $user->name = $req->name;
      $user->email = $req->email;
      $user->address = $user->address;
      $user->phone = $user->phone;
      $user->city= $req->city;
      $user->state = $req->state;
      $user->country = $req->country;
      $user->preference =  $pref;
      $user->fav_com = $com;
      $user->pizza_size = $req->pizzaSize;
      $user->delivery_method = $req->deliveryMethod;
      $user->buffet = $req->buffet;
      if($req->uimg)
      {
        $file = $req->uimg;
        $imgname = $file->getClientOriginalName();
        $file->move('userAssets/userImage',$file->getClientOriginalName());
        $user->imgname = $imgname;
      }
      $user->save();
      return redirect()->route('myaccount');
    }
    public function save(Request $req)
    {
      if($req->ajax())
      {
        $pref =  implode(',',$req->pizzaPref);
        $com =  implode(',',$req->pizzaStore);
        $user = User::find(Auth::user()->id);
        if($req->uimg)
        {
            $name = Auth::user()->name;
            $file = $req->uimg;
            $img = Image::make($file->getRealPath());
            $img->resize(300, 300);
            $imgname = time().$name.".".$file->getClientOriginalExtension();
            $img->save('userAssets/userImage/'.$imgname);
            $user->imgname = $imgname;
        }
        $user->preference = $pref;
        $user->fav_com = $com;
        $user->pizza_size = $req->pizzaSize;
        $user->delivery_method = $req->deliveryMethod;
        $user->buffet = $req->buffet;
        $user->address =$req->address;
        $user->city= $req->city;
        $user->state = $req->state;
        $user->country = $req->country;
        $user->save();
        $msg = array("success"=>1,"message"=>"Details Updated");
        return Response::json($msg);
      }
      else
      {
        $msg = array("success"=>0,"message"=>"Something went wrong");
      }
    }
    public function checkPass(Request $req)
    {
      if($req->ajax())
      {
        $pass = $req->pass;

        if(Hash::check($pass,Auth::user()->password))
        {
          return Response::json(true);
        }
        else
        {
          return Response::json(false);
        }
      }
    }
    public function changePass(Request $req)
    {
      $user = User::find(Auth::user()->id);
      $user->password = Hash::make($req->newpass);
      $user->save();
      auth()->logout();
      return redirect()->route('login')->with('status','Password is changed');
    }
    public function checkEmail(Request $req)
    {
      $user = User::where('email',$req->email)->count();
      if($user)
      {
        return Response::json(false);
      }
      else
      {
        return Response::json(true);
      }
    }
}
