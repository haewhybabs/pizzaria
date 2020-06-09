
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
         <form class="form-horizontal form-label-left"  id="addForm" method="post" >
        @csrf
          <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input id="name" class="form-control col-md-7 col-xs-12"  name="name" placeholder="Name" >
	            </div>
          </div>
           <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Latitude <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input id="latitude" class="form-control col-md-7 col-xs-12"  name="latitude" placeholder="latitude" >
	            </div>
          	</div>
          	<div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Longitude <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input id="longitude" class="form-control col-md-7 col-xs-12"  name="longitude" placeholder="longitude" >
	            </div>
          	</div>
			<div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <textarea class="form-control" rows="3" name="address" placeholder="Address"></textarea>
	            </div>
           </div>
             <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Country <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input id="country" class="form-control col-md-7 col-xs-12"  name="country" placeholder="country" >
	            </div>
          	</div>
          	<div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">State <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input id="state" class="form-control col-md-7 col-xs-12"  name="state" placeholder="state" >
	            </div>
          	</div>
          	<div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">City <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input id="city" class="form-control col-md-7 col-xs-12"  name="city" placeholder="city" >
	            </div>
          	</div>
           <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="zip_code">zip code  <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input id="zip_code" class="form-control col-md-7 col-xs-12"  name="zip_code" placeholder="zip code" >
	            </div>
          </div>
         <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="county">County  <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input id="county" class="form-control col-md-7 col-xs-12"  name="county" placeholder="county" >
	            </div>
          </div>
           <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone  <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input id="phone" class="form-control col-md-7 col-xs-12"  name="phone" placeholder="Phone" >
	            </div>
          </div>
          <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">Url  <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input id="url" class="form-control col-md-7 col-xs-12"  name="url" placeholder="url" >
	            </div>
          </div>
         <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">Company  <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <select class="form-control col-md-7 col-xs-12" name="company" id="company">
	              	<option value="">Select</option>
	              	@foreach($cate as $c)
	              		<option value="{{ $c->id }}">{{ $c->name }}</option>
	              	@endforeach
	              </select>
	            </div>
          </div>
          <div class="item   form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Monday  
	            </label>
	            <div class="col-sm-1">
	            	<label>
	            		 <input type="checkbox" class="js-switch" checked="true" data-id="t1">
	            	</label>
	            </div>
	            <div id="t1">
	            	<div class="row">
		            	<div class="col-sm-2">
				            <div class="input-group date" >
		                        <input type="text" class="t1 start form-control" name="t1start[]" >
		                        <span class="input-group-addon" style="">
		                           <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
			                </div>
		            	</div>
		            	<div class="col-sm-2">
			               	<div class="input-group date" >
		                        <input type="text" class="t1  end form-control" name="t1end[]">
		                        <span class="input-group-addon" style="">
		                           <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
			                </div>
		            	</div>
		            	<div class="col-sm-1">
	            			<button class="addHours btn btn-success"  data-id="t1"><i class="fa fa-plus"></i></button>
	           			</div>

	            	</div>	

	            </div>
	            
          </div>
          <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Tuseday  
	            </label>
	            <div class="col-sm-1">
	            	<label>
	            		 <input type="checkbox" class="js-switch" checked="true" data-id="t2">
	            	</label>
	            </div>
				<div id="t2">
					<div class="row">
						<div class="col-sm-2">
				            <div class="input-group date" >
		                        <input type="text" class="t2 start form-control" name="t2start[]">
		                        <span class="input-group-addon" style="">
		                           <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
			                </div>
	            		</div>
		            	<div class="col-sm-2">
			               	<div class="input-group date" >
		                        <input type="text" class="t2 end form-control" name="t2end[]">
		                        <span class="input-group-addon" style="">
		                           <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
			                </div>
		            	</div>
		            	<div class="col-sm-1">
		            		<button class="addHours btn btn-success"  data-id="t2"><i class="fa fa-plus"></i></button>
		            	</div>
	            	</div>
				</div>
				
          </div>
          <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Wednesday  
	            </label>
	            <div class="col-sm-1">
	            	<label>
	            		 <input type="checkbox" class="js-switch" checked="true" data-id="t3">
	            	</label>
	            </div>
	           <div id="t3">
					<div class="row">
						<div class="col-sm-2">
				            <div class="input-group date" >
		                        <input type="text" class="t3 start form-control" name="t3start[]">
		                        <span class="input-group-addon" style="">
		                           <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
			                </div>
	            		</div>
		            	<div class="col-sm-2">
			               	<div class="input-group date" >
		                        <input type="text" class="t3 end form-control" name="t3end[]">
		                        <span class="input-group-addon" style="">
		                           <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
			                </div>
		            	</div>
		            	<div class="col-sm-1">
		            		<button class="addHours btn btn-success"  data-id="t3"><i class="fa fa-plus"></i></button>
		            	</div>
	            	</div>
				</div>

          </div>
          <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Thursday  
	            </label>
	            <div class="col-sm-1">
	            	<label>
	            		 <input type="checkbox" class="js-switch" checked="true" data-id="t4">
	            	</label>
	            </div>
	            <div id="t4">
					<div class="row">
						<div class="col-sm-2">
				            <div class="input-group date" >
		                        <input type="text" class="t4 start form-control" name="t4start[]">
		                        <span class="input-group-addon" style="">
		                           <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
			                </div>
	            		</div>
		            	<div class="col-sm-2">
			               	<div class="input-group date" >
		                        <input type="text" class="t4 end form-control" name="t4end[]">
		                        <span class="input-group-addon" style="">
		                           <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
			                </div>
		            	</div>
		            	<div class="col-sm-1">
		            		<button class="addHours btn btn-success"  data-id="t4"><i class="fa fa-plus"></i></button>
		            	</div>
	            	</div>
				</div>
	            
          </div>
          <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Friday  
	            </label>
	            <div class="col-sm-1">
	            	<label>
	            		 <input type="checkbox" class="js-switch" checked="true" data-id="t5">
	            	</label>
	            </div>
				<div id="t5">
					<div class="row">
						<div class="col-sm-2">
				            <div class="input-group date" >
		                        <input type="text" class="t5 start form-control" name="t5start[]">
		                        <span class="input-group-addon" style="">
		                           <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
			                </div>
	            		</div>
		            	<div class="col-sm-2">
			               	<div class="input-group date" >
		                        <input type="text" class="t5 end form-control" name="t5end[]">
		                        <span class="input-group-addon" style="">
		                           <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
			                </div>
		            	</div>
		            	<div class="col-sm-1">
		            		<button class="addHours btn btn-success"  data-id="t5"><i class="fa fa-plus"></i></button>
		            	</div>
	            	</div>
				</div>
          </div>
          <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">saturday  
	            </label>
	            <div class="col-sm-1">
	            	<label>
	            		 <input type="checkbox" class="js-switch" checked="true" data-id="t6">
	            	</label>
	            </div>
				<div id="t6">
					<div class="row">
						<div class="col-sm-2">
				            <div class="input-group date" >
		                        <input type="text" class="t6 start form-control" name="t6start[]">
		                        <span class="input-group-addon" style="">
		                           <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
			                </div>
	            		</div>
		            	<div class="col-sm-2">
			               	<div class="input-group date" >
		                        <input type="text" class="t6 end form-control" name="t6end[]">
		                        <span class="input-group-addon" style="">
		                           <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
			                </div>
		            	</div>
		            	<div class="col-sm-1">
		            		<button class="addHours btn btn-success"  data-id="t6"><i class="fa fa-plus"></i></button>
		            	</div>
	            	</div>
				</div>
          </div>
          <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">sunday  
	            </label>
	            <div class="col-sm-1">
	            	<label>
	            		 <input type="checkbox" class="js-switch" checked="true" data-id="t7">
	            	</label>
	            </div>
				<div id="t7">
					<div class="row">
						<div class="col-sm-2">
				            <div class="input-group date" >
		                        <input type="text" class="t7 start form-control" name="t7start[]">
		                        <span class="input-group-addon" style="">
		                           <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
			                </div>
	            		</div>
		            	<div class="col-sm-2">
			               	<div class="input-group date" >
		                        <input type="text" class="t7 end form-control" name="t7end[]">
		                        <span class="input-group-addon" style="">
		                           <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
			                </div>
		            	</div>
		            	<div class="col-sm-1">
		            		<button class="addHours btn btn-success"  data-id="t7"><i class="fa fa-plus"></i></button>
		            	</div>
	            	</div>
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
<script type="text/javascript" src="{{ asset('adminAssets/js/select2.js')}}"></script>
<script type="text/javascript">
	
	$.fn.select2.defaults = $.extend($.fn.select2.defaults, {
    allowClear: true, // Adds X image to clear select
    closeOnSelect: true, // Only applies to multiple selects. Closes the select upon selection.
    placeholder: 'Select.',
    minimumResultsForSearch: 15 // Removes search when there are 15 or fewer options
	});

	$(document).ready(function(){

		var configParamsObj = {
        placeholder: 'Select an option...', // Place holder text to place in the select
        minimumResultsForSearch: 3,  // Overrides default of 15 set above
        width: 'resolve',
        theme: "classic"
    };
    var a = Array.prototype.slice.call(document.querySelectorAll(".js-switch"));
        a.forEach(function(a) {
            new Switchery(a,{
                color: "#26B99A",
                 size:'small',
            })
         });
    $("#company").select2(configParamsObj);

		var max = [];
		max['t1']=0;
		max['t2']=0;
		max['t3']=0;
		max['t4']=0;
		max['t5']=0;
		max['t6']=0;
		max['t7']=0;
		
		$('.start').val('09:00 AM');
		$('.end').val('06:00 PM');

		$('.date').datetimepicker({
		format: 'hh:mm A'
	});
	$('.js-switch').click(function(){

		var id = $(this).data('id');

		//alert($('#'+id).is(':hidden'));
		
		var  dis= $('.'+id).prop('disabled');
		//alert(dis);
		if(dis)
		{
			$('.'+id).prop('disabled',false);
		}
		else
		{
			$('.'+id).prop('disabled',true);
		}
	});
	$('.addHours').click(function(e){
		e.preventDefault();
		var id = $(this).data('id');
		if(max[''+id+''] < 5)
		{
			
			max[''+id+'']++;
			var txthtml = '<div class="row">';
    		txthtml+= '<div class="col-md-4"></div>';
    		txthtml+= '<div class="col-sm-2">';
    		txthtml+= '<div class="input-group date" >';
    		txthtml+= ' <input type="text" class="'+id+' start form-control" name="'+id+'start[]" >';
    		txthtml+= '<span class="input-group-addon" style="">';
    		txthtml+= ' <span class="glyphicon glyphicon-calendar"></span>';
    		txthtml+= ' </span>';
    		txthtml+= ' </div></div>';
    		txthtml+= '<div class="col-sm-2">';
    		txthtml+= '	<div class="input-group date" >';
    		txthtml+= '<input type="text" class="'+id+' end form-control" name="'+id+'end[]">';
    		txthtml+= '<span class="input-group-addon" style="">';
    		txthtml+= ' <span class="glyphicon glyphicon-calendar"></span>';
    		txthtml+= ' </span></div></div>';
    		txthtml+= '<div class="col-sm-1">';
    		txthtml+= '<button class="delHours btn btn-danger"  data-id="t1"><i class="fa fa-minus"></i></button>';
    		txthtml+= '</div></div>';
	         console.log(txthtml);  
			 $('#'+id).append(txthtml); 
			 	$('.date').datetimepicker({
				format: 'hh:mm A'
				});
			 $('.start').val('09:00 AM');
			$('.end').val('06:00 PM');
		}
		
	});
	$(document).on('click','.delHours',function(e){
		e.preventDefault();
		var id = $(this).data('id');
		 $(this).closest("div.row").remove();max[''+id+'']--;
	})

	$('#addForm').validate({
		 errorClass:"errMsg",
		rules:{
			name:"required",
			address:"required",
			latitude:"required",
			longitude:"required",
			street:"required",
			city:"required",
			state:"required",
			zip_code:"required",
			county:"required",
			phone:{
				required:true,
				number:true,
			},
			country:"required",
			url:"required",
			company:"required",


		},
		messages:{
			name:"Please enter store's  name",
			address:"Please enter store's  address",
			latitude:"Please enter store's latitude",
			longitude:"Please enter store's longitude",
			street:"Please enter store's street",
			city:"Please enter store's city",
			state:"Please enter store's state",
			zip_code:"Please enter store's zip code",
			county:"Please enter store's county",
			country:"Please enter store's country",
			phone:{
				required:"Please enter store's phone number",
				number:"Please enter store's valid number"
			},
			url:"Please enter store's url",
			company:"Please select company"

			
		},
		submitHandler:function(form){

			var url= "{{route('store.store')}}";
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
					window.location = "{{ route('store.display') }}";
				}

			})
		}
	});
//map script


	});
</script>

@endsection