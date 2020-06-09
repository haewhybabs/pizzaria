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
                    <div class="sign-popup-title text-center">
                      <h4 itemprop="headline">Reset Password</h4>
                    </div>
                    
                    <form class="sign-form"  method="POST" action="{{ route('password.update') }}" id="resetPassword">
                      @csrf
                      <input type="hidden" name="token" value="{{ $token }}">
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}"  autocomplete="email" autofocus>

                        </div>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="new-password">
                        </div>
                          <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                          <input id="password-confirm" type="password" placeholder="Confirm password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                          <button class="red-bg brd-rd3" type="submit"> 
                          {{ __('Reset Password') }}</button>
                        </div>
                      </div>


                    </form>
                     @error('email')
                     <div class="col-md-12" align="center">
                        <span class="invalid-feedback errMsg" role="alert">
                            <strong>{{ $message." maybe your password reset link is expired" }}</strong>
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
                    @if (session('status'))
                    <div class="col-md-12" align="center">
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    </div>
                    @endif
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
  <script type="text/javascript" src="{{ asset('adminAssets/js/additional-methods.min.js')}}"></script>
  <script type="text/javascript">
    $('#resetPassword').validate({
      errorClass:"errMsg",
        rules:{
            email:{
                required:true,
                email:true
            },
            password:{
              required:true,
              minlength:8,
            },
            password_confirmation:{
              required:true,
              equalTo:"#password"
            }
        },
        messages:{
          email:{
            required:"Please enter email",
            email:"Please enter proper email"
          },
          password:{
            required:"Please enter new password",
            minlength:"Password must be longer than 8 charachers"
          },
          password_confirmation:{
            required:"Please enter confirm password",
            equalTo:"Confirm password same as password"
          }
        },
        submitHandler:function(form)
        {
            form.submit();
        }
    })
  </script>
@endsection