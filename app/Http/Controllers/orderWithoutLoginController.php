<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use \App\Product;
use \App\Store;
use \App\Franchise;
use \App\PizzaCategory;
use \App\schedule;
use \App\storeUser;
use \App\subscribeUser;
Use Alert;
use Illuminate\Http\Response;
use DB;
use Cookie;
use Session;
use \App\userLocation;

class orderWithoutLoginController extends Controller
{
  private $store_on_page=8;
  private $max_distance = 10;
  /*public function storeLogo($slug='',Request $req)
  {
    $user = Auth::user();
    if(!$user)
    {
      $company = Franchise::where('slug',$slug)->first();
      if($company == null)
      {
        return redirect()->back();
      }
      if(Session::has('latitude') && Session::has('longitude'))
      {
        $lat = Session::get('latitude');
        $lon = Session::get('longitude');
        $store= Store::select('stores.*',
            DB::raw("3959 * acos(cos(radians(" . $lat . "))
            * cos(radians(stores.latitude))
            * cos(radians(stores.longitude)
            - radians(" . $lon . "))
            + sin(radians(" .$lat. "))
            * sin(radians(stores.latitude)))
            AS distance"))
            ->Having('distance','<=',$this->max_distance)
            ->where('companyID',$company->id)
            ->groupBy('stores.id')->get();

        $totalStore = $store->count();
        $store = $store->slice(0,$this->store_on_page);
      }
      else
      {
        $store = Store::where('companyID',$company->id)->get();
        $totalStore = $store->count();
        $store = $store->slice(0,$this->store_on_page);
      }
      $filter = ['dominos', 'pizza-hut', 'little-caesars', 'papa-johns', 'california-pizza-kitchen', 'papa-murphys', 'sbarro', 'marcos', 'cicis-pizza', 'chuck-e-cheese'];
      $isLogin = (Auth::user())?true:false;
      $totalCom = Franchise::count();
      $company = Franchise::get();
      $cate = PizzaCategory::where('isActive',1)->get();
      //dd($store, $filter, $isLogin, $totalCom, $company, $cate);
      return view('user.store',compact('company','store','totalStore','slug','totalCom','cate','isLogin', 'filter'));
    }
    else
    {
      return redirect()->route('home');
    }
  }*/

  public function storeLogo()
  {
      $slug='';
    $user = Auth::user();
    if(!$user)
    {
      $company = Franchise::where('slug',$slug)->first();
      //dd($company);
      if($company == null)
      {
        return redirect()->back();
      }
      if(Session::has('latitude') && Session::has('longitude'))
      {
        $lat = Session::get('latitude');
        $lon = Session::get('longitude');
        $store= Store::select('stores.*',
            DB::raw("3959 * acos(cos(radians(" . $lat . "))
            * cos(radians(stores.latitude))
            * cos(radians(stores.longitude)
            - radians(" . $lon . "))
            + sin(radians(" .$lat. "))
            * sin(radians(stores.latitude)))
            AS distance"))
            ->Having('distance','<=',$this->max_distance)
            ->where('companyID',$company->id)
            ->groupBy('stores.id')->get();

        $totalStore = $store->count();
        $store = $store->slice(0,$this->store_on_page);
      }
      else
      {
        $store = Store::where('companyID',$company->id)->get();
        $totalStore = $store->count();
        $store = $store->slice(0,$this->store_on_page);
      }
      $filter = ['dominos', 'pizza-hut', 'little-caesars', 'papa-johns', 'california-pizza-kitchen', 'papa-murphys', 'sbarro', 'marcos', 'cicis-pizza', 'chuck-e-cheese'];
      $isLogin = (Auth::user())?true:false;
      $totalCom = Franchise::count();
      $company = Franchise::get();
      $cate = PizzaCategory::where('isActive',1)->get();
      $toppings = DB::table('toppings')->get();
      //dd($store, $filter, $isLogin, $totalCom, $company, $cate);
      return view('user.store',compact('company','store','totalStore','slug','totalCom','cate','isLogin', 'filter','toppings'));
    }
    else
    {
      return redirect()->route('home');
    }
  }
}
