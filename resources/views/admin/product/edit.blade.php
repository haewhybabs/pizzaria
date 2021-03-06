
@extends('layouts.admin.app')
@section('content')
<style type="text/css">
  .errMsg{
    color:red;
  }
</style>
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
        <form class="form-horizontal form-label-left" novalidate id="editForm" method="post" >
        @csrf
        <div hidden="true">
          <input type="text" name="id" value="{{ $product->id }}">
        </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="name" class="form-control col-md-7 col-xs-12"  name="name" placeholder="Name" value="{{ $product->name}}" >
            </div>
          </div>
          <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Company  <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <select name="company" id="company" class="form-control col-md-7 col-xs-12">
               		<option value="">Select company</option>
                  @foreach($company as $com)
                    <option value="{{ $com->id }}" @if($com->id == $product->companyID) selected @endif >{{ $com->name }}</option>
                  @endforeach
               </select>
              </div>
          </div>
          <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Store  <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <select class="form-control col-md-7 col-xs-12" name="store" id="store">
               		<option value="">Select company first</option>
                  @foreach($stores as $st)
                  <option value="{{ $st->id }}" @if($st->id == $product->storeID) selected @endif >{{ $st->name }}</option>
                  @endforeach
               </select>
              </div>
          </div>   
          <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Pizza type  <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <select class="form-control col-md-7 col-xs-12" name="type" id="type">
               		<option value="">Select type</option>
                  @foreach($type as $row)
                    <option value="{{ $row->id }}" @if($row->id == $product->type) selected @endif>{{ $row->category }}</option>
                  @endforeach
               </select>
              </div>
          </div>  
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"> Pizza size </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
               <select class="form-control col-md-7 col-xs-12" name="size" id="size">
                    <option value="">Select size</option>
                    <option value="0" @if($product->size == 0) selected @endif>Small</option>
                    <option value="1" @if($product->size == 1) selected @endif>Medium</option>
                    <option value="2" @if($product->size == 2) selected @endif>Large</option>
                    <option value="3" @if($product->size == 3) selected @endif>Extra large</option>
               </select>
              </div>
          </div>           
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Price <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  class="form-control col-md-7 col-xs-12"  name="price" placeholder="Price" value="{{ $product->price}}">
            </div>
          </div>    
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Topping <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  class="form-control col-md-7 col-xs-12"  name="topping" placeholder="Topping" value="{{ $product->topping}}">
            </div>
          </div> 
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Start time <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12" >
              <div class="input-group date" id="starttime">
                <input type="text" class="endtime form-control" name="starttime" id="start_date">
                <span class="input-group-addon" style="">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">End time <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12" >
              <div class="input-group date" id="endtime">
                <input type="text" class="endtime form-control" name="endtime" id="end_date">
                <span class="input-group-addon" style="">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
              <span class="errMsg" id="dateErr" hidden="">End date should be greater than start date</span>
            </div>
          </div>               
          <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Pizza Image<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <input type="file" name="limg" id="limg" class="form-control col-md-7 col-xs-12 dropify" data-default-file="{{ asset('pizzaImage/'.$product->pizzaImage) }}" data-allowed-file-extensions="png jpeg jpg">
              </div>
          </div>
          <!-- <div class="item form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12">
              Your image
              </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                 <img src="{{ asset('pizzaImage/'.$product->pizzaImage) }}" id="resultImg"  width="50%" >
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
  <script type="text/javascript" src="{{ asset('adminAssets/js/select2.js')}}"></script>
    <script src="{{asset('adminAssets/js/moment.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('adminAssets/js/bootstrap-datetimepicker.min.js')}}"></script>

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

      var startdate = "{{ $product->start_time }};";
      var enddate =  "{{ $product->end_time }}";
      var today = new Date();
      today.setDate(today.getDate()-1);
      if(startdate == null || startdate == '')
      {
        startdate = new Date();
      }
      if(enddate == null || enddate == '')
      {
          enddate = new Date();
          enddate.setDate(startdate.getDate() + 30);
      }
      //alert(date);
      $('#starttime').datetimepicker({
        defaultDate: startdate,
        format: 'L',
        minDate:today,
      });

      $('#endtime').datetimepicker({
        defaultDate: enddate,
        format: 'L',
        minDate:today
      });
      $('#company').select2({width: 'resolve'});
       $('#store').select2({width: 'resolve'});
        $('#type').select2({width: 'resolve'});

      $('#company').on('select2:select',function(){
        var com = $('#company option:selected').val();
        if(com!="")
        {
           $.ajax({
              url:"{{ route('product.getStore') }}",
              data:{
                 "_token": "{{ csrf_token() }}",
                 "company":com,
              },
              type:"POST",
              cache:false,
              dataType:"json",
              success:function(data){
                var st = $('#store');
                st.empty();
                for(var i=0;i<data.length;i++)
                {
                  st.append($('<option/>',{
                    value:data[i].id,
                    text:data[i].name
                  }));
                }
              }
           });
        }
        else
        {
          $('#store').empty();
            $('#store').append($('<option/>',{
                value:"",
                text:"Select company first"

            }));
        }

      });

    //    $('#limg').change(function(){

    //     var ext  = $('#limg').val().split('.').pop().toLowerCase();
        
    //     if($.inArray(ext,['jpg','jpeg','png']) == -1)
    //     {
         
    //     }
    //     else
    //     {
    //         imgRender(this);
    //     }
    // });

    $('#editForm').validate({
      errorClass:"errMsg",
      rules:{
        name:"required",
        company:"required",
        store:"required",
        type:"required",
        price:{
          required:true,
          number:true
        },
        size:"required",
        topping:"required",
        limg:{
          extension:'jpg|jpeg|png',
        },

      },
      messages:{
        name:"Please enter name",
        company:"Please select company",
        store:"Please select store",
        type:"Please select type",
        price:{
          required:"Please enter prize",
          number:"Please enter valid price",
        },
        size:"Please select pizza size",
        topping:"Please enter topping",
        limg:{
          
          extension:"Image should be in format of JPG JPEG or PNG",
        },
      },
      submitHandler:function(form)
      {
         if( Date.parse($('#end_date').val()) < Date.parse($('#start_date').val()) )
          {
            $('#dateErr').show();
            return false;
          }
       
          $.ajax({
            url:"{{ route('product.update') }}",
            type:"post",
            data:new FormData(form),
            processData:false,
            cache:false,
            contentType:false,
            success:function(data){
             
              //console.log(data);
              $('#editForm')[0].reset();
              if(data.success==1)
              {
                window.location = "{{ route('product.display')}}?msg=2";
              }
              
            }

         });
      }

    });       

    });
//end of document.ready
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