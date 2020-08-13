@extends('layouts.user.app')
@section('css')
<link href="{{ asset('adminAssets/css/select2.css') }}" rel="stylesheet">
<style type="text/css">
  .modal-header{
    background-color: #ea1b25;
    color: white;
  }
  .btnloadrow{
    padding-top: 50px;
  }
  .load-more{
    margin-top: 25px;
    color:white;
  }
  .load-more:hover{
    background-color: grey;
  }
  .product-box{
    height: 550px;
  }
  .pizzaImg{
    width: 225px;
    height: 225px;
    align:center;
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
  .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover
  {
    color: #fff;
    text-decoration: none;
    background-color: #ea1b25;
    outline: 0
  }
  .dropdown-menu>li>a {
    display: block;
    padding: 8px 20px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
  }
  .dropdown-menu {
    width: 95%;
    left:27px!important;
    align:center;
  }
  .typeahead dropdown-menu{
    margin-left:20px;
  }
  .remove-ext5{
    width: 100%;
  }
  .img-bg{
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
  .onlytext{
    font-family: Poppins;
    font-weight: 700;
    font-size:55px;
    /*color: #ea1b25;*/
  }
  .restaurant-search-form2 *{
    font-size: 15px !important;
  }
  #detailModal label.errMsg{
    padding-left: 1%;
  }
  .custom-dropdown-menu{
    width: 40%;
    left: -4vw !important;
  }
  .text-right.dropdown.user:hover{
    cursor: pointer;
  }
  .home-order{
    font-size:15px;
  }
  @media (min-width:320px)  { /* smartphones, portrait iPhone, portrait 480x320 phones (Android) */ }
  @media (min-width:480px)  { /* smartphones, Android phones, landscape iPhone */ }
  @media (min-width:600px)  { 
    .home-order-mobile
    {
      display: none;
    } 
   }
  @media (min-width:801px)  { 
    .home-order-mobile
    {
      display: none;
    } 
}
  @media (min-width:1025px) {  
    .home-order-mobile
      {
        display: none;
      } 
  }
  @media (min-width:1281px) {
    .home-order-mobile
      {
        display: none;
      } 
   }
</style>
@endsection
@section('content')
@include('sweet::alert')


    <section>
      <div class="block blackish opac50">
        <div class="fixed-bg img-bg" style="background-image: url({{ asset('userAssets/images/topbg.jpg') }});">
        </div>
        <div id="alert" role="alert" style="display: none" class="alert alert-warning alert-dismissable"></div>
        <div class="restaurant-searching style2 text-center">
          <div class="restaurant-searching-inner">
            <span >Home of <i>Pizza</i > and <span class="onlytext">ONLY</span> Pizza</span>
            <h2 itemprop="headline">Order Eat-In, Delivery & Take-Out</h2>
            <form class="restaurant-search-form2 brd-rd30"  id="searchForm" action="{{ route('home.search') }}" method="post">
              @csrf
              <input class="brd-rd30" type="text" placeholder="FRANCHISE NAME" name="txtsearch"  id="txtsearch">
              <button class="brd-rd30 red-bg" type="submit">SEARCH</button>
            </form>
            <div class="errorTxt"></div>
          </div>
        </div><!-- Restaurant Searching -->
      </div>
    </section>
    <section>
      <div class="block no-padding overlape-45">
        <div class="container">
          <div class="row">
            <div class="home-order-mobile">
              <div class="col-md-12 col-sm-12 col-lg-12" align="center" style="margin-bottom: 20px;">
                <a href="{{ URL::TO('order-without-login') }}"> <button class=" home-order load-more  red-bg btn-lg" data-totalRes="{{ $totalProd }}">Order Without Login</button></a>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12">
              <div class="top-restaurants-wrapper">
                <ul class="restaurants-wrapper style2">
                 @foreach($company as $row)
                 <li class="wow bounceIn" data-wow-delay="0.2s">
                     <div class="top-restaurant">
                         <a class="brd-rd50" href="{{ route('home.store')}}/{{ $row->slug }}" title="{{ $row->name }}" itemprop="url">
                             <img data-src="{{ asset('adminAssets/franchiseLogo/'.$row->logo)}}" class="logoimg lazy" itemprop="image" style="">
                         </a>
                     </div>
                 </li>
                 @endforeach
               </ul>
             </div>
           </div>
         </div>
         <div class="row">
          <div class="col-md-12 col-sm-12 col-lg-12" align="center">
            <a href="{{ route('home.store') }}"> <button class="load-more  red-bg btn-lg" data-totalRes="{{ $totalProd }}">See All Stores</button></a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Your Favourite Food -->
  <section>
    <div class="block">
      <div class="container con">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="title1-wrapper text-center">
              <div class="title1-inner">
                <span>Your Favourite Pizza</span>
                <h2 itemprop="headline">Choose & Enjoy</h2>
              </div>
            </div>
            <div class="row remove-ext5 product-list">
              @foreach($product as $row)
              <div class="col-md-3 col-sm-6 col-lg-3 product-box">
                <div class="popular-dish-box wow fadeIn" data-wow-delay="0.2s">
                  <div class="popular-dish-thumb">
                    <a href="javascript:void(0)" title="" itemprop="url"><img data-src="{{ asset('pizzaImage/'.$row->pizzaImage) }}" alt="{{$row->pizzaImage}}" itemprop="image" class="pizzaImg lazy"></a>

                  </div>
                  <div class="popular-dish-info">
                    <h4 itemprop="headline"><a  href="/store/{{ $row->store->slug }}"  title="" itemprop="url">
                     {{  $row->name }}</a>
                   </h4>
                   <p itemprop="description">Type : {{ $row->category->category }} <br> Topping : {{ $row->topping }} <br>
                    <?php $size = $row->size; ?>
                    @if($size == 0)Small @elseif($size == 1) Medium   @elseif($size == 2) Large @else Extra large @endif
                  </p>

                  <span class="price">${{ $row->price }}</span>
                  <a class="brd-rd2" @if(Auth::check()) href="/order/{{ $row->id }}" @else onclick="showalert()" href="#" @endif title="Order Now" itemprop="url">Order Now</a>
                  <div class="restaurant-info">
                    <div class="restaurant-info-inner">
                      <h6 itemprop="headline"><a href="store/{{ $row->store->slug }}" title="" itemprop="url">{{$row->store->name}}</a></h6>
                      <span class="red-clr">{{$row->store->zip_code}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach

          </div>

        </div>

      </div>
      @if(count($product)<$totalProd)
      <div class="row btnloadrow">
        <div class="col-md-12" align="center">
          <button class="load-more  red-bg btn-lg" data-totalRes="{{ $totalProd }}">Load more</button>
        </div>
      </div>
      @endif
    </div>

  </div>
</section>

@endsection
@section('js')
<script type="text/javascript" src="{{ asset('adminAssets/js/select2.js')}}"></script>
<script type="text/javascript" src="{{ asset('userAssets/js/bootstrap3-typeahead.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var url="{{ route('search.typeahead') }}"
    $('#txtsearch').typeahead({
      minLength:4,
      source:function(query,process){
        return $.get(url,{query:query},function(data){
          return process(data)
        });
      }
    })
  });
</script>
@if(Auth::user())
<script type="text/javascript">
  var latitude = '';
  var longitude= '';
  var locFlag = false;
  if (!window.sessionStorage) {
    sessionStorage.setItem("showAlert", true);
  }
  function getLocation()
  {
    if(navigator.geolocation)
    {
      navigator.geolocation.getCurrentPosition(showPosition,showError); //get user location
    }
  }
  function showPosition(position)
  {
    var uid = <?=Auth()->user()->id?>;
      //alert('in position fun');
      window.locFlag = true;
      var lt = position.coords.latitude; //current latitude

      var lg = position.coords.longitude; //current longitude
      /*console.log(lt);
      console.log(lg);*/
      window.latitude = lt;
      window.longitude = lg;
      //checkLocation();

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
      //alert('in error fun');

      switch(error.code) {
        case error.PERMISSION_DENIED:
        var flag = sessionStorage.getItem("showAlert");

        if(flag !="false")
        {
          alert('Please allow request for location');
          sessionStorage.setItem("showAlert", false);
        }

        window.locFlag = false;
        break;
        case error.POSITION_UNAVAILABLE:
        alert('Sorry! location information is not available, please try again');
        window.locFlag = false;
        break;
        case error.TIMEOUT:
        alert('Location request timed out! please try again');
        window.locFlag = false;
        break;
        case error.UNKNOWN_ERROR:
        alert('Something went wrong, please try again');
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
          window.location = "{{ route('home') }}";
        }
      })
    }
  </script>

  @if(Auth::user()->preference == " " || Auth::user()->preference == null)
  <script src="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.jquery.min.js"></script>
  <script type="text/javascript">

    $(document).ready(function(){
      $('#detailModal').modal('show');
      $(".chosen-select").chosen({ max_selected_options: 3 });
        //  $(".chosen-select").bind("chosen:maxselected", function () { alert() });
        // $('#pizzaPref').select2({
        //     multiple:true,
        //     maximumSelectionLength: 3,
        //     width: "400px",
        // });
      })
    </script>
    @else
    <script type="text/javascript">
      $(document).ready(function(){
    /*$.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });*/
    getLocation();
  })
</script>
@endif
@else
@if(!Session::has('latitude'))
<script type="text/javascript">
  function getLocation()
  {
    if(navigator.geolocation)
    {
      navigator.geolocation.getCurrentPosition(showPosition, showError, {maximumAge:60000, timeout:5000, enableHighAccuracy:true});
    }
  }
  function showPosition(position)
  {
    var lt = position.coords.latitude;
    var lg = position.coords.longitude;
    $.ajax({
      url:"{{ route('location.storeInSession')}}",
      type:"post",
      data:{
        "_token": "{{ csrf_token() }}",
        latitude:lt,
        longitude:lg
      },
      success:function(data)
      {
          console.log(data)
      }
    })
  }
  function showError(error)
  {
      localStorage.clear();
      //alert('in error fun');

      switch(error.code) {
          case error.PERMISSION_DENIED:
              alert("Location Permission Denied");
              window.parent.caches.delete('Location');
              /*var flag = sessionStorage.getItem("showAlert");

              if(flag =="false")
              {
                  alert('Please allow request for location');
                  sessionStorage.setItem("showAlert", false);
              }

              window.locFlag = false;*/
              break;
          case error.POSITION_UNAVAILABLE:
              alert('Sorry! location information is not available, please try again');
              window.locFlag = false;
              break;
          case error.TIMEOUT:
              alert('Location request timed out! please try again');
              window.locFlag = false;
              break;
          case error.UNKNOWN_ERROR:
              alert('Something went wrong, please try again');
              window.locFlag = false;
              break;
      }
  }
  $(document).ready(function(){
    // getLocation();
  });
</script>
@endif
@endif
<script type="text/javascript" src="{{ asset('adminAssets/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('adminAssets/js/additional-methods.min.js')}}"></script>
<script type="text/javascript">
  var main_site="{{ url('/') }}";
  $('.load-more').click(function(){
    var _totalres = $('.product-box').length;
    $.ajax({
      url:main_site+"/load-more-data",
      type:'post',
      dataType:'json',
      data:{
        "_token": "{{ csrf_token() }}",
        skip:_totalres,
        latitude:window.latitude,
        longitude:window.longitude,
      },
      beforeSend:function(){
        $('.load-more').html('<i class="fa fa-refresh fa-spin"></i> loading...');
      },
      success:function(response){
                //console.log(response);
                var _html = '';
                var img = "{{ asset('pizzaImage') }}/";
                var cimg = "{{ asset('adminAssets/franchiseLogo') }}/";
                $.each(response,function(index,value){
                  _html += '<div class="col-md-3 col-sm-6 col-lg-3 product-box" style="display:none">';
                  _html += '<div class="popular-dish-box wow fadeIn" data-wow-delay="0.2s">';
                  _html += '<div class="popular-dish-thumb">';
                  _html += '<a href="javascript:void(0)" title="" itemprop="url"><img src="'+img+value.pizzaImage+'" alt="'+value.pizzaImage+'" itemprop="image" class="pizzaImg"></a>'
                  _html += '</div>';
                  _html += ' <div class="popular-dish-info">';
                  _html += '<h4 itemprop="headline">'
                  _html +=  '<a  href="/store/'+value.store.slug+'"  title="" itemprop="url">'
                  _html +=  value.name+'</a></h4>';
                  _html +=  '<p itemprop="description">Type :'+value.category.category + '<br>'+ 'Topping : '+ value.topping + '</p>';
                  _html += '<span class="price">$'+value.price+'</span>';
                  _html += '<a class="brd-rd2" @if(Auth::check()) href="/order/'+value.id+'" @else onclick="showalert()" href="#" @endif title="Order Now" itemprop="url">Order Now</a>';
                  _html+='<div class="restaurant-info">';
                  _html+='<div class="restaurant-info-inner">';
                  _html+='<h6 itemprop="headline"><a href="store/'+value.store.slug+'" title="" itemprop="url">'+value.store.name+'</a></h6>';
                  _html+='<span class="red-clr">'+value.store.zip_code+'</span>';
                  _html+='</div></div>';
                  _html +='</div> </div></div>';

                });
                $(".product-list").append(_html);
                $(".product-box").show();
                var _totalres=$(".product-box").length;
                var tbres = parseInt($(".load-more").attr('data-totalRes'));
                // console.log('current product'+_totalres);
                // console.log(' in table '+tbres);
                if(_totalres == tbres)
                {
                  $(".load-more").remove();
                }
                else
                {
                  $(".load-more").html('Load more');
                }
               //$('.lazy').lazy();
             }
           });
  });
</script>
<script type="text/javascript">
  function showalert()
  {
    Swal.fire({
      title:"Please Login to continue",
      type:"error",
    }).then((value) => {
      window.location = "{{ route('login') }}";
    });
  }
</script>
<script>

  sendEvent = function(sel, step) {
    var sel_event = new CustomEvent('next.m.' + step, {detail: {step: step}});
    window.dispatchEvent(sel_event);
  }
  $(document).ready(function(){
    var iflag = true;
    var sflag = true;

    $(document).on('change','#pizzaPref',function(){
      if($('#pizzaPref').val()!="")
      {
        $('#prefResult').html("");
        iflag = true;
      }
    });
    $(document).on('change','#pizzaStore',function(){
      if($('#pizzaStore').val()!="")
      {
        $('#storeResult').html("");
        iflag = true;
      }
    });
    $(document).on('change','#pizzaSize',function(){
      if($('#pizzaSize').val()!="")
      {
        $('#sizeResult').html("");
        iflag = true;
      }
    });
    $(document).on('change','#deliveryMethod',function(){
      if($('#deliveryMethod').val()!="")
      {
        $('#delResult').html("");
        iflag = true;
      }
    });
    $(document).on('change','#address',function(){
      if($('#address').val()!="")
      {
        $('#addResult').html("");
        sflag = true;
      }
    })
    $(document).on('change','#country',function(){
      if($('#country').val()!="")
      {
        $.ajax({
          type:'POST',
          url:'{{url("state-list")}}',
          // data:'country_id='+countryID,
          data:{
            "_token": "{{ csrf_token() }}",
            "country": $('#country').val()
          },
          success:function(response){
            $('#state').empty().append(response).trigger("chosen:updated");
          }
        });
        $('#conResult').html("");
        sflag = true;
      }
      else{
        $('#state').html('<option value="">Select Country First</option>').trigger("chosen:updated");
      }
    })
    $(document).on('change','#state',function(){
      if($('#state').val()!="")
      {
        $('#staResult').html("");
        sflag = true;
      }
    })
    $(document).on('change','#city',function(){
      if($('#city').val()!="")
      {
        $('#ciResult').html("");
        sflag = true;
      }
    });
    $(document).on('change','#uimg',function(){
      var ext = $('#uimg').val().split('.').pop().toLowerCase();
      if($.inArray(ext,['jpg','jpeg','png']) != -1)
      {
        $('#imgResult').html("");
        sflag = true;
      }
    })

    $(document).on('click','#continue',function(){

      if($('#pizzaPref').val() == "")
      {
        $('#prefResult').html("Please select your pizza preference");
        iflag = false;
      }
      if($('#pizzaSize').val() == "")
      {
        $('#sizeResult').html("Please select your favourite pizza size");
        iflag = false;
      }
      if($('#pizzaStore').val() == "")
      {
        $('#storeResult').html("Please select your favourite pizza store");
        iflag = false;
      }
      if($('#deliveryMethod').val() == "")
      {
        $('#delResult').html("Please select delivery method ");
        iflag = false;
      }
      if(iflag)
      {
        // var data = {'pizzaPref':$('#pizzaPref').val(),
        //                 'pizzaSize':$('#pizzaSize').val(),
        //                 'pizzaStore':$('#pizzaStore').val(),
        //                 'deliveryMethod':$('#deliveryMethod').val(),
        //             };
        // var detail=JSON.stringify(data);
        // localStorage.setItem('detail', detail);
        sendEvent('#detailModal', 2);
      }
    });
    //modal form
    $(document).on('submit','#detailModal',function(e){
      e.preventDefault();
      var ext = $('#uimg').val().split('.').pop().toLowerCase();
      if($('#address').val()=="")
      {
        $('#addResult').html("Please enter address");
        sflag = false;
      }
      if($('#country').val()=="")
      {
        $('#conResult').html("Please select country");
        sflag = false;
      }
      if($('#state').val()=="")
      {
        $('#staResult').html("Please select state");
        sflag = false;
      }
      if($('#city').val()=="")
      {
        $('#ciResult').html("Please enter city");
        sflag = false;
      }
      if($('#uimg').val()!="")
      {
        var ext = $('#uimg').val().split('.').pop().toLowerCase();
        /*$('#imgResult').html("Please select image");
        sflag = false;*/
        if($.inArray(ext,['jpg','jpeg','png']) == -1)
        {
          $('#imgResult').html("Image should be in format of JPG, JPEG OR PNG");
          sflag = false;
        }
      }

      if(sflag)
      {
        $.ajax({
          url:"{{ route('profile.saveDetails') }}",
          type:"post",
          data:new FormData(this),
          processData:false,
          cache:false,
          contentType:false,
          success:function(data)
          {
            //console.log(data);
            if(data.success == 1){
              $('#detailModal').modal('toggle');
              //alert("its here");
              getLocation();
            }
          }
        })
      }
    });
    //search
    $('#searchForm').validate({
      errorElement : 'div',
      errorLabelContainer: '.errorTxt',
      errorClass:"errMsg",
      rules:{
        txtsearch:"required",
      },
      messages:{
        txtsearch:"Please enter franchise name"
      },
      submitHandler:function(form)
      {
        form.submit();
        $('#searchForm')[0].reset();
      }
    })
  })
</script>
@endsection
