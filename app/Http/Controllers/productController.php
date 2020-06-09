<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Franchise;
use \App\Store;
use \App\PizzaCategory;
use \App\Product;
use Response;
use Image;
class productController extends Controller
{
    //
    public function index(){
    	$product = Product::get();
        
    	return view('admin.product.list',compact('product'));

    }
    public function view($id)
    {
        $prd = Product::find($id);
        if($prd==null)
        {
            return redirect()->back();
        }
        return view('admin.product.view',compact('prd'));
    }
    public function addForm(){

    	$company = Franchise::get();
    	$type = PizzaCategory::where('isActive',1)->get();
    	return view('admin.product.add',compact('company','type'));
    }
    public function getStore(Request $request)
    {
    	$company = Franchise::find($request->company);
    	$store = $company->stores;
    	return Response::json($store);	
    }
    public function storeProduct(Request $request)
    {
    	if($request->ajax())
    	{	
    		$file = $request->limg;
    		$imgname = time().$request->store.$request->type.".".$file->getClientOriginalExtension();

    		$product = new Product();
    		$product->name = $request->name;
    		$product->companyID = $request->company;
    		$product->storeID = $request->store;
    		$product->type = $request->type;
    		$product->price = $request->price;
            $product->size = $request->size;
    		$product->topping = $request->topping;
            $product->start_time = date("Y-m-d", strtotime($request->starttime));   
            $product->end_time = date("Y-m-d", strtotime($request->endtime));
    		$product->pizzaImage = $imgname;
    		$product->save();
    	
    		
    		$img = Image::make($file->getRealpath());
    		$imgname = time().$request->store.$request->type.".".$file->getClientOriginalExtension();

    		$img->resize(300,300, function ($constraint) {
             $constraint->aspectRatio();
            })->save('pizzaImage/'.$imgname);


    		//$img->save('pizzaImage/'.$imgname);

			$msg = array("success"=>1,'message'=>"Product inserted");
			return Response::json($msg);

    	}
    	else
    	{
    		$msg = array("success"=>0,'message'=>"Something went wrong");
			return Response::json($msg);
    	}
    }
    public function editForm($id)
    {
    	$product = Product::find($id);
        if($product==null)
        {
            return redirect()->route('product.display');
        }
        else
        {
            $stores = Store::where('companyID',$product->companyID)->get();
            $company = Franchise::get();
            $type = PizzaCategory::get();
            return view('admin.product.edit',compact('product','stores','company','type'));
        }
    	
    }
    public function update(Request $request)
    {
    	if($request->ajax())
    	{
    		$product = Product::find($request->id);
    		$product->name = $request->name;
    		$product->companyID = $request->company;
    		$product->storeID = $request->store;
    		$product->type = $request->type;
    		$product->price = $request->price;
            $product->size = $request->size;
            $product->topping = $request->topping;
            $product->start_time = date("Y-m-d", strtotime($request->starttime));
    		$product->end_time = date("Y-m-d", strtotime($request->endtime));

    		if($request->limg)
    		{

    			$file = $request->limg;
    			$imgname = time().$request->store.$request->type.".".$file->getClientOriginalExtension();
    			$img = Image::make($file->getRealpath());
    			$imgname = time().$request->store.$request->type.".".$file->getClientOriginalExtension();
    			$img->resize(300,300, function ($constraint) {
            		 $constraint->aspectRatio();
            	})->save('pizzaImage/'.$imgname);
    			//$img->save('pizzaImage/'.$imgname);
    			$product->pizzaImage = $imgname;
    		}
    		$product->save();
    		$msg = array("success"=>1,'message'=>"Product updated");
			return Response::json($msg);

    	}
    	else
    	{
    		$msg = array("success"=>0,'message'=>"Something went wrong");
			return Response::json($msg);
    	}
    }
    public function delete($id)
    {
    	$product = Product::find($id);
    	$product->delete();
    	$msg = array("success"=>1,'message'=>"Product deleted");
            return Response::json($msg);
    }
}
