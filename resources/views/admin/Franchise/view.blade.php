@extends('layouts.admin.app')
@section('content')
	<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
         <h3>Franchise Page</h3>
      </div>
     
     
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Franchies display</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table  class="table table-striped table-bordered" cellpadding="0">
              <tr>
              	<td colspan="2" align="center"><img src="{{ asset('adminAssets/franchiseLogo/'.$com->logo)}}" alt="company logo" style="width: 150px;height: 150px"></td>
              </tr>
              <tr>
              	<th>Name</th>
              	<td>{{ $com->name }}</td>
              </tr>
				<tr>
              	<th>description</th>
              	<td>{{ $com->description }}</td>
              </tr>
           </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection