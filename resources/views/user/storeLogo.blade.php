@extends('layouts.user.app')
@section('css')
<style type="text/css">
  .restaurants-wrapper.style2 > li {
    width: 16.667%;
    padding: 0 8px;
    margin-bottom: 50px;
  }
  .newsletter-popup-inner > a.close-btn{
    padding: 5px;
  }
  .newsletter-popup-inner > p{
    margin-top:15px;
  }
  .newsletter-frm > button:hover{
    background-color: grey;
  }
  .errorTxt{
    color: red;
  }
  .logoimg{
    width: 113px;
    height: 113px;
    margin-bottom:5px;
    margin-left: 3px;
  }
  .top-restaurant > a img {
    transform: scale(0.70);
  }
  .top-restaurant > a{
    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>
@endsection
@section('content')
<section>
  <div class="block gray-bg bottom-padd210 top-padd30">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
          <div class="sec-box">
            <div class="sec-wrapper">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12" align="center">
                  <div class="top-restaurants-wrapper">
                    <ul class="restaurants-wrapper style2">

                      @foreach($company as $row)
                      <li class="wow bounceIn" data-wow-delay="0.2s"><div class="top-restaurant"><a class="brd-rd50" href="{{ route('home.store')}}/{{ $row->slug }}" title="{{ $row->name }}" itemprop="url"><img data-src="{{ asset('adminAssets/franchiseLogo/'.$row->logo)}}"  itemprop="image" class="logoimg lazy" ></a></div></li>
                      @endforeach
                    </ul>
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
<div id="subscribePopup" hidden="">
  <div class="newsletter-popup-wrapper text-center" >
    <div class="newsletter-popup-inner" style="background-image: url({{ asset('userAssets/images/newsletter-bg.jpg') }});">
      <a class="close-btn brd-rd50" href="#" title="Close Button" itemprop="url"><i class="fa fa-close " style="padding: 2px;"></i></a>
      <h3 itemprop="headline"><i class="fa fa-envelope-open red-clr"></i>SIGN UP FOR DAILY DEALS</h3>
      <p itemprop="description">Join our Subscribers list to get the latest pizza deals updates and special offers delivered directly in your inbox</p>
      <form class="newsletter-frm brd-rd30" id="subscribeForm" method="post">
        @csrf
        <input class="brd-rd30" type="email" placeholder="ENTER YOUR EMAIL" name="email">
        <button class="brd-rd30 red-bg" type="submit">SUBSCRIBE</button>
      </form>
      <div class="errorTxt"></div>
    </div>
  </div>
</div>
@endsection
@section('js')
@include('sweet::alert')
@if(!Auth::user())
<script type="text/javascript" src="{{ asset('adminAssets/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('adminAssets/js/additional-methods.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $('#subscribeForm').validate({
      errorElement : 'div',
      errorLabelContainer: '.errorTxt',
      errorClass:"errMsg",
      rules:{
        email:{
          required:true,
          email:true
        }
      },
      messages:{
        email:{
          required:"Please enter email",
          email:"Please enter proper email"
        }
      },
      submitHandler:function(form){
        if($('#subscribePopup').is(":visible"))
        {
          $.ajax({
            url:"{{ route('subscribe.save') }}",
            type:"post",
            data:new FormData(form),
            processData:false,
            cache:false,
            contentType:false,
            success:function(data)
            {
              if(data.success)
              {
                Swal.fire({
                  title: "Thank you!",
                  text: "Thank you for subscribing our service,now you'll get the new deals and update in your email !",
                  type: "success",
                  confirmButtonText: "okay!",
                });
                $('#subscribePopup').hide();
              }
            }
          });
        }
      }
    })

  });
</script>
@else
<script type="text/javascript">
  var latitude = '';
  var longitude= '';
  var locFlag = false;

  function getLocation()
  {

    if(navigator.geolocation)
    {
      navigator.geolocation.getCurrentPosition(showPosition,showError);
    }
  }
  function showPosition(position)
  {
    var uid = <?=Auth()->user()->id?>;
    window.locFlag = true;
    var lt = position.coords.latitude;

    var lg = position.coords.longitude;
    window.latitude = lt;
    window.longitude = lg;

    @if($loc)
    var locobj = <?=$loc?>;
    @else
    var locobj = null;
    @endif
    if(locobj == null)
    {

      insertUserLocation(uid);
    }
    else
    {
      if(locobj.latitude != lt && locobj.longitude != lg)
      {
        insertUserLocation(uid);
      }

    }
  }
  function showError(error)
  {

    switch(error.code) {
      case error.PERMISSION_DENIED:
      var flag = sessionStorage.getItem("showAlert");

      if(flag != "false")
      {
        alert('Please allow request for location ');
        sessionStorage.setItem("showAlert", false);
      }


      window.locFlag = false;
      break;
      case error.POSITION_UNAVAILABLE:
      alert('Sorry ! location  information is not available please try again');
      window.locFlag = false;
      break;
      case error.TIMEOUT:
      alert('location request is timed out! please try again');
      window.locFlag = false;
      break;
      case error.UNKNOWN_ERROR:
      alert('Something went wrong please try again');
      window.locFlag = false;
      break;
    }
  }
  function insertUserLocation(id)
  {

    $.ajax({
      url:"{{ route('user.storeLocation') }}",
      type:"post",
      data:{
        "_token": "{{ csrf_token() }}",
        latitude:window.latitude,
        longitude:window.longitude
      },
      success:function(data)
      {
        window.location = "{{ route('home.store') }}";
      }
    })
  }
  $(document).ready(function(){
    getLocation();
  })
</script>
@endif
@endsection
