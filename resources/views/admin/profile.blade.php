@extends('layouts.admin.app')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>List</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
 
          <div class="x_content">
        <form class="form-horizontal form-label-left" novalidate id="addForm" method="post"  >
        @csrf
        <div hidden="true">
        	<input type="text" name="id" value="{{ $user->id }}">
        </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="name" class="form-control col-md-7 col-xs-12"  name="name" value="{{ $user->name }}" >
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  class="form-control col-md-7 col-xs-12"  name="email" value="{{ $user->email }}" disabled="true">
            </div>
          </div>
          <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Current password <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                	<input type="password" class="form-control col-md-7 col-xs-12"  name="currentPassword"  >
              </div>
          </div>
          <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                	<input type="password" class="form-control col-md-7 col-xs-12"  name="password" id="pass" >
                	 <div>(If you don't want to change password then leave it blank)</div>
              </div>
             
          </div>
          <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                	<input type="password" class="form-control col-md-7 col-xs-12"  name="cpassword"  >
              </div>
          </div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <button id="send" type="submit" class="btn btn-success">Submit</button>
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
  		$('#addForm').validate({
        errorClass:"errMsg",
        //errorElement: 'span',
  			rules:{
  				name:"required",
  				currentPassword:{
  					required:true,
  					remote:{
  						url:"{{ route('admin.checkPassword')}}",
  						type:"post",
  						data:{
  							 "_token": "{{ csrf_token() }}",
		                    pass:function(){
		                      return $('#addForm :input[name="currentPassword"]').val();
		                        }
		                    },
  					},
  				},
  				cpassword:{
  					equalTo:"#pass"
  				}
  			},
  			messages:{
  				name:"Please enter name",
  				currentPassword:{
  					required:"Please enter your current password",
  					remote:"Current password is incorrect"
  				},
  				cpassword:{
  					equalTo:"password must match"
  				}
  				

  			},
  			submitHandler:function(form)
  			{
  				$.ajax({
  					url:"{{ route('admin.changeProfile') }}",
  					type:"post",
  					data:new FormData(form),
  					cache:false,
  					processData:false,
  					contentType:false,
  					success:function(data){
  						console.log(data);
  						if(data.success == 1)
  						{
  							window.location = "{{route('admin.home')}}";
  						}
  					}
  				});
  			}
  		})

  	});

  </script>

@endsection