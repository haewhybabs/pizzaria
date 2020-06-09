<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin login </title>

    <!-- Bootstrap -->
    <link href="{{ asset('adminAssets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('adminAssets/css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
   
    <!-- NProgress -->
    <link href="{{ asset('adminAssets/css/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
  
     <link href="{{ asset('adminAssets/css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
  <link href="{{ asset('adminAssets/css/custom.min.css')}}" rel="stylesheet">
  <style type="text/css">
    .errMsg{
      color:red;
    }
    .logo{
      align:center;
      padding-top: 30px;
    }
    .logo h1{
      align:center;
    }
  </style>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <div class="logo">
        <h1 align="center">Pizza pizzaria</h1>
      </div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
             <form method="POST" action="{{ route('admin.login.submit') }}" id="loginFomr">
              @csrf
              <h1>Admin login</h1>
              
              <div>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="email" />

              </div>
              <div>
                <input tid="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="password"/>

                
              </div>
              <div>
                 <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>
                <!--<a class="btn btn-default submit" href="index.html">Log in</a>-->
                
              </div>

              <div class="clearfix"></div>

              
            </form>
          @error('email')
          <div class="col-md-12" align="center">
              <span class="invalid-feedback errMsg" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          </div>
          @enderror
          @error('password')
          <div class="col-md-12" align="center">
              <span class="invalid-feedback errMsg" role="alert" >
                  <strong >{{ $message }}</strong>
              </span>
          </div>
          @enderror
          </section>
        </div>


      </div>
    </div>
  </body>
  <script src="{{ asset('adminAssets/js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('adminAssets/js/jquery.validate.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#loginFomr').validate({
        errorClass:"errMsg",
          rules:{
              email:{
                required:true,
                email:true,
              },
              password:"required"
          },
          messages:{
            email:{
              required:"Please enter email",
              email:"Please enter valid email"
            },
            password:"Please enter password"
          },
          submitHandle:function(form)
          {
              form.submit();
          }

      });
    })
  </script>
</html>
