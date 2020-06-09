
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
        <h3>Users Page</h3>
      </div>


      <?php
      if(isset($_GET['msg']))
        {?>
         <div class="title_right">
          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
              <?php
              if($_GET['msg'] == 1)
                {?>
                  <p class="alert alert-success">
                   User has been updated
                 </p> 

                 <?php
               }
               elseif($_GET['msg'] == 2)
                {?>
                 <p class="alert alert-success">
                   User has been added
                 </p>
                 <?php  
               }
               else
                {?>
                  <p class="alert alert-success">
                   User has been deleted
                 </p>
                 <?php
               }?>
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
            <h2>Administrative Users</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li class="dropdown">
                <a href="{{ route('admin.dataentry.add')}}" class="label label-primary" style="color:white"><i class="fa fa-plus"></i>  Add  User</a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
           <table id="dstable" class="table table-striped table-bordered" cellpadding="0">
            <thead>
             <tr>
              <th>Name</th>
              <th>Email</th>
              <th>role</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
           @foreach($duser as $user)
           <tr>
             <td>{{$user->name}}</td>
             <td>{{$user->email}}</td>
             <td>@if($user->role == 0)Super Admin @elseif($user->role == 1) admin @else Data Entry User @endif</td>
             @if($user->role!=0)
             <td class="btnrow"><a href="dataentry/edit/{{$user->id}}" class="btn-edit label label-info"><i class="fa fa-edit"></i></a>
               <a href="javascript:void(0)" data-url="dataentry/delete/{{$user->id}}" class="btn-delete label label-danger deleteUser"><i class="fa fa-trash"></i></a></td>
               @else
               <td></td>
               @endif
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

<script type="text/javascript" src="{{ asset('adminAssets/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var table = $('#dstable').DataTable();
    $(document).on('click','.deleteUser',function(){
      var  urlDelete = $(this).data('url');
      Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this user!",
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
              window.location  = "{{ route('admin.dataentry') }}?msg=3";
            }
          });
        }
        else
        {
          return false;
        }
      })
    })

  })
</script>
@endsection