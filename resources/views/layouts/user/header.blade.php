<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <title>Pizza Pizzaria </title>
  <link rel="shortcut icon"  href="{{ asset('userAssets/assets/images/favicon.png')}}" type="image/x-icon">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="{{ asset('userAssets/css/icons.min.css')}}">
  <link rel="stylesheet" href="{{ asset('userAssets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('userAssets/css/animate.min.css')}}">
  <link rel="stylesheet" href="{{ asset('userAssets/css/main.css')}}">
  <link rel="stylesheet" href="{{ asset('userAssets/css/red-color.css')}}">
  <link rel="stylesheet" href="{{ asset('userAssets/css/yellow-color.css')}}">
  <link rel="stylesheet" href="{{ asset('userAssets/css/responsive.css')}}">
  <link rel="stylesheet" href="{{ asset('css/sweetalert.css')}}">
  <script src="{{ asset('js/sweetalert.min.js')}}"></script>

  <style type="text/css">
    label.errMsg {
      color:red;
      padding-left: 5%;
    }
    span.errMsg{
      color:red;
    }
    .footericon{
      padding: 7px;
    }
    .login-register{
      float: right;
      font-family: poppins;
      font-size: 16px;
      font-weight: 600;
    }
    .logintext:hover{
      color:#ffbe00;
      outline: none;
      text-decoration: none;
    }
    .order-without-login:hover {
      color:#ffbe00;
      outline: none;
      text-decoration: none;
    }
    .menu-sec{
      float: left;
      width: 80%;
    }
    .logo {
      margin: 2px 0;
    }
    .bodyclass{
      opacity: 0;
    }
    nav > div > ul > li {
      padding: 15px 35px 15px 0;
    }
    .custom-row{
      margin: 10px 5px;
    }
    .o-wo-lg{
      font-size: 16px;
      font-family: poppins;
      font-weight: 600;
    }
    nav {
      max-width: unset;
    }
    .top-profile{
      height: 50px;
      width: 50px;
      border-radius: 50%;
    }
    .float-right{
      float: right;
    }
    .mt-15{
      margin-top: 15px;
    }
    .ct-pd{
      padding: 15px 0;
    }
    .custom-dropdown-menu{
      width: 40%;
      left: -4vw !important;
    }
    .text-right.dropdown.user:hover{
      cursor: pointer;
    }
  </style>

  @yield('css')
</head>
<body itemscope class="bodyclass">
  <main>
