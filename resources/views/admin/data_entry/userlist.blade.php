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
      {
        if($_GET['msg'] == 1)
          {?>
           <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
              <div class="input-group">
                <p class="alert alert-success">
                  User has been deleted
                </p> 
              </div>
            </div>
          </div>
          <?php
        }
        else
          {?>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <p class="alert alert-success">
                    User's status has been changed
                  </p> 
                </div>
              </div>
            </div>
            <?php
          }
        }
        ?>


      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>site Users</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
             <table id="dstable" class="table table-striped table-bordered" cellpadding="0">
             	<thead>
             		<tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>country</th>
                  <th>Active/Inactive</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
               @foreach($user as $row)
               <tr>
                 <td>{{$row->name}}</td>
                 <td>{{$row->email}}</td>
                 <td>{{$row->country}}</td>
                 <td>
                  @if($row->isActive == 1) <?php $check="checked" ?> @else <?php $check="" ?> @endif
                  <input type="checkbox" class="js-switch"  {{ $check }} data-id="{{$row->id}}">
                </td>
                <td class="btnrow">
                 <a href="javascript:void(0)" class="btn-delete label label-danger deleteUser" data-url="userdelete/{{ $row->id }}"><i class="fa fa-trash"></i></a></td>
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
@include('sweet::alert')
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

    $(document).on('change','.js-switch',function(e){
     var id = $(this).data('id');
     var check  = this.checked ? this.value : 'off';
     if($(this).is(':checked'))
     {
       text1 = "Once you change the status,user can login";

     }
     else
     {
              //gonna in_active
              text1 = "Once you change the stattus,user can not login";
            }
            Swal.fire({
              title: "Are you sure?",
              text: text1,
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes'
            }).then((willdelete.value)=>{
              if(willdelete){
                $.ajax({
                  url:"{{ route('user.changestatus')}}",
                  type:"POST",
                  data:{
                    "_token": "{{ csrf_token() }}",
                    "checkbox":check,
                    "id":id,
                  },
                  success:function(data)
                  {

                  }
                })
              }
              else
              {
                window.location  = "{{ route('admin.user') }}";
              }
            })

          });

    $(document).on('click','.deleteUser',function(){
      var urlDelete = $(this).data('url');
      Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this user!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((willdelete)=>{
        if(willdelete.value){
          $.ajax({
            url:urlDelete,
            type:"get",
            success:function(data)
            {
              window.location  = "{{ route('admin.user') }}?msg=1";
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