@extends('layouts.admin.app')
@section('content')
	<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
         <h3>Message Page</h3>
      </div>
     
     
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Message display</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table  class="table table-striped table-bordered" cellpadding="0">
              <tr>
              	<th>Name</th>
              	<td>{{ $msg->name }}</td>
              </tr>
              <tr>
                <th>Email</th>
                <td>{{ $msg->email }}</td>
              </tr>
              <tr>
                <th>Subject</th>
                <td>{{ $msg->subject }}</td>
              </tr>
              <tr>
                <th>Message</th>
                <td>{{ $msg->comment }}</td>
              </tr>
           </table>
          </div>
          <div class="x_title">
            <h2>Reply to user</h2>
          </div>
          <div class="x_content">
            <form class="form-horizontal form-label-left" novalidate id="replyForm" method="post" action="{{ route('messages.reply') }}">
               @csrf
               <input type="text" name="id" value="{{ $msg->id }}" hidden="true">
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">To Email 
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12"  name="email" value="{{$msg->email }}" readonly >
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Subject 
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12"  name="subject" placeholder="subject"  >
                  </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Message <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea class="form-control" rows="3" name="message" placeholder="message"></textarea>
                    </div>
                </div>
                  <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                      <button id="send" type="submit" class="btn btn-success">Send</button>
                    </div>
                  </div>
             </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')

 <script type="text/javascript" src="{{ asset('adminAssets/js/jquery.validate.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('adminAssets/js/additional-methods.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#replyForm').validate({
          errorClass:"errMsg",
          rules:{
            subject:"required",
            message:"required"
          },
          messages:{
            subject:"Please enter subject",
            message:"Please enter message"
          },
          submitHandler:function(form)
          {
              form.submit();
          }
        })
    });
  </script>
@endsection