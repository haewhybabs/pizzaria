@extends('layouts.user.app')
@section('css')
<style type="text/css">
  .restaurant-info-form input{
    color:black;
    font-size: 15.8px;
    margin: 0;
  }
  .restaurant-info-form .brd-rd3 {
    color:black;
    font-size: 15.8px;
  }
  .restaurant-info-form .red-bg {
    color:white;
  }
  .select-wrp span {
    font-size: 15.8px;
  }
  .restaurant-info-form button{
    float: left;
    width: 100%;
    color: white;
    font-weight: 700;
    font-family: Poppins;
    padding: 15px 20px;
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
                      <h4 itemprop="headline">Register</h4>
                    </div>
                    <form class="restaurant-info-form brd-rd5 "  method="POST" action="{{ route('register') }}" id="regForm" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 form-group">
                          <input  class="brd-rd3" type="text" name="name" placeholder="Name" placeholder="Name">
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 form-group">
                          <input class="brd-rd3" type="text" name="phone" placeholder="Phone" >
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 form-group">
                          <input class="brd-rd3 " name="email" type="text"  placeholder="Email">
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 form-group">
                          <input class="brd-rd3 " name="password" type="password" id="password" placeholder="Password">
                        </div>
                        <!-- <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 form-group">
                          <input class="brd-rd3 " name="password_confirmation" type="password" placeholder="Confirm password">
                        </div> -->
                       <!-- <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                          <textarea class="brd-rd3" name="address" rows="4" cols="35" placeholder="Address" style="padding: 10px 28px"></textarea>
                        </div>
                         <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                          <input class="brd-rd3 " name="city" type="text" placeholder="city">
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                          <input class="brd-rd3 " name="state" type="text" placeholder="state">
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                          <input class="brd-rd3 " name="country" type="text" placeholder="country">
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                          <div class="select-wrp">
                            <select name="pizzaType">
                              <option >Select your pizza preference</option>
                              @foreach($cate as $row)
                                <option value="{{ $row->id }}">{{ $row->category }}</option>
                              @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                          <input class="brd-rd3 " name="uimg" type="file">
                        </div>
                      -->
                      <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <button class="red-bg brd-rd3" type="submit" >{{ __('Register') }}</button>
                      </div>

                      <!-- <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                          <a class="sign-btn" href="#" title="" itemprop="url">Not a member? Sign up</a>
                          <a class="recover-btn" href="#" title="" itemprop="url">Recover my password</a>
                        </div> -->
                      </div>
                    </form>
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
  $(document).ready(function(){

    $('#regForm').validate({
      errorClass: "errMsg",
      rules:{
        name:"required",
        email:{
          required:true,
          email:true,
          // remote:{
          //   url:"{{ route('profile.checkemail') }}",
          //   type:"post",
          //   data:{
          //     "_token": "{{ csrf_token() }}",
          //     email:function(){
          //       return $('#regForm :input[name="email"]').val();
          //     }
          //   }
          // }
        },
        password:{
          required:true,
          minlength: 8
        },
        /*password_confirmation:{
          equalTo:'#password'
        },*/
        phone:"required",
        /*address:"required",
        city:"required",
        state:"required",
        country:"required",
        uimg:{
          required:true,
          extension:"jpg|jpeg|png"
        },*/
      },
      messages:{
        name:"Please enter name",
        email:{
          required:"Please enter email",
          email:"Please enter valid email",
          remote:"This email has already been taken"
        },
        password:{
          required: "Please enter password",
          minlength:"Please enter atleast 8 character"
        },
        /*password_confirmation:{
          equalTo:"confirm password not same",
        },*/
        phone:"Please enter phone number",
        /*address:"Please enter address",
        city:"Please enter city",
        state:"Please enter state",
        country:"Please enter counytry",
        uimg:{
          required:"Please select image",
          extension:"Image should be JPG JPEG or PNG format"
        }*/
      },
      submitHandler:function(form)
      {
        form.submit();
      }
    });
  })
</script>
@endsection