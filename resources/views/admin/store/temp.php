  <?php
	echo "<pre>";
//	print_r();
	foreach($time as $key =>$day )
	{
		print_r($key) ."<br> ";
		//$day

		foreach($day as $key=>$value ){
			print_r($value);
		}
	}
	
	die;
?> 
@foreach($row as $r)
					{{$r}}
					<?php die; ?>
					@endforeach

          <div class="item   form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Monday  
	            </label>
	            <div class="col-sm-1">
	            	<label>
	            		 <input type="checkbox" class="js-switch"  data-id="t1" @if($time->monday->start=="") checked="false"  @else checked="true" @endif >
	            	</label>
	            </div>
	        <div id="t1">
	            <?php $cnt=1;?>
	            	@foreach($time->monday->start as $key => $value)
	          		<div class="row">
	          			@if($cnt!=1)
	            		<div class="col-md-4"></div>
	            		@endif
		            	<div class="col-sm-2">
				            <div class="input-group date" >
		                        <input type="text" class="t1 start form-control" name="t1start[]" value="{{$time->monday->start[$key]}}">
		                        <span class="input-group-addon" style="">
		                           <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
			                </div>
		            	</div>
		            	<div class="col-sm-2">
			               	<div class="input-group date" >
		                        <input type="text" class="t1  end form-control" name="t1end[]" value="{{$time->monday->end[$key]}}">
		                        <span class="input-group-addon" style="">
		                           <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
			                </div>
		            	</div>
		            	
	           			@if($cnt!=1)
	           				<div class="col-sm-1">
	           					<button class="delHours btn btn-danger"  data-id="t1"><i class="fa fa-minus"></i></button>
	           				</div>
	           			@else
	           			<div class="col-sm-1">
	            			<button class="addHours btn btn-success"  data-id="t1"><i class="fa fa-plus"></i></button>
	           			</div>
	           			@endif
		            	</div>
		            	<?php $cnt++; ?>
	            	@endforeach
	           		
	       	</div>
          </div>


          @foreach($time as $key=>$day)
          <?php echo $key; ?>
          		<?php
          			if(empty($day->start))
          			{
          				echo $key."empty";
          				break;
          			}
          			else
          			{
          				
          			}
          			
          		?>
				@foreach($day as $key=>$value)
				<?php
						//echo $key;
					/*if(count($day->start)>1)
					{
						//print_r($day->$key);
						echo $day->start[$t];
						echo $day->end[$t];
						$t++;
					}
					else
					{
						echo $day->start[0];
						echo $day->end[0];
					}*/
					
					

				?>		
				@endforeach  
				   
  @foreach($time as $key=>$day)
      			{{ $key }}
         		@continue($day->start == null)	
				@foreach($day as $value)
				<?php
					//echo count($day->start);
				if(count($day->start)==2)
				{
					$t++;
					echo $day->start[$t];
					echo $day->end[$t];
					

				}
				else{

					$t=0;
					echo $value[$t];
					//echo $day->start[$t];
					//echo $day->end[$t];
					
				}	
					//echo $day->start[$t];
					//echo $day->end[$t];
					//echo $value[$t];
					
				
				?>

				@endforeach  
          @endforeach


          //final 
          
          <?php $cnt=1;$t=-1; ?>
          @foreach($time as $key=>$day)
      			{{ $key }}
         		@continue($day->start == null)	
         		@if(count($day->start)==2)
         			
         			@foreach($day as $value)
         				<?php $t++; ?> 
         				{{$day->start[$t]}}
         				{{$day->end[$t]}}
					@endforeach 
					
         		@else
         			<?php $t=0; ?> 
         				{{$day->start[$t]}}
         				{{$day->end[$t]}}
         		@endif

          @endforeach
         <?php die; ?>