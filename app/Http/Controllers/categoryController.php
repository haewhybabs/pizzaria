<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\PizzaCategory;
class categoryController extends Controller
{
    //
    public function index(){

    	$cate = PizzaCategory::get();
    	return view('admin.category.list',compact('cate'));
    }
    public function addForm(){

    	return view('admin.category.add');

    }
    public function checkName(Request $request){

    	$name = $request->name;

    	$cate = PizzaCategory::where('category',$name)->count();
    	
    	if($cate)
    	{
			return Response::json(false);
    	}
    	else
    	{
    		return Response::json(true);
    	}

    }
    public function store(Request $request)
    {
    	if($request->ajax())
    	{
    		$cate = new PizzaCategory();
    		$cate->category = $request->name;
    		$cate->isActive = 1;
    		$cate->save();

    		$msg = array("success"=>1,'message'=>"Record Inserted");
    		return Response::json($msg);
    	}
    	else
    	{
				$msg = array("success"=>0,'message'=>"Something went wrong");
				return Response::json($msg);
    	}
    }
    public function editForm ($id)
    {
    	$cate = PizzaCategory::find($id);
    	if($cate!=null)
    	{
    		return view('admin.category.edit',compact('cate'));
    	}
    	else
    	{
    		return redirect()->route('category.display');
    	}
    }
    public function update(Request $request)
    {
    	$cate = PizzaCategory::find($request->id);

    	if($cate)
    	{
    		$cate->category = $request->name;
    		$cate->isActive = 1;
    		$cate->save();
    		$msg = array('success'=>1,'message'=>'record is updated');
    		return Response::json($msg);
    	}
    	else
    	{
    		$msg = array('success'=>0,'message'=>'Something went wrong');
    		return Response::json($msg);
    	}

    }
    public function changeStatus(Request $request)
    {
    	if($request->ajax())
    	{
    		$cate = PizzaCategory::find($request->id);
    		if($request->checkbox == "on")
    		{
    			$cate->isActive = 1;
    		}
    		else
    		{
    			$cate->isActive = 0;

    		}
    		$cate->save();
    		$msg = array('success'=>1,'message'=>'status changed');
    		return Response::json($msg);
    	}
    	else{

    		$msg = array('success'=>0,'message'=>'Something went wrong');
    		return Response::json($msg);
    	}
    }
    public function delete($id)
    {
    	$cate = PizzaCategory::find($id);
    	$cate->delete();
    	$msg = array('success'=>1,'message'=>'record deleted');
            return Response::json($msg);
    }
}
