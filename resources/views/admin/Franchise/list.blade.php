
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
        <h3>Franchise Page</h3>
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
                     Company's record has been added
                   </p> 
                   <?php     
                 }
                 elseif($_GET['msg'] == "2")
                  {?>
                    <p class="alert alert-success">
                     Company's record has been updated
                   </p>
                   <?php      
                 }
                 elseif($_GET['msg'] == "3")
                  {?>
                    <p class="alert alert-success">
                     Company's record has been deleted
                   </p>
                   <?php 
                 }
                 elseif($_GET['msg'] == "4")
                  {?>
                    <p class="alert alert-success">
                     Company and its belonging store's status is changed.
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
       </div>

       <div class="clearfix"></div>

       <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Franchies display</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li class="dropdown">
                  <a href="{{route('franchies.add')}}" class="label label-primary" style="color:white"><i class="fa fa-plus"></i>  Add  Company</a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table id="dstable" class="table table-striped table-bordered" cellpadding="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($franchise as $row)
                 <tr>
                  <td>{{ $row->name }}</td>
                  <td>{{ $row->description }}</td>
                  <td>
                    @if($row->is_active == 1) <?php $check="checked" ?> @else <?php $check="" ?> @endif
                    <input type="checkbox" class="js-switch"  {{ $check }} data-id="{{$row->id}}">
                  </td>
                  <td class="btnrow">
                    <a href="Franchies/edit/{{$row->id}}" class="btn-edit label label-info" data-toggle="tooltip" title="edit"><i class="fa fa-edit"></i></a>
                    <a  data-url="Franchies/delete/{{$row->id}}" href="javascript:void(0)" class="btn-delete label label-danger deleteCom" data-toggle="tooltip" title="delete"><i class="fa fa-trash"></i></a>
                    <a href="Franchies/view/{{$row->id}}" class="btn-edit label label-success " data-toggle="tooltip" title="view"><i class="fa fa-eye"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
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
<script src="{{ asset('adminAssets/js/switchery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('adminAssets/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var table = $('#dstable').DataTable({

     drawCallback:function(settings)
     {
        //console.log(settings);
        var api = new $.fn.dataTable.Api( settings );
        var a = Array.prototype.slice.call(document.querySelectorAll(".js-switch",api.rows().nodes()));

        a.forEach(function(a) {
          if(!a.getAttribute('data-switchery'))
          {
            new Switchery(a,{
              color: "#26B99A",
              size:'small',
            })
          }

        })
      },
    });
    
    $('[data-toggle="tooltip"]').tooltip();
    $(document).on('click','.deleteCom',function(){
      var urlDelete = $(this).data('url');
      Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this company!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((willdelete)=>{
        if(willdelete.value){
          $.ajax({
            url:urlDelete,
            type:"get",
            success:function(data)
            {
              window.location  = "{{ route('franchies.display') }}?msg=3";
            }
          });
        }
        else
        {
          return false;
        }
      })
    });

    //change status
    $(document).on('change','.js-switch',function(){
      var text1 = '';
      var task ='';
      if($(this).is(':checked'))
      {
       text1 = "Once you change the status,all store belongs to this company also gets active!";
       task = "active";
     }
     else
     {
        //gonna in_active
        text1 = "Once you change the stattus,all store belongs to this company also gets inactive";
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
        confirmButtonText: 'Yes, delete it!'
      }).then((willdelete)=>{
        if(willdelete.value){

          $.ajax({
            url:"{{ route('franchies.changeStauts') }}",
            type:"post",
            data:{
              "_token": "{{ csrf_token() }}",
              "id":id,
              "task":task
            },
            success:function(data)
            {
              console.log(data);
              window.location  = "{{ route('franchies.display') }}?msg=4";
            }
          });
        }
        else
        {
          window.location  = "{{ route('franchies.display') }}";
        }
      })
    });


  })
</script>
@endsection