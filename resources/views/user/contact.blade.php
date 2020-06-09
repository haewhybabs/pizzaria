@extends('layouts.user.app')
@section('css')
<style type="text/css">
	.errMsg{
		float: left;
	}
	.contact-form-inner > form input{
		color:black;
	}
	.contact-form-inner > form textarea{
		color:black;
	}
  .sec-box {
    margin: 0 auto;
    max-width: 1300px;
    width: 100%;
    padding: 0px 45px 45px 10px;
    background-color: #fff;
    float: left;
  }
  .captchaErr{
    color:red;
    font-weight: 700;
    margin-left: 16px;
    float: left;
  }
  .px-22{
    font-size: 22px;
  }
</style>
@endsection
@section('content')
<section>
  <div class="block less-spacing gray-bg top-padd30">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
          <div class="sec-box">

            <div class="contact-form-wrapper text-center">
              <div class="contact-form-inner">
                <h4 class="px-22">Send us a Message</h4>
                <div id="message" class="alert alert-success" hidden="true"></div>
                <form  id="contactform" class="contact-form">
                  @csrf
                  <div class="row">
                    <div class="col-md-12 col-sm-6 col-lg-12">
                      <input id="name" name="name" type="text" placeholder="Your Name">
                    </div>
                    <div class="col-md-12 col-sm-6 col-lg-12">
                      <input id="email" name="email" type="email" placeholder="Your Email">
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12">
                      <input type="text" name="subject" placeholder="Subject">
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12">
                      <textarea id="comments" name="comments" placeholder="Message"></textarea>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12" align="left">
                      <div class="g-recaptcha" data-sitekey="6LdScbkUAAAAADH8-G9TQZhKEoQRZiBCBXlyJVyI"></div>
                    </div>
                    <span class="captchaErr" id="captchaMsg" hidden="" >You can not leave captcha blank</span>
                    <div class="col-md-12 col-sm-12 col-lg-12">
                      <button class="brd-rd2" id="submit" type="submit">SEND MESSAGE</button>
                      <img src="{{ asset('userAssets/images/ajax-loader.gif') }}" class="loader" hidden alt="ajax-loader.gif" itemprop="image">
                    </div>
                  </div>
                </form>
              </div>
            </div><!-- Contact Form Wrapper -->
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
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script type="text/javascript">
  	$(document).ready(function(){

  		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
  		$('#contactform').validate({
  			errorClass:"errMsg",
  			rules:{
  				name:"required",
  				email:{
  					required:true,
  					email:true,
  				},
  				subject:"required",
  				comments:"required"
  			},
  			messages:{
  				name:"Please enter name",
  				email:{
  					required:"Please enter email",
  					email:"Please enter proper email"
  				},
  				subject:"Please enter subject",
  				comments:"Please enter comments"
  			},
  			submitHandler:function(form)
  			{
          var v = grecaptcha.getResponse();
          if(v.length == 0)
          {
            $('#captchaMsg').show();
          }
          else
          {
            $('#captchaMsg').hide();

              $.ajax({
                url:"{{ route('contact.sendMessage')}}",
                type:"post",
                data:new FormData(form),
                cache : false,
                processData: false,
                contentType:false,
                beforeSend:function(){
                  $('.loader').show();
                },
                success:function(data)
                {
                  $('.loader').hide();
                  $('#contactform')[0].reset();
                  if(data.success)
                  {
                    $('#message').show();
                    $('#message').html('Thank you! Your message has been sent');
                  }
                }
              });
            }
  		    }
  		  })
      })
  </script>
@endsection