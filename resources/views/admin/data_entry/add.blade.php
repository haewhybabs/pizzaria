
@extends('layouts.admin.app')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>List</h3>
      </div>

<!--       <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div> -->
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
 
          <div class="x_content">
        <form class="form-horizontal form-label-left" novalidate id="addForm" method="post" >
        @csrf
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="name" class="form-control col-md-7 col-xs-12"  name="name" placeholder="name" >
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="email" id="email" name="email" placeholder="email"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role">Role <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
             	<select name="role" class="form-control col-md-7 col-xs-12">
             		<option value="">Select Role</option>
             		<option value="0">Super Admin</option>
             		<option value="1">Admin</option>
             		<option value="2">Data Entry User</option>
             	<!-- 	<option value="3">Normal User</option> -->
             	</select>
            </div>
          </div>
          <div class="item form-group">
            <label for="password" class="control-label col-md-3">Password</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="password" type="password" name="password"  class="form-control col-md-7 col-xs-12" >
            </div>
          </div>
          <div class="item form-group">
            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="password2" type="password" name="password2"  class="form-control col-md-7 col-xs-12" >
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
<script type="text/javascript">
	$(document).ready(function(){

		$('#addForm').validate({
       errorClass:"errMsg",
			rules:{
				name:"required",
				email:{
					required:true,
					email:true,
					remote:{
						url:"{{route('admin.validateEmail')}}",
						data:{
							  "_token": "{{ csrf_token() }}",
							  email: function()
	                          {
	                              return $('#addForm :input[name="email"]').val();
	                          }
						},
						type:"post"
					}
				},
				role:"required",
				password:"required",
				password2:{
					equalTo:'#password'
				}
			},
			messages:{
				name:"Please enter name",
				email:{
					required:"Please enter email",
					email:"Please enter proper email",
					remote:"Enter Unique email"
				},
				role:"Please Select Role",
				password:"Please enter password",
				password2:{
					equalTo:"Confirm password doesn't match",
				}
			},
			submitHandler:function(form){
					
			var url = "{{ route('admin.dataentry.store') }}";
			$.ajax({
				url:url,
				type:"POST",
				data:new FormData(form),
				contentType:false,
		        cache:false,
		        processData:false,
		        success:function(data){
		        	console.log(data);
		        	$('#addForm')[0].reset();
		        	window.location = "{{ route('admin.dataentry') }}?msg=2"
		        }
			});			

			}

		});
	})

</script>
@endsection