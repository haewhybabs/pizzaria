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
                     Pizza has been added
                   </p> 
                   <?php     
                 }
                 elseif($_GET['msg']=="2")
                  {?>
                    <p class="alert alert-success">
                     Pizza has been Updated
                   </p>
                   <?php      
                 }
                 else
                  {?>
                   <p class="alert alert-success">
                     Pizza has been deleted
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
               Record is Deleted
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
            <h2>Franchies display</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li class="dropdown">
                <a href="{{route('product.add')}}" class="label label-primary" style="color:white"><i class="fa fa-plus"></i>  Add  Product</a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="dstable" class="table table-striped table-bordered" cellpadding="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Company name</th>
                  <th>Store name</th>
                  <th>Type</th>
                  <th>Price</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
               @foreach($product as $row)
               <tr>
                <td>{{ $row->name }}</td>
                <td>{{ $row->company->name }}</td>
                <td>{{ $row->store->name }}</td>
                <td>{{ $row->category->category }}</td>
                <td>{{ $row->price }}</td>
                <td class="btnrow">
                  <a href="product/edit/{{$row->id}}" class="btn-edit label label-info" data-toggle="tooltip" title="edit"><i class="fa fa-edit"></i></a>
                  <a data-url="product/delete/{{$row->id}}" href="javascript:void(0)" class="btn-delete label label-danger deletepizza" data-toggle="tooltip" title="delete"><i class="fa fa-trash"></i></a> 
                  <a href="product/view/{{$row->id}}" class="btn-edit label label-success" data-toggle="tooltip" title="view"><i class="fa fa-eye"></i></a>
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
    $(document).on('click','.deletepizza',function(){
      var urlDelete = $(this).data('url');
      Swal.fire({
        title: "Are you sure?",
        text: "Once delete it, you can not recover this pizza!",
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
              window.location  = "{{ route('product.display') }}?msg=3";
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