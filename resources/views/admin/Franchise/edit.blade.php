
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
        <div hidden="true">
           <input id="id" class="form-control col-md-7 col-xs-12"  name="id"  value="{{$row->id}}">
        </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="name" class="form-control col-md-7 col-xs-12"  name="name" placeholder="Enter Name Here" value="{{$row->name}}">
            </div>
          </div>
          <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea class="form-control" rows="3" name="description" placeholder="Enter your Address">{{ $row->description }}</textarea>
              </div>
          </div>
          <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12"> Upload  Logo<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <input type="file" name="limg" id="limg" class="form-control col-md-7 col-xs-12 dropify" data-default-file="{{ asset('adminAssets/franchiseLogo/'.$row->logo)}}" data-allowed-file-extensions="png jpeg jpg">
              </div>
          </div>
         <!--  <div class="item form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12">
              </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                 <img src="{{ asset('adminAssets/franchiseLogo/'.$row->logo)}}" id="resultImg"  width="50%" >
           </div>
          </div> -->
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
    $(window).on('load',function(){
      $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove':  'Remove',
            'error' :'Please select image  file with JPEG JPG OR PNG format',
        }
    });
  })
  </script>

<script type="text/javascript">
 





	$(document).ready(function(){
    

    $('#addForm').validate({
      errorClass:"errMsg",
      rules:{
          name:{
            required:true,
      },
      description:"required",
      limg:{
       
        extension:'jpg|jpeg|png',
      }
    },
    messages:{
      name:{
        required:"Please enter name",
        
      },
      description:"Please Enter Description",
      limg:{
        
        extension:"File should be in JPEG JPG OR PNG format",
      }
    },
    submitHandler:function(form){
      
      $.ajax({
          url:"{{ route('franchies.update') }}",
          type:"post",
          data:new FormData(form),
          processData:false,
          cache:false,
          contentType:false,
          success:function(data){
           
            console.log(data);
           if(data.success == 1)
            {
                window.location = "{{route('franchies.display')}}?msg=2";
            } 
          }

      });



    }


    });


    $('#limg').change(function(){

        var ext  = $('#limg').val().split('.').pop().toLowerCase();
        
        if($.inArray(ext,['jpg','jpeg','png']) == -1)
        {
         
        }
        else
        {
            imgRender(this);
        }
    });
  
});
function imgRender(url)
{
    $('#resultImg').show();

    if(url.files && url.files[0])
    {
      var reader = new FileReader();
      reader.onload = function(e){
        $('#resultImg').attr('src',e.target.result);
      }
        reader.readAsDataURL(url.files[0]);
    }
}		
</script>
@endsection