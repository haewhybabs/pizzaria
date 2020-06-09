<html>

<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Askbootstrap">
      <meta name="author" content="Askbootstrap">
      <title>Pizza pizzaria </title>
      <!-- Favicon Icon -->
      <link rel="icon" type="image/x-icon" href="">
      <!-- Bootstrap core CSS-->
      <link href="{{ asset('userAssets/css/bootstrap.min.css') }}" rel="stylesheet">
      <!-- Font Awesome-->
      <link href="{{ asset('userAssets/css/all.min.css') }}" rel="stylesheet">
      <!-- Font Awesome-->
      <link href="{{ asset('userAssets/css/icofont.min.css') }}" rel="stylesheet">
      <!-- Select2 CSS-->
      <link href="{{ asset('userAssets/css/select2.min.css') }}" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="{{ asset('userAssets/css/osahan.css') }}" rel="stylesheet">
   @yield('css')
   </head>
   <body class="bg-white">
      @yield('content')
      <!-- jQuery -->
    <script src="{{ asset('userAssets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('userAssets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('userAssets/js/plugins.js')}}"></script>
      <!-- Select2 JavaScript-->
      <script src="{{ asset('userAssets/js/select2.min.js') }}"></script>
      <!-- Custom scripts for all pages-->
      <script src="{{ asset('userAssets/js/custom.js') }}"></script>
      @yield('js')
   </body>


</html>