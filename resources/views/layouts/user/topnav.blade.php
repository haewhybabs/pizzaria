<header class="stick">
  <div class="logo-menu-sec">
    <div class="row custom-row">
      <div class="navbar navbar-default navbar-fixed-top">
       <div class="rem-logo navbar-header">
        <h3><a class="navbar-brand" title="Home" itemprop="url" href="{{ route('home') }}">PizzaPizzaria</a></h3>
        <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
      </div>
      <div class="navbar-collapse collapse rem-menu-sec">
        <ul class="nav navbar-nav">
          <li class="menu-item-has-children">
            <a href="{{ route('home') }}" title="HOME" itemprop="url">HOME</a>
          </li>
          <li class="menu-item-has-children">
            <a href="{{ route('home.store') }}" title="STORE" itemprop="url">STORES</a>
          </li>
          <li class="menu-item-has-children">
            <a href="/contactus" title="CONTACT US" itemprop="url">CONTACT US</a>
          </li>
          <li>
            @if(!Auth::user())
            <a href="{{ url('/order-without-login') }}" title="Order Without Login" class="order-without-login">ORDER WITHOUT LOGIN</a>
            @else
            <a href="{{ url('/order-now') }}" title="Order Now" class="order-without-login">ORDER NOW</a>
            @endif
          </li>
          <li class="move-right">
            @if(!Auth::user())
            <div>
              <a  href="{{ route('login') }}" title="Login" class="logintext">LOGIN</a> / 
              <a  href="{{ route('register') }}" title="Register" class="logintext">REGISTER</a>
            </div>
            @else
            <div class="login-register text-right {{(!Auth::user())?'ct-pd':''}}">
              <div class="text-right dropdown user">
                <div class="dropdown-toggle" data-toggle="dropdown">
                  <img class="top-profile"
                  @if(isset($user->imgname))
                  src="{{asset('userAssets/userImage/'.$user->imgname)}}"
                  @else
                  src="{{asset('userAssets/userImage/user.png')}}"
                  @endif
                  >
                  <span class="caret"></span>
                </div>
                <ul class="dropdown-menu custom-dropdown-menu">
                  <li><a href="{{ route('logout') }}"  onclick="event.preventDefault(); localStorage.clear();document.getElementById('logout-form').submit();" class="logintext">LOGOUT</a></li>
                  <li><a  href="{{ route('myaccount') }}" title="Login" class="logintext">MY ACCOUNT</a></li>
                </ul>
              </div>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
            @endif
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
</header><br>