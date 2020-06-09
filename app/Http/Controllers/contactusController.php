<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMessageMail;
use App\Mail\SendReplyMail;
use Response;
use App\User;
use Auth;
use \App\contactMessage;
class contactusController extends Controller
{
    public function view()
    {
        $user = Auth::user();
        if($user)
        {
            $user = User::find(Auth::user()->id);
            return view('user.contact',compact('user'));
        }
        else {
            return view('user.contact');
        }
    }
    public function sendmail(Request $request)
    {
        if($request->ajax())
        {
            $name = $request->name;
            $email = $request->email;
            $subject = $request->subject;
            $comments = $request->comments;
            $to = 'info@pizzapizzaria.com';
            Mail::to($to)->send( new SendMessageMail($email,$subject,$comments));

            $contactMessage = new contactMessage();
            $contactMessage->name = $name;
            $contactMessage->email = $email;
            $contactMessage->subject = $subject;
            $contactMessage->comment = $comments;

            $contactMessage->save();

            $msg = array("success"=>1,"message"=>"Mail has been sent");
            return Response()->json($msg);
        }
        else
        {
            $msg = array("success"=>0,"message"=>"Opps! something went wrong");
            return Response()->json($msg);
        }
    }
    public function getMessages()
    {
        $contactMessage = contactMessage::get();

        return view('admin.message.list',compact('contactMessage'));
    }
    public function getUserMessage($id)
    {
        $msg = contactMessage::find($id);
        if($msg==null)
        {
            return redirect()->back();
        }
        return view('admin.message.view',compact('msg'));
    }
    public function sendReply(Request $request)
    {
        $id= $request->id;
        $to = $request->email;
        $sub = $request->subject;
        $msg = $request->message;

        $userMes = contactMessage::find($id);
        $umsg= $userMes->comment;
        $usub =$userMes->subject;
        Mail::to($to)->send(new SendReplyMail($umsg,$usub,$sub,$msg));

        $doneRecord = contactMessage::find($id);
        $doneRecord->delete();

        return redirect()->route('messages.get')->with('status','Reply has been send to user');
    }
    public function deleteMessage($id)
    {
        $msg = contactMessage::find($id);
        $msg->delete();

        $arr = array("success"=>1,"message"=>"message deleted");
        return response()->json($arr);
    }
}
