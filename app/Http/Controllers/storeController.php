<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Auth;
use App\schedule;
use App\Store;
use App\Franchise;
use Response;
use Excel;

class storeController extends Controller
{
    public function display(){
        $user = Auth::guard('admin')->user();

        $store = Store::get();

        return view('admin.store.list',compact('store'));
    }
    public function getData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'Company',
            3 => 'Address',
            4 => 'url',
            5 => 'country',
            6 => 'contact',
            7 => 'Added by',
            8 => 'Action',
            9 => 'status',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $dir = $request->input('order.0.dir');
        $totalData = Store::count();
        $totalFiltered = $totalData;
        if(empty($request->input('search.value')))
        {
            $alldata = Store::offset($start)->limit($limit)->with('owner','company')->get();
        }
        else
        {
            $search = $request->input('search.value');
            $alldata = Store::where('id','like',"%{$search}%")->orWhere('name','like',"%{$search}%")->offset($start)->limit($limit)->with('owner','company')->get();
            $totalFiltered = Store::where('id','like',"%{$search}%")->orWhere('name','like',"%{$search}%")->count();
        }
        $responsedata = array();
        $i=1;
        if(!empty($alldata))
        {
            foreach($alldata as $data)
            {
                if($data->owner)
                {
                    $added=$data->owner->name;
                }
                else
                {
                    $added = "admin";
                }
                $nestestData['id'] = $i++;
                $nestestData['name'] = $data->name;
                $nestestData['Company'] = $data->company->name;
                $nestestData['Address'] = $data->address;
                $nestestData['url'] = $data->url;
                $nestestData['country'] = $data->country;
                $nestestData['contact'] = $data->phone;
                $nestestData['Added by'] = $added;
                $nestestData['Action'] = "<a href='/admin/store/edit/$data->id' class='btn-edit label label-info' data-toggle='tooltip' title='edit'><i class='fa fa-edit'></i></a>
                <a data-url='/admin/store/delete/$data->id' href='javascript:void(0)' class='btn-delete label label-danger deleteStore' data-toggle='tooltip' title='delete'><i class='fa fa-trash'></i></a>
                <a href='/admin/store/view/$data->id' class='btn-edit label label-success' data-toggle='tooltip' title='view'><i class='fa fa-eye'></i></a>";
                if($data->status == 1)
                {
                    $checked="checked";
                }
                $nestestData['status'] = "<input type='checkbox' class='js-switch' name='status' {{ $checked }} data-id='$data->id'>";
                $responsedata[] = $nestestData;
            }
            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $responsedata
            );
            echo json_encode($json_data);
        }
    }
    public function userStore()
    {
        $store = Store::where('status',0)->get();
        return view('admin.store.list',compact('store'));
    }
    public function view($id)
    {
        $store = Store::find($id);
        if($store==null)
        {
            return redirect()->back();
        }
        $schedule = $store->schedule;
        $time = json_decode($schedule->time);

        return view('admin.store.view',compact('store','time'));
    }
    public function showForm()
    {
        $cate = Franchise::get();
        return view('admin.store.add',compact('cate'));
    }
    public function importForm()
    {
        $cate = Franchise::get();
        return view('admin.store.import',compact('cate'));
    }
    public function importData(Request $req)
    {
        $cid = $req->company;
        $timedata = array ('monday' => array ('start' => array (0 => '09:00 AM',),'end' => array (0 => '06:00 PM',),),'tuseday' => array ('start' => array (0 => '09:00 AM',),'end' => array (0 => '06:00 PM',),),'wednesday' => array ('start' => array (0 => '09:00 AM',),'end' => array (0 => '06:00 PM',),),'thursday' => array ('start' => array (0 => '09:00 AM',),'end' => array (0 => '06:00 PM',),),'friday' => array ('start' => array (0 => '09:00 AM',),'end' => array (0 => '06:00 PM',),),'saturday' => array ('start' => array (0 => '09:00 AM',),'end' => array (0 => '06:00 PM',),),'sunday' => array ('start' => array (0 => '09:00 AM',),'end' => array (0 => '06:00 PM',),),);

        $time = json_encode($timedata);

        $file = $req->xfile;
        $path =  $file->getRealPath();
        $data = Excel::load($path,function($reader) { })->get();

        $data = $data->toArray();
        $ftime = Array();

        $prefDay = array("Su"=>array("id"=>1,"name"=>"sunday"),"Mo"=>array("id"=>2,"name"=>"monday"),"Tu"=>array("id"=>3,"name"=>"Tuesday"),"We"=>array("id"=>4,"name"=>"wednesday"),"Th"=>array("id"=>5,"name"=>"thursday"),"Fr"=>array("id"=>6,"name"=>"friday"),"Sa"=>array("id"=>7,"name"=>"saturday"));
        $arr = array("sunday","monday","tuesday","wednesday","thursday","friday","saturday");
        foreach($data as $row)
        {
            if($row['open_hours']=="null" || $row['open_hours']=="" || $row['open_hours']==" ")
            {
                $ftime = $timedata;
            }
            else
            {
                $days = explode(",",$row['open_hours']);
                foreach($days as $day)
                {
                    $day = ltrim($day);
                    $time = explode(":-",$day);

                    if(count($time) == 2)
                    {
                        $temp = explode('-', $time[0]);
                        $timing = explode('-', $time[1]);
                        if(count($temp)==2)
                        {
                            $start = $prefDay[$temp[0]]["id"];
                            $end = $prefDay[$temp[1]]["id"];
                            for($i=$start;$i<=$end;$i++)
                            {
                                $key = $arr[$i-1];
                                if(!in_array("Closed",$timing))
                                {
                                    $s = $timing[0];
                                    $e = $timing[1];
                                }
                                else
                                {
                                    $s = "0:00AM";
                                    $e = "0:00AM";
                                }
                                $ftime[$key] = array('start'=>array(0=>$s),'end'=>array(0=>$e));
                            }
                        }
                        elseif(count($temp)==1)
                        {
                            $d = $time[0];
                            $i = $prefDay[$d]["id"];
                            $timing = explode('-', $time[1]);
                            $key = $arr[$i-1];
                            if(!in_array("Closed",$timing))
                            {
                                $s = $timing[0];
                                $e = $timing[1];
                            }
                            else
                            {
                                $s = "0:00AM";
                                $e = "0:00AM";
                            }
                            $ftime[$key] = array('start'=>array(0=>$s),'end'=>array(0=>$e));
                        }
                    }
                }
            }
            $franchise = Franchise::where('name',$row['provider'])->first();
            if($franchise)
            {
                $cid = $franchise->id;
            }
            else
            {
                $franchise = new Franchise();
                $franchise->name = $row['provider'];
                $franchise->slug = str_slug($row['provider']);
                $franchise->description = "default value";
                $franchise->logo = "default value";
                $franchise->save();

                $cid = $franchise->id;
            }
            $store = Store::where('companyID',$cid)->where('name',addslashes($row['name']))->count();
            if($store)
            {
                $iflag = false;
            }
            else
            {
                $iflag = true;
            }
            $slug = str_slug($row['name']);
            $total = Store::whereRaw("slug = '$slug' or slug LIKE '$slug-%'")->count();
            if($total)
            {
                if($total!=1)
                {
                    $total++;
                }
                $slug = $slug.'-'."$total";

            }
            if($iflag)
            {
                $store = new Store;
                $store->name =addslashes($row['name']);
                $store->slug = $slug;
                $store->latitude = addslashes($row['latitude']);
                $store->longitude = addslashes($row['longitude']);
                $store->address = addslashes($row['address']);
                $store->street =addslashes( $row['street']);
                $store->city = addslashes($row['city']);
                $store->state = addslashes($row['state']);
                $store->zip_code = addslashes($row['zip_code']);
                $store->county =addslashes($row['county']);
                $store->phone = addslashes($row['phone']);
                $store->url =addslashes( $row['url']);
                $store->country = addslashes($row['country']);
                $store->companyID = $cid ;
                $store->status = 1;
                $store->save();


                $stime = json_encode($ftime);
                $schedule = new schedule;
                $schedule->store_id = $store->id;
                $schedule->time = $stime;
                $schedule->save();
            }
        }
        return redirect()->route('store.display')->with('status','record Inserted');

    }
    public function storeItem(Request $request)
    {
        if($request->ajax())
        {

            $monday = array("start"=>$request->t1start,"end"=>$request->t1end);
            $tuseday = array("start"=>$request->t2start,"end"=>$request->t2end);
            $wednesday = array("start"=>$request->t3start,"end"=>$request->t3end);
            $thursday = array("start"=>$request->t4start,"end"=>$request->t4end);
            $friday = array("start"=>$request->t5start,"end"=>$request->t5end);
            $saturday = array("start"=>$request->t6start,"end"=>$request->t6end);
            $sunday = array("start"=>$request->t7start,"end"=>$request->t7end);
            $time = array("monday"=>$monday,"tuseday"=>$tuseday,"wednesday"=>$wednesday,"thursday"=>$thursday,"friday"=>$friday,"saturday"=>$saturday,"sunday"=>$sunday);

            $time = json_encode($time);
            $slug = str_slug($request->name);
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
            $store->name = $request->name;
            $store->slug = $slug;
            $store->latitude = $request->latitude;
            $store->longitude = $request->longitude;
            $store->address = $request->address;
            $store->street = $request->street;
            $store->city = $request->city;
            $store->state = $request->state;
            $store->street = $request->state;
            $store->zip_code = $request->zip_code;
            $store->county = $request->county;
            $store->phone = $request->phone;
            $store->url = $request->url;
            $store->country = $request->country;
            $store->companyID = $request->company;
            $store->status = 1;

            $store->save();
            $schedule = new schedule;
            $schedule->store_id = $store->id;
            $schedule->time = $time;
            $schedule->save();
            $msg = array("success"=>1,"msg"=>"data inserted");

            return Response::json($msg);
        }
        else
        {
            $msg = array("success"=>0,"msg"=>"Something went wrong");

            return Response::json($msg);
        }
    }

    public function editForm($id)
    {
        $cate = Franchise::get();
        $store = Store::find($id);
        if($store==null)
        {
            return redirect()->route('store.display');
        }
        else
        {
            $schedule = $store->schedule;
            $time = json_decode($schedule->time);

            return view('admin.store.edit',compact('store','time','schedule','cate'));
        }
    }
    public function update(Request $request)
    {
        if($request->ajax())
        {
            $monday = array("start"=>$request->t1start,"end"=>$request->t1end);
            $tuseday = array("start"=>$request->t2start,"end"=>$request->t2end);
            $wednesday = array("start"=>$request->t3start,"end"=>$request->t3end);
            $thursday = array("start"=>$request->t4start,"end"=>$request->t4end);
            $friday = array("start"=>$request->t5start,"end"=>$request->t5end);
            $saturday = array("start"=>$request->t6start,"end"=>$request->t6end);
            $sunday = array("start"=>$request->t7start,"end"=>$request->t7end);
            $time = array("monday"=>$monday,"tuseday"=>$tuseday,"wednesday"=>$wednesday,"thursday"=>$thursday,"friday"=>$friday,"saturday"=>$saturday,"sunday"=>$sunday);

            $time = json_encode($time);

            $id = $request->id;
            $store = Store::find($id);
            $store->name = $request->name;
            $store->latitude = $request->latitude;
            $store->longitude = $request->longitude;
            $store->address = $request->address;
            $store->url = $request->url;
            $store->street = $request->street;
            $store->city = $request->city;
            $store->state = $request->state;
            $store->street = $request->state;
            $store->zip_code = $request->zip_code;
            $store->county = $request->county;
            $store->phone = $request->phone;
            $store->url = $request->url;
            $store->country = $request->country;
            $store->status = 1;
            $store->save();

            $schedule = schedule::find($request->sid);
            $schedule->store_id = $id;
            $schedule->time = $time;

            $schedule->save();

            $msg = array("success"=>1,"message"=>"Record updated");
            return Response::json($msg);
        }
        else
        {
            $msg = array("success"=>0,"message"=>"Something went wrong");
            return Response::json($msg);
        }
    }
    public function delete($id){
        $store = Store::find($id);
        $store->delete();
        $msg = array("success"=>1,"message"=>"Record is deleted");
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
            $store = Store::find($req->id);
            $store->status = $status;
            $store->save();
            $msg = array("success"=>1,"message"=>"Record updated");
            return Response::json($msg);
        }
    }
}