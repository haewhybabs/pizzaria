@extends('layouts.user.app')
@section('css')
<style type="text/css">
  .sign-form button:hover{
    background-color: #333;
    color:white;
  }
  .sign-form input {
    float: left;
    width: 100%;
    font-size: 10.8px;
    color: black;
    font-size: 13.8px;
    height: 45px;
    margin-bottom: 10px;
    padding: 10px 28px;
    box-shadow: 0 3px 10px rgba(0,0,0,.04);
  }
  .sign-form{
    padding: 30px;
    background-color: #f9f9f9;
  }
  .sign-popup-inner.brd-rd5{
    padding: 30px;
  }
</style>
@endsection
@section('content')
<section>
  <div class="block top-padd30">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
          <div class="login-register-wrapper">
            <div class="row">
              <div class="col-md-3 col-sm-12 col-lg-3"></div>
              <div class="col-md-6 col-sm-12 col-lg-6" >
                <div class="sign-popup-wrapper brd-rd5">
                  <div class="sign-popup-inner brd-rd5">
                    @if(@session('status'))
                    @if(@session('status') == "Password is changed")
                    <script type="text/javascript">
                      Swal.fire({
                        text:"Your password has changed now you can login with new password ",
                        type:"success",
                      });
                    </script>
                    @endif
                    @endif

                    @if(@session('verify'))
                    <script type="text/javascript">
                      Swal.fire({
                        text:"Verification code has been sent to your registered email.",
                        type:"success",
                      });
                    </script>
                    @endif

                    <div class="sign-popup-title text-center">
                      <h4 itemprop="headline">Login</h4>
                    </div>
                    <form class="sign-form" method="POST" action="{{ route('login') }}" id="loginForm">
                      @csrf
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 form-group">
                          <input id="email" name="email" type="email" class="brd-rd3 @error('email') is-invalid @enderror" type="text" placeholder="Email" value="{{ old('email') }}"  autocomplete="email" autofocus>
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 form-group">
                          <input class="brd-rd3  @error('password') is-invalid @enderror"  id="password" name="password" type="password" placeholder="Password"  autocomplete="current-password">

                          @if(@session('warning'))
                          <script type="text/javascript">
                            Swal.fire({
                              title:"You're blocked by admin",
                              type:"error",
                            });
                          </script>
                          @endif
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                          <button class="red-bg brd-rd3" type="submit">{{ __('Login') }}</button>
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                          <a class="sign-btn" href="{{ url('/register') }}" title="" itemprop="url">Not a member? Sign up</a>
                          <a class="recover-btn" href="{{ url('/password/reset') }}" title="" itemprop="url">Recover my password</a>
                        </div>
                      </div>
                     <!--  @if ($errors->any())
                              {{ implode('', $errors->all('<div>:message</div>')) }}
                      @endif -->

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
                      <span class="invalid-feedback errMsg" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    </div>
                    @enderror
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('adminAssets/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
      $('#loginForm').validate({
         errorClass: "errMsg",
         rules:{
            email:{
              required:true,
              email:true
            },
            password:"required",
         },
         messages:{
            email:{
              required:"Please enter email",
              email:"Please enter valid email"
            },
            password:"Please enter password"
         },
         submitHandler:function(form){
          form.submit();
         }
      })
  })
</script>
@endsection
