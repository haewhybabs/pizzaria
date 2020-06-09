
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
        <form class="form-horizontal form-label-left" novalidate id="editForm" method="post" >
        @csrf
        <div hidden="true">
          <input type="text" name="id" value="{{ $cate->id }}">
        </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="name" class="form-control col-md-7 col-xs-12"  name="name" placeholder="Enter Name Here" value="{{ $cate->category }}">
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
 <script src="{{ asset('adminAssets/js/switchery.min.js') }}"></script>

<script type="text/javascript">
$(document).ready(function(){

      $('#editForm').validate({
         errorClass:"errMsg",
          rules:{
            name:"required"
          },
          messages:{
            name:"Please enter name"
          },
          submitHandler:function(form){
           
             $.ajax({
              url:"{{route('category.update')}}",
              data:new FormData(form),
              type:"post",
              cache:false,
              processData:false,
              contentType:false,
              success:function(data){
                console.log(data);
                $('#editForm')[0].reset();
                window.location = "{{ route('category.display') }}?msg=2";
              }

            });

          }

      });

});

		
</script>
@endsection