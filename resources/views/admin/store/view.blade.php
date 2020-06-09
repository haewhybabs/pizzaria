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
            <h2>Store display</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table  class="table table-striped table-bordered" cellpadding="0">
              <tr>
              	<th>Name</th>
              	<td>{{ $store->name }}</td>
              </tr>
              <tr>
                  <th>Added by</th>
                  <td>@if($store->owner) {{ $store->owner->email }} @else admin @endif</td>
              </tr>
              <tr>
                <th>latitude</th>
                <td>{{ $store->latitude }}</td>
              </tr>
               <tr>
                <th>longitude</th>
                <td>{{ $store->longitude }}</td>
              </tr>
              <tr>
                <th>address</th>
                <td>{{ $store->address }}</td>
              </tr>
              <tr>
                <th>street</th>
                <td>{{ $store->street }}</td>
              </tr>
               <tr>
                <th>city  </th>
                <td>{{ $store->city }}</td>
              </tr>
              <tr>
                <th>state</th>
                <td>{{ $store->state }}</td>
              </tr>
              <tr>
                <th>country</th>
                <td>{{ $store->country }}</td>
              </tr>              
              <tr>
                <th>zip code</th>
                <td>{{ $store->zip_code }}</td>
              </tr>
               <tr>
                <th>county</th>
                <td>{{ $store->county }}</td>
              </tr>
              <tr>
                <th>phone</th>
                <td>{{ $store->phone }}</td>
              </tr>
              <tr>
                <th>url</th>
                <td>{{ $store->url }}</td>
              </tr>
              <tr>
                <th>company</th>
                <td>{{ $store->company->name }}</td>
              </tr>
              <tr>
                <th>Timming</th>
                <td>
                    <table class="table table-striped table-bordered">
                        @foreach($time as $key =>$day)
                        <?php $t=0;?>
                          <tr>
                              <th>{{ $key }}</th>
                              @foreach($day as $key=>$value)
                              @if(count($value)!=0)
                                  @while($t!=count($value)) 
                                  <?php $start = $day->start[$t]; 
                                      $end =  $day->end[$t];
                                       $t++; 
                                      ?>
                                  <td>{{ $start}} to {{ $end }}</td> 
                                  @endwhile
                               @else
                               <td>Closed</td>  
                               @break 
                              @endif
                                
                              @endforeach
                          </tr>
                        @endforeach
                        <!-- <tr>
                            <th>monday</th>
                            <td>9:00 to 6:00</td>
                        <tr>
                        <tr>
                            <th>monday</th>
                            <td>9:00 to 6:00</td>
                        <tr>     -->                                              
                    </table>
              </td>
              </tr>                                          				      
           </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection