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

                    <form class="sign-form"  method="POST" action="{{ route('password.email') }}" id="sendLinkForm">
                      @csrf
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="Email" autocomplete="email" autofocus>

                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                          <button class="red-bg brd-rd3" type="submit">{{ __('Send Password Reset Link') }}</button>
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
  $('#sendLinkForm').validate({
    errorClass:"errMsg",
    rules:{
      email:{
        required:true,
        email:true
      }
    },
    messages:{
      email:{
        required:"Please enter your email",
        email:"Please enter proper email"
      }
    },
    submitHandler:function(form)
    {
      form.submit();
    }
  })
</script>
@endsection