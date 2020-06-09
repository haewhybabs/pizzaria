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
              	<td colspan="2" align="center"><img src="{{ asset('pizzaImage/'.$prd->pizzaImage)}}" alt="company logo" style="width: 150px;height: 150px"></td>
              </tr>
              <tr>
              	<th>Name</th>
              	<td>{{ $prd->name }}</td>
              </tr>
              <tr>
                <th>Company</th>
                <td>{{ $prd->company->name }}</td>
              </tr>
              <tr>
                <th>Store</th>
                <td>{{ $prd->store->name }}</td>
              </tr>
              <tr>
                <th>Type</th>
                <td>{{ $prd->category->category }}</td>
              </tr>
              <tr>
                <th>Size</th>
                <td>@if($prd->size == 0)Small @elseif($prd->size == 1) Medium   @elseif($prd->size == 2) Large @else Extra large @endif</td>
              </tr>
              <tr>
                <th>Price</th>
                <td>{{ $prd->price }}</td>
              </tr>
              <tr>
                <th>Start time</th>
                <td>{{ date('d-M-Y',strtotime($prd->start_time)) }}</td>
              </tr>
              <tr>
                <th>End time</th>
                <td>{{ date('d-M-Y',strtotime($prd->end_time)) }}</td>
              </tr>
              <tr>
                <th>topping</th>
                <td>{{ $prd->topping }}</td>
              </tr>
           </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection