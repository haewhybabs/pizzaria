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

                    @if(@session('verify'))
                    <script type="text/javascript">
                      Swal.fire({
                        title:"Verification code has been sent to your Registered email.",
                        type:"success",
                      });
                    </script>
                    @endif
                    @if(@session('invalid'))
                    <script type="text/javascript">
                      Swal.fire({
                        title:"Invalid verification code.",
                        type:"error",
                      });
                    </script>
                    @endif

                    <div class="sign-popup-title text-center">
                      <h3>Verification</h3>
                    </div>
                    <form class="sign-form" method="POST" action="{{ route('user.verify') }}" id="verifyForm">
                      @csrf
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 form-group">
                          <input id="code" name="code" type="text" class="brd-rd3"  placeholder="Code" autocomplete="off" autofocus>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <button class="red-bg brd-rd3" type="submit">{{ __('Verify') }}</button>
                      </div>
                      <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <a class="sign-btn" href="{{ route('resendCode') }}" itemprop="url">Resend Code
                        </a>
                      </div>
                    </div>
                  </form>
                    @error('email')
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
    $('#verifyForm').validate({
      errorClass: "errMsg",
      rules:{
        code:{
          required:true,
          number:true
        },
      },
      messages:{
        code:{
          required:"Please enter verification code",
          number:"Please enter valid numeric code"
        },
      },
      submitHandler:function(form){
        form.submit();
      }
    });
  });
</script>
@endsection