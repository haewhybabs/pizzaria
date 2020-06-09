<?php

namespace App\Http\Controllers;


use App\User;
use App\Franchise;
use App\PizzaCategory;
use Illuminate\Http\Request;
use JWTAuth;
use Validator,Hash;
use JWTFactory;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Store;
use DB;

class ApiController extends Controller
{
    //
     public $loginAfterSignUp = true;

     public function register(Request  $request)
    {
    	$credentials = $request->only('name', 'email', 'password','confirm_password','phone');

    	$rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password'=>'required|min:8',
            'confirm_password'=>'required|same:password',
            'phone'=>'required|numeric|min:8'
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            // return response()->json(['success'=> 0, 'error'=> $validator->messages()]);
            $arr = json_decode($validator->messages());            
            foreach ($arr as $value) {
                return response()->json(['success'=> 0, 'error'=> $value[0]]);
            }
        }
        /*if($request->password != $request->confirm_password)
        {
        	return response()->json(['success'=> 0, 'error'=>"Password and Confirm Password must be equal."]);
        }*/
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->save();

 		$token = JWTAuth::fromUser($user);
        // if ($this->loginAfterSignUp) {
        //     return $this->login($request);
        // }
 
        return response()->json([
            'success' => 1,
            'data' => $user,
            'token'=>$token
        ], 200);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=> 0, 'error'=>$validator->errors()]);
        }
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['success'=>0, 'error'=>'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['success'=>0, 'error' => 'could_not_create_token'], 500);
        }
        $user = User::where('email',$request->email)->first();
        $user_data = json_decode($user);
        if($user_data->preference){
            $details = true;
        }
        else{
            $details = false;
        }
        return response()->json(['success'=>1,'response'=>compact('user','token','details')]);
    }
    public function getCate()
    {
        $cate = PizzaCategory::select('id','category')->where('isActive',1)->get()->toArray();
        return response()->json(['success'=>1,'categories'=>$cate]);
    }
    public function getCom()
    {
        $com = Franchise::select('id','name','slug','logo')->where('is_active',1)->get()->toArray();
        $arr = array();
        $i = 0;
        foreach ($com as $value) {
            $arr[$i++] = [
                            'id'=>$value['id'],
                            'name'=>$value['name'],
                            'slug'=>$value['slug'],                            
                            'logo'=>url('/adminAssets/franchiseLogo/'.rawurlencode($value['logo']))
                        ];            
        }
        return response()->json(['success'=>1,'company'=>$arr]);
    }

    public function getPreferencesmeta()
    {
        $response_array=array();
        $response_array['category'] = PizzaCategory::select('id','category')->where('isActive',1)->get()->toArray();
        $response_array['size'] = array(
            array('id'=>0,'name'=>'Small'),
            array('id'=>1,'name'=>'Medium'),
            array('id'=>2,'name'=>'Large'),
            array('id'=>3,'name'=>'Extra large')
        );
        return response()->json(['success'=>1,'data'=>$response_array]);
    }

    public function getStores($page = 2)
    {
        $store = Store::select('id','name','street','city','state','country','zip_code','latitude', 'longitude','phone','url','companyID')->where('status',1)->limit(50)->offset(($page - 1) * 50)->get();
        return response()->json(['success'=>1,'stores'=>$store->makeHidden(['companyID','company'])]);
    }

    public function nearestStores(Request $request)
    {
        $store = Store::select('id','name', 'latitude', 'longitude','street','city','state','country','zip_code','phone','url','companyID', 
            DB::raw(sprintf('(6371 
                            * acos(cos(radians('.$request->latitude.')) 
                            * cos(radians(latitude)) 
                            * cos(radians(longitude) 
                            - radians('.$request->longitude.')) 
                            + sin(radians('.$request->latitude.')) 
                            * sin(radians(latitude)))) 
                            AS distance',
            $request->input('latitude'),
            $request->input('longitude')
        )))
        ->having('distance', '<', 30)
        ->orderBy('distance', 'asc')
        ->get();
        return response()->json(['success'=>1,'stores'=>$store->makeHidden(['companyID','company'])]);
    }

    public function searchStores(Request $request)
    {
        $store = Store::select('id','name', 'latitude', 'longitude','street','city','state','country','zip_code','phone','url','companyID')
        ->where('name','like','%'.$request->store_name.'%')
        ->limit(50)->offset(($request->page_no - 1) * 50)->get();
        if(count($store) != 0){
            if (count($store) >= 50) {
                $nextPage = $request->page_no + 1;
            }
            else{
                $nextPage = 'none';
            }
            for ($i=0; $i < count($store); $i++) { 
                $store[$i]->name = stripslashes($store[$i]->name);                
            }
            return response()->json(['success'=>1,'stores'=>$store->makeHidden(['companyID','company']),'nextPage'=>$nextPage]);
        }
        else {
            return response()->json(['success'=>0,'stores'=>'Sorry, no such store found']);
        }
    }


}
