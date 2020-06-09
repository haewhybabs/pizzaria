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
        <h3>Messages Page</h3>
      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            @if(Session::has('status'))
            <p class="alert alert-success">{{ Session::get('status') }}</p>
            @endif
            <?php
            if(isset($_GET['msg']))
            {
              if($_GET['msg']==1)
                {?>
                  <p class="alert alert-success">Message has been delete</p>
                  <?php
                }
              }
              ?>
            </div>
          </div>
        </div>



      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Messages display</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table id="dstable" class="table table-striped table-bordered" cellpadding="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($contactMessage as $row)
                  <tr>
                    <td>{{$row->name}}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->subject }}</td>
                    <td class="btnrow">
                     <a data-url="messages/delete/{{$row->id}}" href="javascript:void(0)" data-toggle="tooltip" title="delete" class="btn-delete label label-danger deletecat"><i class="fa fa-trash"></i></a>
                     <a href="messages/view/{{$row->id}}" class="btn-edit label label-success " data-toggle="tooltip" title="view"><i class="fa fa-eye"></i></a>
                   </td>


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
   <script type="text/javascript">
    $(document).ready(function(){

      $(document).on('click','.deletecat',function(){
        var urlDelete = $(this).data('url');
        Swal.fire({
         title: "Are you sure?",
         text: "Once delete it, you can not recover this message!",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!'
       }).then((willdelete)=>{
        if(willdelete.value)
        {
          $.ajax({
            url:urlDelete,
            type:"get",
            success:function(data)
            {
              if(data)
              {
                window.location = "{{ route('messages.get') }}?msg=1";
              }
            }
          })
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