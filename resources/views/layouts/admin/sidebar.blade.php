<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="{{ route('admin.dashboard') }}" class="site_title"><i class="fa fa-paw"></i> <span>Pizza pizzaria</span></a>
    </div>

    <div class="clearfix"></div>

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3><a href="{{ route('admin.dashboard') }}" style="color:white">Dashboard</a></h3>
        <ul class="nav side-menu">
          @if(Auth::guard('admin')->user()->role != 2)
          <!-- <li><a href="{{ route('admin.dataentry') }}"><i class="fa fa-home"></i> Users</a>
          </li> -->
          <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{ route('admin.dataentry') }}">Administrative user</a></li>
              <li><a href="{{ route('admin.user')}}">Site user </a></li>

              <!-- <li><a href="index2.html">Dashboard2</a></li>
              <li><a href="index3.html">Dashboard3</a></li> -->
            </ul>
          </li>
          @endif
          <li><a><i class="fa fa-building-o"></i> Pizza Companies  <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{route('franchies.display')}}">Companies </a></li>
              <!-- <li><a href="{{route('franchies.add')}}">Add Company </a></li> -->

              <!-- <li><a href="index2.html">Dashboard2</a></li>
              <li><a href="index3.html">Dashboard3</a></li> -->
            </ul>
          </li>
          <li><a><i class="fa fa-home"></i> Stores <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{route('store.display')}}">Stores</a></li>
              <!-- <li><a href="{{route('store.add')}}">Add store</a></li> -->
              <li><a href="{{route('store.import')}}">Import store</a></li>
              <li><a href="{{route('store.userStore')}}">Store request</a></li>

              <!-- <li><a href="index2.html">Dashboard2</a></li>
              <li><a href="index3.html">Dashboard3</a></li> -->
            </ul>
          </li>
          <li><a><i class="fa fa-home"></i> Pizza  <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{route('category.display')}}">Manage category</a></li>
               <li><a href="{{route('product.display')}}">Manage Pizza</a></li>
              <!-- <li><a href="{{route('store.display')}}">Display Store</a></li> -->
              <!-- <li><a href="index2.html">Dashboard2</a></li>
              <li><a href="index3.html">Dashboard3</a></li> -->
            </ul>
          </li>
          <li>
            <a href="{{ route('messages.get') }}"><i class="fa fa-home"></i>Messages</a>
          </li>

        </ul>
      </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">

    </div>
    <!-- /menu footer buttons -->
  </div>
</div>