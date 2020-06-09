
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
          <?php $cnt=1; ?>
           @foreach($time as $key=>$day)
           <?php $t=0; ?>
          <div class="item   form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">{{ $key }}  
	            </label>
	            <div class="col-sm-1">
	            	<label>
	            		 <input type="checkbox" class="js-switch" @if($day->start!=null) checked="true" @endif data-id="t{{ $cnt }}">
	            	</label>
	            </div>
	            <div id="t{{ $cnt }}">
	            	@foreach($day as $key=>$value)
	            	 @if(count($value)!=0)
	            	 	@if($day->start == null)
	            	 		<?php $disable = "disabled"?>
	            	 	@else
	            	 		<?php $disable = ""?>
	            	 	@endif
							@while($t!=count($value))
         						<?php $start = $day->start[$t]; 
         						   	  $end =  $day->end[$t];
         						 	$t++; 
         						 ?>
         					<div class="row">
         						@if($t!=1)
         							<div class="col-md-4"></div>
         						@endif		
				            	<div class="col-sm-2">
						            <div class="input-group date" >
				                        <input type="text" class="t{{ $cnt }} start form-control" name="t{{ $cnt }}start[]" value="{{ $start }}" >
				                        <span class="input-group-addon" style="">
				                           <span class="glyphicon glyphicon-calendar"></span>
				                        </span>
					                </div>
				            	</div>
				            	<div class="col-sm-2">
					               	<div class="input-group date" >
				                        <input type="text" class="t{{ $cnt }}  end form-control" name="t{{ $cnt }}end[]" value="{{ $end }}" >
				                        <span class="input-group-addon" style="">
				                           <span class="glyphicon glyphicon-calendar"></span>
				                        </span>
					                </div>
				            	</div>
				            	@if($t!=1)
         							<div class="col-sm-1">
			            				<button class="delHours btn btn-danger"  data-id="t{{ $cnt }}"><i class="fa fa-minus"></i></button>
			           				</div>
         						@else
         						<div class="col-sm-1">
			            			<button class="addHours btn btn-success"  data-id="t{{ $cnt }}"><i class="fa fa-plus"></i></button>
			           			</div>
         						@endif
				            	

		            		</div>
         					@endwhile
         				@else
         				<?php 
	            	 			$start = "0:00am"; $end = "0:00am"; $disable="disabled"; 
	            	 	?>
         				<div class="row">
			            	<div class="col-sm-2">
					            <div class="input-group date" >
			                        <input type="text" class="t1 start form-control" name="t{{ $cnt }}start[]"   {{ $disable }}>
			                        <span class="input-group-addon" style="">
			                           <span class="glyphicon glyphicon-calendar"></span>
			                        </span>
				                </div>
			            	</div>         					
			            	<div class="col-sm-2">
				               	<div class="input-group date" >
			                        <input type="text" class="t1  end form-control" name="t{{ $cnt }}end[]"  {{ $disable }}>
			                        <span class="input-group-addon" style="">
			                           <span class="glyphicon glyphicon-calendar"></span>
			                        </span>
				                </div>
		            		</div>
			            	<div class="col-sm-1">
		            			<button class="addHours btn btn-success"  data-id="t1"><i class="fa fa-plus"></i></button>
		           			</div>
         				</div>	
         				@break
	            	 @endif

					@endforeach 
				</div>
	        
		
          <?php $cnt++;  ?>
      </div>
           @endforeach
        
          <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Store's Image <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="file" id="simg" class="form-control col-md-7 col-xs-12"  name="simg"  >
	            </div>
          </div>
          <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Store's location <span class="required">*</span>
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input type="text"  class="form-control col-md-7 col-xs-12"    >
	            </div>
          </div>
          <div class="item form-group">
          	<label class="control-label col-md-3 col-sm-3 col-xs-12">
          		your Image
          	</label>
          	<div class="col-md-6 col-sm-6 col-xs-12">
          		<img src="{{asset('adminAssets/storeimg/'.$store->imgname)}}" width="50%">
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

		
		var max = [];
		max['t1']=0;
		max['t2']=0;
		max['t3']=0;
		max['t4']=0;
		max['t5']=0;
		max['t6']=0;
		max['t7']=0;
		
		//$('.start').val('09:00 AM');
		//$('.end').val('06:00 PM');

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
    		txthtml+= '<button class="delHours btn btn-danger"  data-id="'+id+'"><i class="fa fa-minus"></i></button>';
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
				required:"Please select image",
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
					window.location = "{{ route('store.display') }}";
				}

			})
		}
	});
//map script


	});
</script>

@endsection