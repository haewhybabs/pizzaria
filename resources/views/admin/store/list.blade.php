@extends('layouts.admin.app')
@section('content')
<style type="text/css">
  .btn-edit{
    padding:10px 10px;
    margin-left: 10px;
  }
  .btn-delete{
    padding:10px 10px;
    margin-left: 10px;
  }
  .btnrow{
    padding-top: 14px!important;
    padding-bottom: 14px!important;
  }
</style>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Store Page</h3>
      </div>
      <?php
        if(isset($_GET['msg']))
        {?>
          <div class="title_right">
          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
          <?php
        if($_GET['msg'] == "1")
        {?>
            <p class="alert alert-success">
               Store's record is added
             </p>
        <?php
        }
        elseif($_GET['msg'] == "2")
        {?>
           <p class="alert alert-success">
              Store's  record is Deleted
             </p>
         <?php
        }
        elseif($_GET['msg'] == "3")
        {?>
           <p class="alert alert-success">
             Store's record is updated
             </p>
         <?php
        }
        else
        {?>
           <p class="alert alert-success">
             Store's status is updated
             </p>
         <?php
        }
        ?>
          </div>
          </div>
          </div>
    <?php
      }
      ?>
  @if(session('status'))
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
              <p class="alert alert-success">
                 {{ @session('status') }}
               </p>
            </div>
        </div>
    </div>
    @endif
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Store display</h2>
              <ul class="nav navbar-right panel_toolbox">
              <li class="dropdown">
                <a href="{{route('store.add')}}" class="label label-primary" style="color:white"><i class="fa fa-plus"></i> Add  Store</a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="dstable" class="table table-striped table-bordered" cellpadding="0">
              <thead>
                <tr>
                  <th>id</th>
                  <th>Name</th>
                  <th>Company</th>
                  <th>Address</th>
                  <th>URL</th>
                  <th>country</th>
                  <th>contact</th>
                  <th>Added by</th>
                  <th>Action</th>
                  <th>Status</th>
                </tr>
              </thead>
             <!--  -->
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
 <script type="text/javascript" src="{{ asset('adminAssets/js/jquery.dataTables.js')}}"></script>
 <script type="text/javascript" src="{{ asset('adminAssets/js/dataTables.fixedHeader.min.js')}}"></script>

 <script type="text/javascript" src="{{ asset('adminAssets/js/dataTables.bootstrap.js')}}"></script>
 <script src="{{ asset('adminAssets/js/switchery.min.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function(){

    var table = $('#dstable').DataTable({
      "responsive": true,
      "processing": true,
      "serverSide": true,
      "columnDefs": [
      { "width": "15%", "targets": 8 }
      ],
      "order": [[ 0, "desc" ]],
      bSort: false,
      "ajax":{
        "url":"{{ route('store.getData') }}",
        "dataType":"json",
        "type":"post",
        "data":{
          "_token": "{{ csrf_token() }}",
        }
      },
      "columns":[
      { "data" :"id" },
      { "data" :"name" },
      { "data" :"Company" },
      { "data" :"Address" },
      { "data" :"url" },
      { "data" :"country" },
      { "data" :"contact"},
      { "data" :"Added by" },
      { "data" :"Action" },
      { "data" :"status" },
      ],
      drawCallback:function(settings)
      {
        var api = new $.fn.dataTable.Api( settings );
        var a = Array.prototype.slice.call(document.querySelectorAll(".js-switch",api.rows().nodes()));
        a.forEach(function(a) {
          new Switchery(a,{
            color: "#26B99A",
            size:'small',
          })
        })
      },
    });

    // $(document).on('click','.paginate_button',function(){

    //   var a = Array.prototype.slice.call(document.querySelectorAll(".js-switch"));
    //   //console.log(a);
    //     a.forEach(function(a) {

    //         new Switchery(a,{
    //             color: "#26B99A",
    //              size:'small',
    //         })
    //      })
    //   });

    $(document).on('click','.deleteStore',function(){
      var url = $(this).data('url');
      Swal.fire({
        title: "Are you sure?",
        text: "Once you delete ,you will not be able to recover this store!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((willdelete)=>{
        if(willdelete.value){

          $.ajax({
            url:url,
            type:"get",
            success:function(data)
            {
              console.log(data);
              window.location  = "{{ route('store.display') }}?msg=2";
            }
          });
        }
      })
    });

    $(document).on('change','.js-switch',function(){
      var text1 = '';
      var task ='';
      if($(this).is(':checked'))
      {
        text1 = "Once you change the status,store  gets active!";
        task = "active";
      }
      else
      {
        //gonna in_active
        text1 = "Once you change the stattus, store inactive";
        task = "inactive";
      }

      var id = $(this).data('id');
      Swal.fire({
        title: "Are you sure?",
        text: text1,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
      }).then((willdelete)=>{
        if(willdelete.value){
          $.ajax({
            url:"{{ route('store.changeStauts') }}",
            type:"post",
            data:{
              "_token": "{{ csrf_token() }}",
              "id":id,
              "task":task
            },
            success:function(data)
            {
              console.log(data);
              window.location  = "{{ route('store.display') }}?msg=4";
            }
          });
        }
        else
        {
          window.location  = "{{ route('store.display') }}";
        }
      })
    });
  })
</script>
@endsection