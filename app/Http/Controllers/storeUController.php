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
use Alert;

//use Response;
use Illuminate\Http\Response;
use DB;
use Cookie;
use Session;
use \App\userLocation;

class storeUController extends Controller
{
    private $store_on_page = 8;
    private $max_distance = 10;

    public function storeLogo($slug = '', Request $req)
    {
        $loc = '';
        if ($slug == '') {
            $company = Franchise::get();
            if (Auth::user()) {
                $user = Auth::user();
                $id = Auth::user()->id;
                $loc = userLocation::where('userid', $id)->latest()->first();
                return view('user.storeLogo', compact('user', 'company', 'loc'));
            } else {
                $loc = '';
            }
            return view('user.storeLogo', compact('company', 'loc'));
        } else {
            $user = Auth::user();
            $filter = ['dominos', 'pizza-hut', 'little-caesars', 'papa-johns', 'california-pizza-kitchen', 'papa-murphys', 'sbarro', 'marcos', 'cicis', 'chuck-e-cheese'];
            //If user is authenticated
            if ($user) {
                $loc = userLocation::where('userid', $user->id)->latest()->first();
                //If user has location stored in database
                if (isset($loc) && $loc != '') {
                    $company = Franchise::where('slug', $slug)->first();
                    if ($company == null) {
                        return redirect()->back();
                    }
                    $lat = $loc->latitude;
                    $lon = $loc->longitude;
                    $store = Store::select(
                        'stores.*',
                        DB::raw("3959 * acos(cos(radians(" . $lat . "))
               * cos(radians(stores.latitude))
               * cos(radians(stores.longitude) - radians(" . $lon . "))
               + sin(radians(" . $lat . "))
               * sin(radians(stores.latitude)))
               AS distance"))
                        ->Having('distance', '<=', $this->max_distance)
                        ->where('companyID', $company->id)
                        ->groupBy('stores.id')->get();
                    // dd($store);
                    $totalStore = $store->count();
                    $store = $store->slice(0, $this->store_on_page);
                } //If user does not have location stored in database
                else {
                    $company = Franchise::where('slug', $slug)->first();
                    if ($company == null) {
                        return redirect()->back();
                    }
                    $store = Store::where('companyID', $company->id)->get();
                    $totalStore = $store->count();
                    $store = $store->slice(0, $this->store_on_page);
                }
            } //If user is not authenticated
            else {
                $company = Franchise::where('slug', $slug)->first();
                if ($company == null) {
                    return redirect()->back();
                }
                //If latitude and longitude session exists
                if (Session::has('latitude') && Session::has('longitude')) {
                    $lat = Session::get('latitude');
                    $lon = Session::get('longitude');
                    $store = Store::select('stores.*',
                        DB::raw("3959 * acos(cos(radians(" . $lat . "))
              * cos(radians(stores.latitude))
              * cos(radians(stores.longitude)
              - radians(" . $lon . "))
              + sin(radians(" . $lat . "))
              * sin(radians(stores.latitude)))
              AS distance"))
                        ->Having('distance', '<=', $this->max_distance)
                        ->where('companyID', $company->id)
                        ->groupBy('stores.id')->get();

                    $totalStore = $store->count();
                    $store = $store->slice(0, $this->store_on_page);
                } //If latitude and longitude session does not exist
                else {
                    $store = Store::where('companyID', $company->id)->get();
                    $totalStore = $store->count();
                    $store = $store->slice(0, $this->store_on_page);
                }
            }
            $isLogin = (Auth::user()) ? true : false;
            //}
            // $company = Franchise::get();
            // $com = $company;
            $totalCom = Franchise::count();
            $company = Franchise::get();
            $cate = PizzaCategory::where('isActive', 1)->get();
            //dd($user, $company, $store, $totalStore, $loc, $slug, $totalCom, $cate, $isLogin);
            return view('user.store', compact('user', 'company', 'store', 'totalStore', 'loc', 'slug', 'totalCom', 'cate', 'isLogin', 'filter'));
        }
    }

    public function storeLoadmore(Request $req)
    {
        // dd($req);
        if ($req->ajax()) {
            $skip = $req->skip;
            $slug = $req->slug;
            $filter = $req->filter;
            if ((isset($req->latitude) && $req->latitude != '') && (isset($req->longitude) && $req->longitude != '')) {
                $lat = $req->latitude;
                $lon = $req->longitude;
            }
            if ($filter != '') {
                $company = Franchise::where('slug', $slug)->first();
                $store = Store::orWhere('zip_code', $filter)->orWhere('county', 'LIKE', "%$filter%")->where('companyID', $company->id)->with('products', 'company')->get()->map(function ($store) {
                    $store->setRelation('products', $store->products->take(3));
                    return $store;
                });
                $store = $store->slice($skip, $this->store_on_page);
                return Response()->json($store);
            }

            if (Auth::user()) {
                if ($slug != "notdefine") {
                    $company = Franchise::where('slug', $slug)->first();
                    $store = Store::select('stores.*', DB::raw("3959 * acos(cos(radians(" . $lat . ")) * cos(radians(stores.latitude)) * cos(radians(stores.longitude) - radians(" . $lon . ")) + sin(radians(" . $lat . ")) * sin(radians(stores.latitude))) AS distance"))->Having('distance', '<=', $this->max_distance)->where('companyID', $company->id)->groupBy('stores.id')->with('products', 'company')->where('companyID', $company->id)->get();
                }
                $store = $store->slice($skip, $this->store_on_page);
            } else {
                if ($slug != "notdefine") {
                    $company = Franchise::where('slug', $slug)->first();
                    if (Session::has('latitude') && Session::has('longitude')) {
                        $lat = Session::get('latitude');
                        $lon = Session::get('longitude');
                        $store = Store::select('stores.*', DB::raw("3959 * acos(cos(radians(" . $lat . ")) * cos(radians(stores.latitude)) * cos(radians(stores.longitude) - radians(" . $lon . ")) + sin(radians(" . $lat . ")) * sin(radians(stores.latitude))) AS distance"))->Having('distance', '<=', $this->max_distance)->where('companyID', $company->id)->groupBy('stores.id')->with('products', 'company')->where('companyID', $company->id)->get();
                    } else {
                        $store = Store::with('products', 'company')->where('companyID', $company->id)->get()->map(function ($store) {
                            $store->setRelation('products', $store->products->take(3));
                            return $store;
                        });
                    }
                }
                $store = $store->slice($skip, $this->store_on_page);
            }
            return Response()->json($store);
        } else {
            return Response()->json(["success" => 0, "message" => "Something went wrong"]);
        }
    }

    public function storeDetails($slug)
    {
        //$store = Store::where('slug', $slug)->first();
        $today = date("Y-m-d");
        $franchise = Franchise::where('slug', $slug)->pluck('slug')->first();
        $franchiseRow = Franchise::where('slug', $slug)->first();

        $company = '';
        if ($franchise == 'dominos') {
            $company = 'dominos';
        } elseif ($franchise == 'pizza-hut') {
            $company = 'pizzaHut';
        } elseif ($franchise == 'little-caesars') {
            $company = 'littleCeasars';
        } elseif ($franchise == 'papa-johns') {
            $company = 'papaJohns';
        } elseif ($franchise == 'papa-murphys') {
            $company = 'papaMurphys';
        } elseif ($franchise == 'marcos-pizza') {
            $company = 'marcosPizza';
        } elseif ($franchise == 'cicis') {
            $company = 'cicis';
        }
        $coupons = [];
        $ch = curl_init("https://pizzafeed.herokuapp.com/fetch");
        $payload = json_encode(array("company" => $company, "discountType" => "COUPON", "page" => ""));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $coupons = json_decode($result, true)['response'];


        $deals = [];
        $ch = curl_init("https://pizzafeed.herokuapp.com/fetch");
        $payload = json_encode(array("company" => $company, "discountType" => "SALES & OFFERS", "page" => ""));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $deals = json_decode($result, true)['response'];
        if ($franchise == null) {
            return redirect()->back();
        }
        $product = Product::whereRaw('CAST(end_time AS DATE)>=?', [$today])->whereRaw('CAST(start_time AS DATE)<=?', [$today])->where('companyID', $franchiseRow->id)->get();
        // dd($deals, $coupons, $product);
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            return view('user.storeDetail', compact('user', 'franchiseRow', 'product', 'deals', 'coupons'));
        } else {
            return view('user.storeDetail', compact('franchiseRow', 'product', 'deals', 'coupons'));
        }
    }

    public function checkCookie(Request $req)
    {
        if (Cookie::get('subscribe') !== null) {
            $response = new Response(array("success" => 0, "subscribe" => true));
            return $response;
        } else {
            $response = new Response(array("success" => 0, "subscribe" => false));
            return $response;
        }
    }

    public function saveSubscriber(Request $req)
    {
        if ($req->ajax()) {

            $email = $req->email;
            $user = subscribeUser::where('subscriber_email', $email)->count();
            if ($user) {
                $respone = new Response(array("success" => 1, "message" => "Email is there"));
                $respone->withCookie(cookie()->forever('subscribe', 'true'));
                return $respone;
            } else {
                $user = new subscribeUser();
                $user->subscriber_email = $email;
                $user->save();

                $respone = new Response(array("success" => 1, "message" => "Email is saved"));
                $respone->withCookie(cookie()->forever('subscribe', 'true'));
                return $respone;
            }

        } else {
            $msg = array("success" => 0, "message" => "Oops something went wrong");
            return Response()->json($msg);
        }
    }

    public function searchStore(Request $req)
    {
        if ($req->ajax()) {
            $filter = $req->filter;
            if ($req->slug != 'notdefine') {
                $slug = $req->slug;
                $company = Franchise::where('slug', $slug)->first();
                $store = Store::WhereRaw('(lower(address) like lower(?) or zip_code=?)',
                    ["%{$filter}%", "{$filter}"])
                    ->where('companyID', $company->id)
                    ->with('products', 'company')->get()->map(function ($store) {
                        $store->setRelation('products', $store->products->take(3));
                        return $store;
                    });
                $store = $store->slice(0, $this->store_on_page);
            } else {
                $inc = 0;
                $localStorage = json_decode($req->localStorage);
                foreach ($localStorage->pizzaStore as $value) {
                    $stores = Store::WhereRaw('(lower(address) like lower(?) or zip_code=?)', ["%{$filter}%", "{$filter}"])->where('companyID', $value)->with('products', 'company')->get()->map(function ($store) {
                        $store->setRelation('products', $store->products->take(3));
                        return $store;
                    });
                    foreach ($stores as $value) {
                        $store[$inc] = $value;
                        $inc++;
                    }
                }
            }
            $totalStore = count($store);
            $res = array("success" => 1, "store" => $store, 'totalStore' => $totalStore);

            return Response()->json($res);
        } else {
            $res = array("success" => 0, "message" => "opps!something went wrong");
            return Response()->json($res);
        }
    }

    public function search_filter(Request $req)
    {
        if ($req->ajax()) {
            if (Session::has('latitude') && Session::has('longitude')) {
                $lat = Session::get('latitude');
                $lon = Session::get('longitude');

                if ($req->data) {
                    $data = json_decode($req->data);
                    $pizzastore = $data->pizzaStore;
                    $pizzapref = $data->pizzaPref;
                    $size = $data->pizzaSize;
                    $slug = $data->slug;
                } else {
                    $pizzastore = array();
                    $pizzapref = array();
                    $size = '';
                    $slug = '';
                }
                $company = Franchise::where('slug', $slug)->first();
                $store = Store::select('stores.*', 'franchises.id as company_id', 'franchises.name as company_name', 'franchises.slug as company_slug', 'franchises.description as company_desc', 'franchises.logo as company_logo', 'franchises.created_at', 'franchises.updated_at', 'franchises.is_active', 'products.*', DB::raw("3959 * acos(cos(radians(" . $lat . ")) * cos(radians(stores.latitude)) * cos(radians(stores.longitude) - radians(" . $lon . ")) + sin(radians(" . $lat . ")) * sin(radians(stores.latitude))) AS distance"))
                    ->leftjoin('products', 'stores.id', '=', 'products.storeID')
                    ->leftjoin('pizza_categories', 'pizza_categories.id', '=', 'products.type')
                    ->leftjoin('franchises', 'franchises.id', '=', 'stores.companyID')
                    ->where('stores.companyID', $company->id)
                    ->orwhereIn('franchises.id', $pizzastore)
                    ->orwhereIn('products.type', $pizzapref)
                    ->orwhere('products.size', $size)
                    ->groupBy('stores.id')
                    ->Having('distance', '<=', $this->max_distance)
                    ->get();

                $totalStore = $store->count();
                $store = $store->slice(0, $this->store_on_page);
            } else {
                $data = json_decode($req->data);
                $slug = $data->slug;
                $company = Franchise::where('slug', $slug)->first();
                // $store = Store::select('stores.*','products.*')->leftjoin('franchises','franchises.id','=','stores.companyID')->leftjoin('products','stores.id','=','products.storeID')->where('stores.companyID',$company->id)->get();
                $store = Store::where('companyID', $company->id)->get();
                for ($i = 0; $i < count($store); $i++) {
                    $store[$i]['products'] = Product::where('storeID', $store[$i]['id'])->limit(3)->get();
                }
                $totalStore = $store->count();
                // dd($store);
                $store = $store->slice(0, $this->store_on_page);
            }

            $res = array("success" => 1, "store" => $store, 'totalStore' => $totalStore);
            return Response()->json($res);
        } else {
            $res = array("success" => 0, "message" => "opps!something went wrong");
            return Response()->json($res);
        }
    }

    public function search_preference(Request $request)
    {
        if ($request->ajax()) {
            $data = json_decode($request->data);
            if (session()->get('latitude') && session()->get('latitude')) {
                $user_latitude = session()->get('latitude');
                $user_longitude = session()->get('longitude');
                foreach ($data->pizzaStore as $value) {
                    $store = Store::where('companyID', $value)->get();
                    foreach ($store as $s) {
                        $distance = $this->calculateDistance(
                            $user_latitude,
                            $user_longitude,
                            $s->longitude,
                            $s->latitude
                        );
                        if ($this->max_distance <= $distance) {
                            $stores[] = $s;
                        }
                    }
                }
                $franchiseID = array();
                foreach ($stores as $new_store){
                    if (!in_array($new_store->companyID, $franchiseID)){
                        $franchiseID[] = $new_store->companyID;
                    }
                }
                $franchise = array();
                foreach ($franchiseID as $fran){
                    $data = Franchise::where('id', $fran)->first();
                    $franchise[] = $data;
                }
                $totalStore = count($franchise);

                $res = array(
                    "success"=>1,
                    "message"=> 'success',
                    "store"=>$franchise,
                    'totalStore'=>$totalStore
                );
                //dd($franchise);
                return Response()->json($res);
            } else {
                $franchise = Franchise::get();
                $res = array(
                    "success"=>0,
                    "message"=> 'We cannot access your location at the moment.',
                    "store"=>$franchise
                );
                return Response()->json($res);
            }
        } else {
            $res = array("success" => 0, "message" => "opps!something went wrong");
            return Response()->json($res);
        }
    }

    public function orderNow(Request $request)
    {
        $user = Auth::user();
        $filter = ['dominos', 'pizza-hut', 'little-caesars', 'papa-johns', 'california-pizza-kitchen', 'papa-murphys', 'sbarro', 'marcos', 'cicis', 'chuck-e-cheese'];
        if ($user) {
            $loc = userLocation::where('userid', $user->id)->latest()->first();
            if (isset($loc) && $loc != '') {
                $inc = 0;
                $store = [];
                $lat = $loc->latitude;
                $lon = $loc->longitude;
                $pizzaStores = explode(',', $user['preference']);
                // dd($pizzaStores);
                $slug = 'order-now';
                $slugs = '';
                foreach ($pizzaStores as $value) {
                    $slugs = $slugs . ':' . Franchise::find($value)['slug'];
                    $stores = Store::select('stores.*', DB::raw("3959 * acos(cos(radians(" . $lat . ")) * cos(radians(stores.latitude)) * cos(radians(stores.longitude) - radians(" . $lon . ")) + sin(radians(" . $lat . ")) * sin(radians(stores.latitude))) AS distance"))->Having('distance', '<=', $this->max_distance)->where('companyID', $value)->groupBy('stores.id')->get();
                    foreach ($stores as $value1) {
                        $store[$inc] = $value1;
                        $inc++;
                    }
                }
                for ($i = 0; $i < count($store); $i++) {
                    $store[$i]['products'] = Product::where('storeID', $store[$i]['id'])->limit(3)->get();
                }
                $totalStore = count($store);
                $isLogin = (Auth::user()) ? true : false;
                $totalCom = Franchise::count();
                $company = Franchise::get();
                $cate = PizzaCategory::where('isActive', 1)->get();
                return view('user.store', compact('user', 'company', 'store', 'totalStore', 'loc', 'slug', 'totalCom', 'cate', 'isLogin', 'filter', 'slugs'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function calculateDistance($user_latitude, $user_longitude, $store_longitude, $store_latitude)
    {
        //dd( $store_longitude, $store_latitude);
        $a = sin(deg2rad($store_latitude)) * sin(deg2rad($user_latitude));
        $b = cos(deg2rad($store_latitude)) * cos(deg2rad($user_latitude));
        $c = cos(deg2rad($user_longitude - $store_longitude));
        $distance = rad2deg(acos($a + $b * $c));
        $real_distance = round($distance * 60 * 1.1515, 4);
        //dd($real_distance);
        return $real_distance;
    }
}
