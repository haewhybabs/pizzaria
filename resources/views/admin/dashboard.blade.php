@extends('layouts.admin.app')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Dashboard</h3>
      </div>

      <!-- <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div> -->
    </div>

    <div class="clearfix"></div>
      <div class="row tile_count card">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
          <div class="count">{{$user}}</div>
          <!-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-users"></i> Total Stores</span>
          <div class="count">{{$store}}</div>
          <!-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-shopping-cart"></i> Total Franchises</span>
          <div class="count">{{$com}}</div>
         <!--  <span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-rss"></i> Total Pizzas</span>
          <div class="count">{{$pizza}}</div>
          <!-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-users"></i> Total Deals</span>
          <div class="count">0</div>
          <!-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-shopping-cart"></i> Total Coupons</span>
          <div class="count">0</div>
         <!--  <span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
        </div>
      </div>
      <div class="row">
        <!-- <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="x_panel tile fixed_height_320">
            <div class="x_title">
              <h2>App Versions</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                  </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <h4>App Usage across versions</h4>
              <div class="widget_summary">
                <div class="w_left w_25">
                  <span>0.1.5.2</span>
                </div>
                <div class="w_center w_55">
                  <div class="progress">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                      <span class="sr-only">60% Complete</span>
                    </div>
                  </div>
                </div>
                <div class="w_right w_20">
                  <span>123k</span>
                </div>
                <div class="clearfix"></div>
              </div>

              <div class="widget_summary">
                <div class="w_left w_25">
                  <span>0.1.5.3</span>
                </div>
                <div class="w_center w_55">
                  <div class="progress">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                      <span class="sr-only">60% Complete</span>
                    </div>
                  </div>
                </div>
                <div class="w_right w_20">
                  <span>53k</span>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget_summary">
                <div class="w_left w_25">
                  <span>0.1.5.4</span>
                </div>
                <div class="w_center w_55">
                  <div class="progress">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                      <span class="sr-only">60% Complete</span>
                    </div>
                  </div>
                </div>
                <div class="w_right w_20">
                  <span>23k</span>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget_summary">
                <div class="w_left w_25">
                  <span>0.1.5.5</span>
                </div>
                <div class="w_center w_55">
                  <div class="progress">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                      <span class="sr-only">60% Complete</span>
                    </div>
                  </div>
                </div>
                <div class="w_right w_20">
                  <span>3k</span>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget_summary">
                <div class="w_left w_25">
                  <span>0.1.5.6</span>
                </div>
                <div class="w_center w_55">
                  <div class="progress">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                      <span class="sr-only">60% Complete</span>
                    </div>
                  </div>
                </div>
                <div class="w_right w_20">
                  <span>1k</span>
                </div>
                <div class="clearfix"></div>
              </div>

            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="x_panel tile fixed_height_320 overflow_hidden">
            <div class="x_title">
              <h2>Device Usage</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                  </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table class="" style="width:100%">
                <tr>
                  <th style="width:37%;">
                    <p>Top 5</p>
                  </th>
                  <th>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                      <p class="">Device</p>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                      <p class="">Progress</p>
                    </div>
                  </th>
                </tr>
                <tr>
                  <td>
                    <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                  </td>
                  <td>
                    <table class="tile_info">
                      <tr>
                        <td>
                          <p><i class="fa fa-square blue"></i>IOS </p>
                        </td>
                        <td>30%</td>
                      </tr>
                      <tr>
                        <td>
                          <p><i class="fa fa-square green"></i>Android </p>
                        </td>
                        <td>10%</td>
                      </tr>
                      <tr>
                        <td>
                          <p><i class="fa fa-square purple"></i>Blackberry </p>
                        </td>
                        <td>20%</td>
                      </tr>
                      <tr>
                        <td>
                          <p><i class="fa fa-square aero"></i>Symbian </p>
                        </td>
                        <td>15%</td>
                      </tr>
                      <tr>
                        <td>
                          <p><i class="fa fa-square red"></i>Others </p>
                        </td>
                        <td>30%</td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="x_panel tile fixed_height_320">
            <div class="x_title">
              <h2>Quick Settings</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                  </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="dashboard-widget-content">
                <ul class="quick-list">
                  <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
                  </li>
                  <li><i class="fa fa-bars"></i><a href="#">Subscription</a>
                  </li>
                  <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                  <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                  </li>
                  <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                  <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                  </li>
                  <li><i class="fa fa-area-chart"></i><a href="#">Logout</a>
                  </li>
                </ul>

                <div class="sidebar-widget">
                  <h4>Profile Completion</h4>
                  <canvas width="150" height="80" id="chart_gauge_01" class="" style="width: 160px; height: 100px;"></canvas>
                  <div class="goal-wrapper">
                    <span id="gauge-text" class="gauge-value pull-left">0</span>
                    <span class="gauge-value pull-left">%</span>
                    <span id="goal-text" class="goal-value pull-right">100%</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->

      </div>
    </div>
  </div>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('adminAssets/js/Chart.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('adminAssets/js/gauge.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('adminAssets/js/bootstrap-progressbar.min.js')}}"></script>
<script type="text/javascript">
  $('.count').each(function () {
    $(this).prop('Counter',0).animate({
      Counter: $(this).text()
    }, {
      duration: 3000,
      easing: 'swing',
      step: function (now) {
        $(this).text(Math.ceil(now));
      }
    });
  });
</script>
@endsection