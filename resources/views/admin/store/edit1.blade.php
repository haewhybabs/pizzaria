
@extends('layouts.admin.app')
@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Store Page</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Add your store</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
         <form class="form-horizontal form-label-left"  id="editForm" method="post" >
        @csrf
        <div hidden="true">
        	<input type="text" name="id" value="{{$store->id}}">
        	<input type="text" name="sid" value="{{$store->schedule_id}}">
        	<input type="text" name="himg" value="{{$store->imgname}}">

        </div>
          <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input id="name" class="form-control col-md-7 col-xs-12"  name="name" placeholder="Enter Name Here" value="{{$store->name}}">
	            </div>
          </div>
			<div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <textarea class="form-control" rows="3" name="address" placeholder="Enter your Address">{{$store->address}}</textarea>
	            </div>
           </div>
           <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Contact  <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input id="phone" class="form-control col-md-7 col-xs-12"  name="phone" placeholder="Enter Name Here" value="{{$store->contact}}" >
	            </div>
          </div>
<!--           <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Store's Image <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="file" id="simg" class="form-control col-md-7 col-xs-12"  name="simg"  >
	            </div>
          </div> -->
<!--           <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Store's location <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="text"  class="form-control col-md-7 col-xs-12"    >
	            </div>
          </div> -->
         <div class="item form-group">
          	<label class="control-label col-md-3 col-sm-3 col-xs-12">
          		Image
          	</label>
          	<div class="col-md-6 col-sm-6 col-xs-12">
          		<input type="file" name="simg" id="simg">
          	</div>
          </div>
          <div class="item form-group">
          	<label class="control-label col-md-3 col-sm-3 col-xs-12">
          		your Image
          	</label>
          	<div class="col-md-6 col-sm-6 col-xs-12">
          		<img src="{{asset('adminAssets/storeimg/'.$store->imgname)}}" width="50%" id="resimg">
          		<div id="result"></div>
          	</div>
          </div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <button id="send" type="submit" class="btn btn-success">Submit</button>
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
 <script src="{{ asset('adminAssets/js/switchery.min.js') }}"></script>
<script src="{{asset('adminAssets/js/moment.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('adminAssets/js/bootstrap-datetimepicker.min.js')}}"></script>
<script type="text/javascript">
	
	$(document).ready(function(){
	
	$('#simg').change(function(){

		var ext = $('#simg').val().split('.').pop().toLowerCase();
		
		if($.inArray(ext,['jpg','png','jpeg']) == -1)
		{
			$('#result').html('Invalid File');
		}
		else
		{
			
			renderImg(this);
		}
		
	});

	$('#editForm').validate({
		rules:{
			name:"required",
			address:"required",
			simg:{
				
				extension:'jpeg|jpg|png'
			}
		},
		messages:{
			name:"Please Enter name",
			address:"Please Enter address",
			simg:{
				
				extension:"select jpg or jpeg or png file"
			}
		},
		submitHandler:function(form){

			var url= "{{route('store.update')}}";
			$.ajax({
				url:url,
				type:"POST",
				data:new FormData(form),
				contentType:false,
				cache:false,
				processData:false,
				success:function(data){
					console.log(data);
					$('#editForm')[0].reset();
					window.location = "{{ route('store.display') }}?msg=2";
				}

			})
		}
	});
//map script


	});
</script>
<script type="text/javascript">
	function renderImg(url)
	{
		if(url.files[0] && url.files){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#resimg').attr('src',e.target.result);
			}
			reader.readAsDataURL(url.files[0]);
		}
	}
</script>
@endsection