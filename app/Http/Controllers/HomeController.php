<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Auth;
use \App\Product;
use \App\Store;
use \App\Franchise;
use \App\PizzaCategory;
use \App\schedule;
use \App\storeUser;
Use Alert;
use Response;
use DB;
use Session;
use \App\userLocation;
class HomeController extends Controller
{
/**
* Create a new controller instance.
*
* @return void
*/
private $product_on_page=8;
private $store_on_page=8;
private $max_distance = 5;
public function __construct()
{
//$this->middleware('auth');
//$this->middleware('guest:admin')->except('logout');
// $this->middleware(['auth', 'verified']);
}

/**
* Show the application dashboard.
*
* @return \Illuminate\Contracts\Support\Renderable
*/
public function index()
{
//return view('user.home');
}
public function get_product_for_ajax($lt,$lg,$user)
{
  $pref = explode(",",$user->preference);
  $com = explode(",",$user->fav_com);
  $max_distance = 5;
  $today = date("Y-m-d");
  $product =    Product::select('products.*',DB::raw(" IFNULL((3959 * acos(cos(radians(".$lt.")) * cos(radians(stores.latitude)) * cos( radians(stores.longitude) - radians(".$lg.")) + sin(radians(".$lt.")) * sin(radians(stores.latitude)))),0) AS distance "))
  ->join('stores', 'stores.id', '=', 'products.storeID')
  ->whereIn('products.type',$pref)
  ->where('products.size',$user->pizza_size)
  ->whereIn('products.companyID',$com)
  ->whereRaw('CAST(products.end_time AS DATE)>=?',[$today])
  ->whereRaw('CAST(products.start_time AS DATE)<=?',[$today])
  ->orderby('distance')
  ->Having('distance','<=',$max_distance)
  ->with('category','store','company')
  ->get();

  return $product;
}
public function saveLocation(Request $req)
{
  if($req->ajax())
  {
    session()->put('latitude',$req->latitude);
    session()->put('longitude',$req->longitude);
      /*session()->put('latitude', 21.212657);
      session()->put('longitude', 72.787425);*/
    $msg = array('success'=>1,'message'=>'location saved');
    return response()->json($msg);
  }
  else
  {
    $msg = array('success'=>0,'message'=>'oops!something went wrong');
    return response()->json($msg);
  }

}
public function home()
{
  $cate = PizzaCategory::where('isActive',1)->get();
  $company = Franchise::get();
  $com = $company;
  $company = $company->slice(0,6);
  $today = date("Y-m-d");
  if(Auth::user())
  {
    $user = Auth::user();
    $loc = $user->location;
    $pref = explode(",",$user->preference);
    $favcom = explode(",",$user->fav_com);
    if($loc)
    {
      $product = Product::select('products.*',DB::raw(" IFNULL((3959 * acos(cos(radians(".$loc->latitude.")) * cos(radians(stores.latitude)) * cos( radians(stores.longitude) - radians(".$loc->longitude.")) + sin(radians(".$loc->latitude.")) * sin(radians(stores.latitude)))),0) AS distance "))
      ->join('stores', 'stores.id', '=', 'products.storeID')
      ->whereIn('products.type',$pref)
      ->where('products.size',$user->pizza_size)
      ->whereIn('products.companyID',$favcom)
      ->whereRaw('CAST(products.end_time AS DATE)>=?',[$today])
      ->whereRaw('CAST(products.start_time AS DATE)<=?',[$today])
      ->orderby('distance')
      ->Having('distance','<=',$this->max_distance)
      ->get();

      $totalProd = $product->count();

      $product = $product->slice(0,$this->product_on_page);
    }
    else
    {
      $product = Product::where('products.size',$user->pizza_size)->whereRaw('CAST(products.end_time AS DATE)>=?',[$today])->whereRaw('CAST(products.start_time AS DATE)<=?',[$today])->whereIn('products.type',$pref)->whereIn('products.companyID',$favcom)->get();
      $totalProd = count($product);
      $product = $product->slice(0,$this->product_on_page);
    }

    return view('user.home',compact('product','company','com','cate','loc','totalProd', 'user'));
  }
  else
  {
    $loc = array();
    if(Session::has('latitude') && Session::has('longitude'))
    {
      $today =date("2019-09-27");
      $lt = Session::get('latitude');
      $lg = Session::get('longitude');
      $product = Product::select('products.*',DB::raw(" IFNULL((3959 * acos(cos(radians(".$lt.")) * cos(radians(stores.latitude)) * cos( radians(stores.longitude) - radians(".$lg.")) + sin(radians(".$lt.")) * sin(radians(stores.latitude)))),0) AS distance "))
      ->join('stores', 'stores.id', '=', 'products.storeID')
      ->whereRaw('CAST(products.end_time AS DATE)>=?',[$today])
      ->whereRaw('CAST(products.start_time AS DATE)<=?',[$today])
      ->orderby('distance')
      ->Having('distance','<=',$this->max_distance)
      ->get();

      $totalProd = $product->count();
      $product = $product->slice(0,$this->product_on_page);
    }
    else
    {

      $product = Product::whereRaw('CAST(products.end_time AS DATE)>=?',[$today])->whereRaw('CAST(products.start_time AS DATE)<=?',[$today])->get();

      $totalProd = count($product);
      $product = $product->slice(0,$this->product_on_page);
    }
  }
  return view('user.home',compact('product','company','com','cate','loc','totalProd'));
}
public function loadmore(Request $req)
{
  if($req->ajax())
  {
    $user = Auth::user();
    $skip = $req->skip;
    $lt = $req->latitude;
    $lg = $req->longitude;
    $today = date("Y-m-d");
    if(Auth::user())
    {
      if($lg== null || $lt== null)
      {
        $pref = explode(",",$user->preference);
        $favcom = explode(",",$user->fav_com);
        $product = Product::where('products.size',$user->pizza_size)->whereRaw('CAST(products.end_time AS DATE)>=?',[$today])->whereRaw('CAST(products.start_time AS DATE)<=?',[$today])->whereIn('products.type',$pref)->whereIn('products.companyID',$favcom)->with('category','store','company')->get();
        $totalProd = count($product);
        $product = $product->slice($skip,$this->product_on_page);
      }
      else
      {
        $product = $this->get_product_for_ajax($lt,$lg,$user);
        $product = $product->slice($skip,$this->product_on_page);
      }
// $product = Product::with('category','store','company')->where('type',$user->preference)->skip($skip)->take(8)->get();
    }
    else
    {
//$product = Product::take(9)->get();
      if(Session::has('latitude') && Session::has('longitude'))
      {
        $lt = Session::get('latitude');
        $lg = Session::get('longitude');
        $product = Product::select('products.*',DB::raw(" IFNULL((3959 * acos(cos(radians(".$lt.")) * cos(radians(stores.latitude)) * cos( radians(stores.longitude) - radians(".$lg.")) + sin(radians(".$lt.")) * sin(radians(stores.latitude)))),0) AS distance "))
        ->join('stores', 'stores.id', '=', 'products.storeID')
        ->whereRaw('CAST(products.end_time AS DATE)>=?',[$today])
        ->whereRaw('CAST(products.start_time AS DATE)<=?',[$today])
        ->orderby('distance')
        ->Having('distance','<=',$this->max_distance)
        ->with('category','store','company')
        ->get();

        $product = $product->slice($skip,$this->product_on_page);
      }
      else
      {
        $product = Product::whereRaw('CAST(products.end_time AS DATE)>=?',[$today])->whereRaw('CAST(products.start_time AS DATE)<=?',[$today])->with('category','store','company')->skip($skip)->take(8)->get();
      }
    }
    return Response()->json($product);
  }
}

public function searchFranchise(Request $req)
{

  $name = strtolower($req->txtsearch);

  /*$franchise = Franchise::whereRaw('LOWER(name) = ?',$name)->first();

  if(count($franchise)>0)
  {
    return redirect()->route('home.store',['slug'=>$franchise->slug]);
  }
  else
  {
    return redirect()->route('home.store')->with('status','No stores found as per your input');
  }*/

    $franchise = Franchise::where('name',$name)->first();
    if($franchise)
    {
        return redirect()->route('home.store',['slug'=>$franchise->slug]);
    }
    else
    {
        return redirect()->route('home.store')->with('status','No stores found as per your input');
    }
}
public function searchTypeAhead(Request $req)
{
  $result = Franchise::where('name','like',"%{$req->txtsearch}%")->get();
  return response()->json($result);
}
// public function storePages($id)
// {
//     $store = Store::where('companyID',$id)->get();
//      $company = Franchise::get();
//     return view('user.store',compact('company','store'));
// }
public function order($id)
{
  if(Auth::user())
  {
    return redirect()->route('home');
  }
  else
  {
    return redirect()->route('home');
  }
}
public function storelocation(Request $req)
{
  if($req->ajax())
  {
    $lt = $req->latitude;
    $lg =$req->longitude;
    $user = Auth::user();
    $ul = new userLocation;
    $ul->userid = Auth()->user()->id;
    $ul->type = "web";
    $ul->latitude = $lt;
    $ul->longitude = $lg;
    $ul->save();
    $product = $this->get_product_for_ajax($lt,$lg,$user);
    $totalProd = $product->count();
    $product = $product->slice(0,$this->product_on_page);
    return Response()->json(["product"=>$product,"totalProd"=>$totalProd]);
  }
  else
  {
    $msg = array("success"=>"0","response"=>"Invalid request");
    return Response::json($msg);
  }
}
public function addstoreview()
{
  $company = Franchise::get();
  return view('user.addstore',compact('company'));
}
public function checkphone(Request $req)
{
  $store = Store::where('phone',$req->phone)->count();
  if($store)
  {
    return Response::json(false);
  }
  else
  {
    return Response::json(true);
  }
}
public function addstore(Request $req)
{
  $st = Store::where('address','LIKE',"%{$req->sadd}%")->where('country',$req->country)->where('city',$req->city)->where('county',$req->county)->count();

  if($st)
  {
    return redirect()->route('home')->with('storeError','This store is already added');
  }
  else
  {
    $monday = array("start"=>$req->t1start,"end"=>$req->t1end);
    $tuseday = array("start"=>$req->t2start,"end"=>$req->t2end);
    $wednesday = array("start"=>$req->t3start,"end"=>$req->t3end);
    $thursday = array("start"=>$req->t4start,"end"=>$req->t4end);
    $friday = array("start"=>$req->t5start,"end"=>$req->t5end);
    $saturday = array("start"=>$req->t6start,"end"=>$req->t6end);
    $sunday = array("start"=>$req->t7start,"end"=>$req->t7end);
    $time = array("monday"=>$monday,"tuseday"=>$tuseday,"wednesday"=>$wednesday,"thursday"=>$thursday,"friday"=>$friday,"saturday"=>$saturday,"sunday"=>$sunday);

    $time = json_encode($time);
    $slug = str_slug($req->sname);
    $total = Store::whereRaw("slug = '$slug' or slug LIKE '$slug-%'")->count();
    if($total)
    {
      if($total!=1)
      {
        $total++;
      }
      $slug = $slug.'-'."$total";
    }
    $store = new Store;
    $store->name = $req->sname;
    $store->slug = $slug;
    $store->phone = $req->sphone;
    $store->companyID = $req->companyid;
    $store->address = $req->sadd;
    $store->street = $req->street;
    $store->county = $req->county;
    $store->country = $req->country;
    $store->state = $req->state;
    $store->city = $req->city;
    $store->zip_code = $req->zipcode;
    $store->url = ' ';
    $store->latitude = ' ';
    $store->longitude = ' ';
    $store->status = 0;

    $store->save();

    $schedule = new schedule;
    $schedule->store_id = $store->id;
    $schedule->time = $time;
    $schedule->save();

    $usr = new storeUser;
    $usr->name = $req->uname;
    $usr->email = $req->uemail;
    $usr->store_id = $store->id;

    $usr->save();

    return redirect()->route('home')->with('success','Your store has been added');
  }
}
}
