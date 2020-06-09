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
            <h2>Import Store</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal form-label-left "  id="addForm" method="post" action="{{route('store.importdata')}}" enctype="multipart/form-data">
              @csrf
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="xfile">
                  Import file <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" class="form-control col-md-7 col-xs-12 dropify"  name="xfile" id="xfile"   data-allowed-file-extensions="xlsx csv">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <button id="send" type="submit" class="btn btn-success">Upload</button>
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
        'error' : {
          'fileExtensions':"Please select excel file",
        },
      }
    });
  });
  $(document).ready(function(){
    $('#addForm').validate({
      errorClass:"errMsg",
      rules:{
        xfile:{
          required:true,
          extension:'xls|csv|xlsx'
        }
      },
      messages:{
        xfile:{
          required:"Please select excel file",
          extension:"Please select excel file",
        }
      },
      submitHandler:function(form)
      {
        form.submit();
      }
    });
  });
</script>
@endsection