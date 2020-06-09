
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea class="form-control" rows="3" name="description" placeholder="description"></textarea>
              </div>
          </div>
          <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12"> Upload  Logo<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12 imgclass">
               <input type="file" name="limg" id="limg" class="form-control col-md-7 col-xs-12 dropify " data-allowed-file-extensions="png jpeg jpg">
              </div>
              <div class="col-md-8 col-sm-6 col-xs-12" id="errordiv" align="center" >
                
              </div>
              
          </div>

         <!--  <div class="item form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12">
              </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                 <img src="" id="resultImg"  width="50%" >
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
    $('#resultImg').hide();

    $('#addForm').validate({
      errorClass:"errMsg",
      errorPlacement: function(error, element) {
          if(element.attr('name') == "limg")
          {
           
              //error.appendTo('#errordiv');
              error.insertAfter('.dropify-wrapper');
              
              
          }
          else
          {
            error.insertAfter(element);
          }
      },
      rules:{
          name:{
            required:true,
            remote:{
              url:"{{ route('franchies.checkName') }}",
              type:"post",
              data:{
                    "_token": "{{ csrf_token() }}",
                    name:function(){
                      return $('#addForm :input[name="name"]').val();
                        }
            },
          },
      },
      description:"required",
      limg:{
        required:true,
        extension:'jpg|jpeg|png',
      }
    },
    messages:{
      name:{
        required:"Please enter name",
        remote:"Enter unique name",
      },
      description:"Please Enter Description",
      limg:{
        required:"Please select logo",
        extension:"File should be in JPEG JPG OR PNG format",
      }
    },
    submitHandler:function(form){
      
      $.ajax({
          url:"{{ route('franchies.store') }}",
          type:"post",
          data:new FormData(form),
          processData:false,
          cache:false,
          contentType:false,
          success:function(data){
           
            console.log(data);
            if(data.success == 1)
            {
                window.location = "{{route('franchies.display')}}?msg=1";
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