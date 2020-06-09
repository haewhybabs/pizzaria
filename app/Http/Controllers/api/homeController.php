<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use \App\Product;
use \App\Store;
use \App\Franchise;
use \App\PizzaCategory;
use \App\schedule;
use \App\storeUser;
use \App\userLocation;
use Response;
use DB, Validator;

class homeController extends Controller
{
     private $store_on_page=8;
     private $max_distance = 10;
    
    public function getProducts()
    {
        if(auth()->check())
        {
    		$user = auth()->user();
    		$pref = explode(',',$user->preference);
    		$com  = explode(',',$user->fav_com);
    		$size = $user->pizza_size;
            
            $loc = userLocation::where('userid',$user->id)->first();

            if(isset($loc) && $loc != '')
            {
                $lat = $loc->latitude;
                $lon = $loc->longitude;
            }
            
            if((isset($lat) && $lat!= '') && (isset($lon) && $lon!=''))
            {

                $data['store'] = Store::select('stores.*',DB::raw("3959 * acos(cos(radians(" . $lat . ")) * cos(radians(stores.latitude)) * cos(radians(stores.longitude) - radians(" . $lon . ")) + sin(radians(" .$lat. ")) * sin(radians(stores.latitude))) AS distance"))
                ->with(array('products'=>function($query)use($pref,$com,$size){
                $query->with(array('category'=>function($c){
                            $c->select('id','category')->where('isActive',1);
                        }))
                    ->select('*')->whereIn('type',$pref)->whereIn('companyID',$com)->where('size',$size);
                }))
                ->with(array('company'=>function($query){
                    $query->select('*')->where('is_active',1);
                }))
                ->groupBy('stores.id')
                ->Having('distance','<=',$this->max_distance)
                ->get()->toArray();

                return response()->json(['success'=>1,'data'=>$data]);
            }
            else
            {
                $product = Product::with(array('category'=>function($query){
                    $query->select('id','category')->where('isActive',1);
                }))->with(array('store'=>function($query){
                    $query->select('id','name','slug')->where('status',1);
                }))->with(array('company'=>function($query){
                    $query->select('id','name','slug','logo')->where('is_active',1);
                }))->get()->toArray();
               return response()->json(['success'=>1,'products'=>$product]);
            }
            //old 
    		// $product = Product::where('size',$size)->whereIn('type',$pref)->whereIn('companyID',$com)->with(array('category'=>function($query){
    		// 	$query->select('id','category')->where('isActive',1);
    		// }))->with(array('store'=>function($query){
    		// 	$query->select('id','name','slug')->where('status',1);
    		// }))->with(array('company'=>function($query){
    		// 	$query->select('id','name','slug','logo')->where('is_active',1);
    		// }))->get()->toArray();
    	}
    }

    public function setLocation(Request $req)
    {
        if(auth()->check())
        {
            $credentials = $req->only('latitude','longitude');
            $rules = [
                'latitude' => 'required',
                'longitude' => 'required',
            ];

            $validator = Validator::make($credentials, $rules);

            if($validator->fails()) 
            {
                return response()->json(['success'=> 0, 'error'=> $validator->messages()]);
            }
           
            $lat = $req->latitude;
            $lon = $req->longitude;
            $location = new userLocation();
            $location->userid = auth()->user()->id;
            $location->type = "api";
            $location->latitude = $lat;
            $location->longitude = $lon;
            $location->save();
            return response()->json(['success'=>'1','latitude'=>$lat,'longitude'=>$lon]);
        }
        else
        {
            return response()->json(['Error','User is not logged in.']);
        }
    }
}
