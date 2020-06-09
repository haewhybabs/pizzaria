<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use \App\Franchise;
use \App\Store;
use Excel;
class franchiseController extends Controller
{
    //
    public function index()
    {
    	$franchise  = Franchise::get();
    	return view('admin.Franchise.list',compact('franchise'));
    }
    public function addForm()
    {
    	return view('admin.Franchise.add');
    }
    public function view($id)
    {
        $com = Franchise::find($id);
        if($com==null)
        {
            return redirect()->back();
        }
        return view('admin.Franchise.view',compact('com'));
    }
    public function checkName(Request $request)
    {
    	$name = $request->name;
    	$franchise = Franchise::where('name',$name)->count();
    	
    	if($franchise)
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
    		$franchise  = new Franchise();
    		$file = $request->limg;
    		$franchise->name = $request->name;
            $franchise->slug= str_slug($request->name);
    		$franchise->description = $request->description;
    		$franchise->logo = $file->getClientOriginalName();

    		$file->move('adminAssets/franchiseLogo',$file->getClientOriginalName());

    		$franchise->save();
    		$msg = array("success"=>1,'message'=>"Record Added");
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
    	$row  = Franchise::find($id);
        if($row!=null)
        {
            return view('admin.Franchise.edit',compact('row'));
        }
        else
        {
            return redirect()->route('franchies.display');
        }
    	
    }
    public function update(Request $request)
    {
    	if($request->ajax())
    	{
    		$id = $request->id;
    		$franchise  = Franchise::find($id);
    		$franchise->name = $request->name;
    		$franchise->description = $request->description;
    		if($request->limg)
    		{
    			$file = $request->limg;
    			$franchise->logo = $file->getClientOriginalName();
    			$file->move('adminAssets/franchiseLogo',$file->getClientOriginalName());
    		}
    		$franchise->save();
    		$msg = array("success"=>1,'message'=>"record Updated");
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
    	$franchise = Franchise::find($id);
    	$franchise->delete();

    	$msg = array("success"=>1,'message'=>"record deleted");
        return Response::json($msg);
    }
    public function changeStatus(Request $req)
    {
        if($req->ajax())
        {
            if($req->task == "active")
            {
                $status = 1;
            }
            else
            {
                $status = 0;
            }
            $franchise = Franchise::find($req->id);
            $franchise->is_active = $status;
            $franchise->save();

            Store::where('companyID','=',$req->id)->update(['status'=>$status]);
            $msg = array("success"=>1,'message'=>"record updated");
            return Response::json($msg);
        }
    }
    public function importForm()
    {
        return view('admin.Franchise.import');
    }
    public function importdata(Request $request)
    {
        $file = $request->xfile;
        $path =  $file->getRealPath();
        $data = Excel::load($path,function($reader) { })->get();
        
        $data =  $data->toArray();
        foreach($data as $com)
        {
            foreach($com as $row)
            {
                $name = $row['name'];
                $franchise = Franchise::where('name',$name)->first();
                if(!$franchise)
                {
                    $slug = str_slug($name);
                    $franc = new Franchise();
                    $franc->name = $name;
                    $franc->description = $name."'s description";
                    $franc->logo = "default.jpg";
                    $franc->save();
                }
             }
        }
        echo "done";
        die;
    }
}
