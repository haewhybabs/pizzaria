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
use DB;
class profileController extends Controller
{
  function __construct()
    {
        $this->middleware('auth');

    }
    public function userAccount()
    {
      $stores=[];
    	$user = User::find(Auth::user()->id);
    	$cate = PizzaCategory::get();
      $com = Franchise::get();
      $toppings = DB::table('toppings')->get();
      $userPref = DB::table('preference')->where('user_id',auth()->user()->id)->first();
      $sizes = DB::table('pizzasize')->get();
      if($userPref){
        $stores = DB::table('preference_stores')->join('franchises','franchises.id','=','preference_stores.franchise')
        ->where('preference_stores.preference_id',$userPref->idpreference)->get();
      }
      
      
    	return view('user.userAccount',compact('user','cate','com','toppings','userPref','sizes','stores'));
    }
    public function update(Request $req)
    {
      $user = DB::table('users')->where('id',auth()->user()->id)->first();
      $imgname = $user->imgname;

      if($req->uimg)
      {
        $file = $req->uimg;
        $imgname = $file->getClientOriginalName();
        $file->move('userAssets/userImage',$file->getClientOriginalName());
      }
    
      $userData = array(
        'name'=>$req->name,
        'email'=>$req->email,
        'address'=>$req->address,
        'phone'=>$req->phone,
        'city'=>$req->city,
        'state'=>$req->state,
        'country'=>$req->country,
        'zip_code'=>$req->zip_code,
        'imgname'=>$imgname
      );

      $update = DB::table('users')->where('id',auth()->user()->id)->update($userData);

      $preferenceData = array(
        "toppings"=>$req->topping,
        "delivery_method"=>$req->deliveryMethod,
        "pizzaSize"=>$req->pizzaSize,
        'user_id'=>auth()->user()->id
      );
      $preference = DB::table('preference')->where('user_id',auth()->user()->id)->first();
      if($preference){
        DB::table('preference')->where('user_id',auth()->user()->id)->update($preferenceData);
        DB::table('preference_stores')->where('preference_id',$preference->idpreference)->delete();
        $idpreference = $preference->idpreference;
      }
      else{
        $idpreference =DB::table('preference')->insertGetId($preferenceData);
      }


      
      if(!isset($req->pizzaStore)){
        if(count($req->currentStore)>0){
          for($i=0;$i<count($req->currentStore); $i++){
            $franchiseData = array(
              'user_id'=>auth()->user()->id,
              'franchise'=>$req->currentStore[$i],
              'preference_id'=>$idpreference
            );
            DB::table('preference_stores')->insert($franchiseData);
          }
        }
        else{
          // Validation Error
          return redirect()->route('myaccount');
        }
      }
      else{
        
        for($i=0;$i<count($req->pizzaStore); $i++){
          $franchiseData = array(
            'user_id'=>auth()->user()->id,
            'franchise'=>$req->pizzaStore[$i],
            'preference_id'=>$idpreference
          );
          DB::table('preference_stores')->insert($franchiseData);
        }
      }
      
      return redirect('order-now')->with('success','Profile successfully updated');;
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
      print_r($req->email);
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
