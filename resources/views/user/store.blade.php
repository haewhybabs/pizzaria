@extends('layouts.user.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

@section('css')
<style type="text/css">
  .pizzaItem{
    width :50px;
    height: 50px;
    padding-left:5px;
    padding-right:5px;
  }
  .pizzaList{
    padding-left:0px;
    padding-right:0px;
    height: 300px;
    max-height: 500px;
  }
  .btnloadrow{
    padding-top: 30px;
  }
  .load-more{
    margin-top: 25px;
    color:white;
  }
  .load-more:hover{
    background-color: grey;
  }
  .store-box{
    min-height: 350px;
    max-height: 350px;
  }
  .search-frm{
    width: 50%;
    margin-top: 0;
  }
  .search-frm > input{
    height: 45px;
  }
  .search-frm > button:hover,
  .search-frm > button:focus{
    background-color: #333;
    color:white;
  }
  .search-frm > button{
    max-height: 45px;
  }
  .companyrow{
    margin-top:20px;
  }
  .btncom{
    color:white;
  }
  .btncom:hover{
    background-color:grey;
  }
  .li-hidden{
    display: none;
  }
  .input-company{
    background-color: #fafafa;
    padding: 8px 19px;
    width: 100%;
    font-size: 11px;
    color: #767676;
    margin-bottom: 30px;
  }
  .selstore{
    width: 46%;
  }
  .selpref{
    float: right;
    margin-top: -74px;
    width: 48%;
  }
  .selsize{
    width: 46%;
  }
  .seldel{
    float: right;
    margin-top: -69px;
    width: 48%;
  }
  .select-wrp .chosen-container-single .chosen-single > span {
    margin-right: 0 !important;
  }
  .d-flex {
    display: flex;
    flex-wrap: wrap;
  }
  .d-flex div{
    margin-right: 15px;
  }

  .lds-hourglass {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
}

.lds-hourglass:after {
    content: " ";
    display: block;
    border-radius: 50%;
    width: 0;
    height: 0;
    margin: 8px;
    box-sizing: border-box;
    border: 32px solid #e3342f;
    border-color: #e3342f transparent #fff transparent;
    animation: lds-hourglass 1.2s infinite;
}
select[multiple] {
  background:none;
  width:auto;
  height:auto;
  padding:0;
  margin:0;
  border-width: 2px;
  border-style: inset;
  -moz-appearance: menulist;
  -webkit-appearance: menulist;
  appearance: menulist;
}

@keyframes lds-hourglass {
    0% {
        transform: rotate(0);
        animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
    }
    50% {
        transform: rotate(900deg);
        animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    }
    100% {
        transform: rotate(1800deg);
    }
}

  @media (min-width:320px)  { 
    .search-form-mobile{
      width:100%;
    }
  }
  @media (min-width:480px)  { 
    .search-form-mobile{
      width:100%;
    } 
  }
  @media (min-width:600px)  { 
    .search-form-mobile{
      width:100%;
    }
  }
  @media (min-width:801px)  { 
    .search-form-mobile{
      width: 50%;
    }
  }
  @media (min-width:1025px) {  
    .search-form-mobile{
      width:50%;
    }
  }
  @media (min-width:1281px) {
    
  }
</style>
@endsection
@section('content')
@include('sweet::alert')
<section>
  <div class="block gray-bg bottom-padd210 top-padd30">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
          <div class="sec-box">
            <div class="sec-wrapper">
              <div class="row">
                <div class="col-md-3 col-sm-12 col-lg-3">
                  <div class="sidebar left">
                    <div class="widget style2 Search_filters wow fadeIn" data-wow-delay="0.2s">
                      <h4 class="widget-title2 sudo-bg-red" itemprop="headline">Search Filters</h4>
                      <div class="widget-data">
                        <input type="text" placeholder="Enter company" name="companytext" id="companytext" class="input-company">
                        <ul class="company-list">
                          @foreach($company as $row)
                          <?php $dis=''?>
                          @if(!in_array($row->slug, $filter))
                          <?php $dis='li-hidden'?>
                          @endif
                          <li class="company-item {{ $dis }} {{ $row->slug }}" data-name="{{ $row->name }}"
                            @if($row->slug == $slug)
                            style="color:red"
                            @endif
                            >
                            <a href="#" class="sidebarSlug" data-url="{{ URL::TO('sidebar')}}/{{ $row->slug }}" data-id="{{$row->slug}}" title="" itemprop="url">{{ ucfirst($row->name) }}</a>
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-md-9 col-sm-12 col-lg-9">
                  <form class="search-frm search-form-mobile" id="searchForm">
                    @csrf
                    <input type="text" name="slug"  value="<?php if($slug!="" || $slug!= null)echo $slug; else echo "notdefine"; ?>" hidden>
                    <input type="text" placeholder="Enter zipcode or address" name="filter">
                    <button class="red-bg" type="submit"><i class="fa fa-search"></i></button>
                  </form>

                  <div class="title2-wrapper statusmsg">
                    @if(@session('status'))
                    <h3 class="msg">{{ @session('status') }}</h3>
                    @endif
                  </div>

                  {{--<div class="row store-list">
                    @if(count($store) == 0)
                    <div class="col-md-12" ><h3 align="center">No stores available in your area</h3></div>
                    @endif
                    @foreach($store  as $row)
                    <div class="col-md-6 col-sm-6 col-lg-6 store-box">
                      <div class="featured-restaurant-box with-bg style2 brd-rd12 wow fadeIn" data-wow-delay="0.1s">
                        <div class="featured-restaurant-thumb">
                          <a href="/store/{{ $row->slug}}" title="" itemprop="url"><img data-src="{{ asset('adminAssets/franchiseLogo/'.$row->company->logo)}}" class="lazy" alt="company logo" itemprop="image"></a>
                        </div>
                        <div class="featured-restaurant-info">
                          <span class="red-clr">{{ ucfirst($row->address) }}</span>
                          <h4 itemprop="headline"><a href="/store/{{ $row->slug }}" title="" itemprop="url">{{ucfirst($row->name)}}</a></h4>
                          <div class="row">
                            @foreach($row->products as $prd)
                            @if($loop->iteration>3)
                            @break;
                            @endif
                            <div class="col-md-4">
                              <div> <img data-src="{{ asset('pizzaImage/'.$prd->pizzaImage) }}" class="lazy" style="height:50px;width: 50px"></div>
                              <div class="food-types" style="font-size:9px">{{ ucfirst($prd->name) }}</div>
                            </div>
                            @endforeach
                          </div>
                          <a class="brd-rd30" href="/store/{{ $row->slug }}" title="Order Online"><i class="fa fa-angle-double-right"></i> Order Online</a>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>--}}
                  
                  
                    <div class="row store-list">
                      
                     
                    </div>

                </div>
              </div>
            </div>
            {{-- <div class="btnload">
              @if(count($store)<$totalStore)
              <div class="row btnloadrow">
                <div class="col-md-12" align="center">
                  <button class="load-more  red-bg btn-lg" data-totalRes="{{ $totalStore }}">Load more</button>
                </div>
              </div>
              @endif
            </div> --}}
          </div>
        </div>
      </div>
    </div>
  </div>

  @if(Request::segment(1)=='order-without-login')
    <form class="modal multi-step" id="detailModal" method="post" enctype="multipart/form-data" data-backdrop="static" data-keyboard="false">
      @csrf
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" >
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title step-1" data-step="1">Your  preference</h4>
            <h4 class="modal-title step-2" data-step="2">Personal Details</h4>
          </div>

          <div class="modal-body step-1" data-step="1">

            <input type="text" name="slug"  id="slug" value="<?php if($slug!="")echo $slug; else echo "notdefine"; ?>" hidden>

            <div class="form-group">
              <label for="pizzaStore"><u>Pizza Franchise</u>(Max 3)</label>
              
                <select data-placeholder="Choose your favourite stores" multiple class="selectpicker form-control" name="pizzaStore[]"   id="pizzaStore" >
                  @foreach($company as $row)
                  <option value="{{ $row->id }}" >{{ $row->name }}</option>
                  @endforeach
                </select>
              <label id="storeResult" class="errMsg"></label>
            </div>
            
            <div class="form-group">
              <label for="pizzaSize"><u>Pizza Size</u></label>
              <div class="" id="pizzaSize">
                <div class="d-flex">
                  @foreach($sizes as $size)
                    <div class="form-check"> 
                      <input class="form-check-input pizzaSize" type="checkbox" name="pizzaSize" id="pizzaSize{{$size->idsize}}" value="{{$size->pizzaSize}}">
                    <label class="form-check-label" for="pizzaSize{{$size->idsize}}">
                      {{$size->pizzaSize}}
                    </label>
                    </div>
                  @endforeach
                </div>
              </div>
              <label id="sizeResult" class="errMsg"></label>
            </div>
            
            <div class="form-group">
              <label for="topping"><u>Toppings</u></label>
              <div class="" id="topping">
                <div class="d-flex">
                  @foreach($toppings as $topping)
                    <div class="form-check">
                    @if($topping->idtoppings==1)
                      <input class="form-check-input topping" type="checkbox" name="topping" id="topping{{$topping->idtoppings}}" value="{{$topping->toppings}}" checked>
                    @else
                      <input class="form-check-input topping" type="checkbox" name="topping" id="topping{{$topping->idtoppings}}" value="{{$topping->toppings}}">
                    @endif
                      <label class="form-check-label" for="topping1">
                        {{$topping->toppings}}
                      </label>
                    </div>
                  @endforeach
                </div>
              </div>
              <label id="toppingResult" class="errMsg"></label>
            </div>

            <div class="form-group">
              <label for="deliveryMethod"><u>Delivery methods</u></label>
              <div class="d-flex">
                <div class="form-check">
                  <input class="form-check-input deliveryMethod pickup" type="checkbox" name="deliveryMethod" id="deliveryMethodpickup" value="pickup">
                  <label class="form-check-label" for="deliveryMethodpickup">
                    Pickup
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input deliveryMethod delivery" type="checkbox" name="deliveryMethod" id="deliveryMethoddelivery" value="delivery">
                  <label class="form-check-label" for="deliveryMethoddelivery">
                    Delivery
                  </label>
                </div>
              </div>
              <label id="delResult" class="errMsg"></label>
            </div>
          </div>
          
          
          <div class="form-group" style="padding:0 2%;">
            <label>Location/Zip</label>
            <input class="form-control" name="location" id="location" placeholder="e.g toronto" required/>
            <label id="locResult" class="errMsg"></label>
          </div>
          

          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Finish</button>
          </div>
        </div>
      </div>
    </form>
  @endif

<!--   <div style="display: none;"  class="modal-dialog" id="prefModal">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Your  preference</h4>
    </div>
    <div class="modal-body">
      <form method="post" action="" id="searchfilter">
        <div class="form-group selstore">
          <label for="pizzaStore">Pizza Store</label>
          <div class="">
            <select data-placeholder="Choose your favourite 3 stores" multiple class="form-control chosen-select"  name="pizzaStore[]"   id="pizzaStore">
              @foreach($company as $row)
              <option value="{{ $row->id }}" >{{ ucfirst($row->name) }}</option>
              @endforeach
            </select>
          </div>
          <label id="storeResult" class="errMsg"></label>
        </div>
        <div class="form-group selpref">
          <label for="pizzaPref">Pizza Preference</label>
          <div class="">
            <select class="form-control"  data-placeholder="Choose a Pizza type" multiple  name="pizzaPref[]"   id="pizzaPref">
              @foreach($cate as $row)
              <option value="{{ $row->id }}">{{ $row->category }}</option>
              @endforeach
            </select>
          </div>
          <label id="prefResult" class="errMsg"></label>
        </div>
        <div class="form-group selsize">
          <label for="pizzaSize">Pizza Size</label>
          <div class="">
            <select class="form-control" name="pizzaSize"   id="pizzaSize">
              <option value="">Select size</option>
              <option value="0">Small</option>
              <option value="1">Medium</option>
              <option value="2">Large</option>
              <option value="3">Extra large</option>
            </select>
          </div>
          <label id="sizeResult" class="errMsg"></label>
        </div>
        <div class="form-group seldel">
          <label for="deliveryMethod">Delivery methods</label>
          <select class="form-control" name="deliveryMethod" id="deliveryMethod">
            <option value="">Select delivery method</option>
            <option value="delivery">Delivery </option>
            <optgroup label="Delivery Service">
              <option value="ubereats">Ubereats </option>
              <option value="postmates">Postmates </option>
              <option value="grubhub">Grubhub </option>
              <option value="doordash">Doordash</option>
            </optgroup>
            <option value="pickup">Pickup</option>
            <option value="delivery">Eat-In</option>
          </select>
          <label id="delResult" class="errMsg"></label>
        </div>
        <label>Do you Like Buffet</label>
        <div class="form-control">
          <input  type="radio" name="buffet" value="0" >NO
          <input  type="radio" name="buffet" value="1" checked="true">YES
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="finish" style="background-color: green">Save</button>
        </div>
      </form>
    </div>
  </div>
</div> -->
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('adminAssets/js/jquery.validate.min.js')}}"></script>
@if(Auth::user())

<script type="text/javascript">

  $(document).ready(function(){
    $(function () {
      var loading = '<div class="lds-hourglass" style="text-align:center"> Loading...</div>';
      $(".store-list").html(loading);
      
      $.ajax({
        url:"{{ route('store.preference') }}",
        type:"post",
        data:{_token: "{{ csrf_token() }}"},
        dataType:'json',
        success:function(data)
        {
          console.log(data)
          $(".store-list").html(data);
        },
        error: function (data) {
          var error = '<div style="text-align:center"> Error Occured!!!!</div>';
          $(".store-list").html(error);
        },
      })    
    });
  })
</script> 

@endif

<script type="text/javascript">
  $(document).ready(function(){
    
    $('.pizzaSize').click(function() {
      if($(this).prop('checked'))
      {
        $('.pizzaSize').not(this).prop('checked', false);
      }
      else {
        $(this).prop('checked', true)
      }
    });

    $('.topping').click(function() {
      if($(this).prop('checked'))
      {
        $('.topping').not(this).prop('checked', false);
      }
      else {
        $(this).prop('checked', true)
      }
    });

    $('.deliveryMethod').click(function() {
      if($(this).prop('checked'))
      {
        $('.deliveryMethod').not(this).prop('checked', false);
      }
      else {
        $(this).prop('checked', true)
      }
    });

    $('.msg').fadeIn().delay(5000).fadeOut();
    var slug = "<?php if($slug!="")echo $slug; else echo "notdefine"; ?>";
    $(document).on('click','.load-more',function(){

      var filter = $("#searchForm input[name=filter]").val();

      var _totalres = $('.store-box').length;

      var main_site="{{ url('/') }}";

      $.ajax({
        url:main_site+'/store-load-more',
        type:"post",
        dataType:"json",
        data:{
          "_token": "{{ csrf_token() }}",
          skip:_totalres,
          latitude:window.latitude,
          longitude:window.longitude,
          slug:slug,
          filter:filter
        },
        beforeSend:function(){
          $('.load-more').html('<i class="fa fa-refresh fa-spin"></i> loading..');
        },
        success:function(response)
        {
          var _html = '';
          var img = "{{ asset('pizzaImage') }}/";
          var cimg = "{{ asset('adminAssets/franchiseLogo') }}/";
          $.each(response,function(index,value){
            _html += '<div class="col-md-6 col-sm-6 col-lg-6 store-box">';
            _html += '<div class="featured-restaurant-box with-bg style2 brd-rd12 wow fadeIn" data-wow-delay="0.1s">';
            _html += '<div class="featured-restaurant-thumb">';
            _html += '<a href="" title="" itemprop="url"><img src="'+cimg+value.company.logo+'" alt="company logo" itemprop="image"></a>';
            _html += '</div>';
            _html += '<div class="featured-restaurant-info">';
            _html += '<span class="red-clr">'+value.address+'</span>';
            _html += ' <h4 itemprop="headline"><a href="store/'+value.slug+'" title="" itemprop="url">'+value.name+'</a></h4>';
            _html += '<div class="row">';
            $.each(value.products,function(index,value){
              _html += '<div class="col-md-4">';
              _html += '<div>';
              _html += '<img src="'+img+value.pizzaImage+'" style="height:50px;width: 50px"></div>';
              _html += '<div class="food-types" style="font-size:9px">'+value.name+'</div>';
              _html += '</div>';
            });
            _html += '</div>';
            _html += '<a class="brd-rd30" href="/store/{{ $row->slug }}" title="Order Online"><i class="fa fa-angle-double-right"></i> Order Online</a>';
            _html += '</div> </div> </div>';
          });
          $(".store-list").append(_html);
          var _totalres = $('.store-box').length;
          var tbres = parseInt($(".load-more").attr('data-totalRes'));
          if(_totalres == tbres)
          {

            $(".load-more").remove();
          }
          else
          {
            $(".load-more").html('Load more');
          }
        }
      });

    });

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#searchForm').submit(function(e){
      e.preventDefault();
      var loading = '<div class="lds-hourglass" style="text-align: center"> Loading...</div>';
      $(".store-list").html(loading);
    }).validate({
      errorElement : 'span',
      errorClass:"errMsg",
      rules:{
        filter:"required"
      },
      messages:{
        filter:"Please enter zip code or address"
      },
      submitHandler:function(form){

       

        var formdata = new FormData(form);
        var getForm = $('#searchForm').serializeArray()
    
        var existing = localStorage.getItem('detail');
        var temp = getForm.filter(x => x.name == "filter")
        // var location = '';
        // $.each(temp, (key, value) => {
        //   location = value.value
        // })

        // existing = existing ? JSON.parse(existing) : {};

        // existing['location'] = location;
        // localStorage.setItem('detail', JSON.stringify(existing));


    

        // formdata.append('localStorage', localStorage.getItem('detail'))

        $.ajax({
          url:"{{ route('store.search') }}",
          type:"post",
          data: formdata,
          dataType: "json",
          cache : false,
          processData: false,
          contentType:false,
          success:function(data)
          {
            $(".store-list").html(data);

          },
          error: function (data) {
            toastr[data.status](data.message,data.status);
          },

        })
      }
    })


    
    $('.sidebarSlug').click(function(e) {
      e.preventDefault();
                
      var url = $(this).data('url');
      var slug = $(this).data('id');

      var loading = '<div class="lds-hourglass" style="text-align: center"> Loading...</div>';
      $(".store-list").html(loading);
      
      $.ajax({
        url:url,
        type:"post",
        data:{slug:slug, _token: "{{ csrf_token() }}"},
        dataType:'json',
        success:function(data)
        {
          
          $(".store-list").html(data);
        },
        error: function (data) {
          var error = '<div style="text-align: center"> Error Occured!!!!</div>';
          $(".store-list").html(error);
        },
      })            
    });





//company search

$('#companytext').keyup(function(){
  var input = $(this).val().toLowerCase();
  var maxres = 10;
  if(input == '' || input == null)
  {
    $('.company-list>li').not('.li-hidden').show();
    $('.company-list>li.li-hidden').hide();
    return false;
  }
  if(input.length > 2)
  {
    var cnt=0;
    $('.company-list>li').each(function(){

      var text = $(this).data('name').toLowerCase();
      if(text.indexOf(input)>-1)
      {
        if(cnt>=maxres)
        {
          return false;
        }
        else
        {
          cnt++;
          $(this).show();
        }

      }
      else
      {
        $(this).hide();
      }
    });
  }

})



});
</script>

<script type="text/javascript">
  var islogin = '{!! $isLogin !!}';
  sendEvent = function(sel, step) {
    var sel_event = new CustomEvent('next.m.' + step, {detail: {step: step}});
    window.dispatchEvent(sel_event);
  }
  $(document).ready(function(){
    function getLocation()
    {
      if(navigator.geolocation)
      {
        navigator.geolocation.getCurrentPosition(showPosition);
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

        }
      })
    }
    if(islogin == false)
    {
      if(localStorage.getItem('detail') == null)
      {
        $("#detailModal").modal('show');
        $("#detailModal").modal({
          backdrop: 'static',
          keyboard: false
        });

        $(document).on('submit','#detailModal',function(e)
        {
          e.preventDefault();
          iflag = true;

          var formData = $('#detailModal').serializeArray()

          if(formData.filter(x => x.name == "pizzaSize").length < 1)
          {
            $('#sizeResult').html("Please select your favourite pizza size");
            iflag = false;
          }
          else {
            $('#sizeResult').html("");
          }


          if(formData.filter(x => x.name == "topping").length < 1)
          {
            $('#toppingResult').html("Please select your topping");
            iflag = false;
          }
          else {
            $('#toppingResult').html("");
          }


          if(formData.filter(x => x.name == "pizzaStore[]").length < 1)
          {
            $('#storeResult').html("Please select your favourite pizza store");
            iflag = false;
          }
          else {
            $('#storeResult').html("");
          }


          if(formData.filter(x => x.name == "deliveryMethod").length < 1)
          {
            $('#delResult').html("Please select delivery method ");
            iflag = false;
          }
          else {
            $('#delResult').html("");
          }

          if(formData.filter(x => x.name == "location").length < 1)
          {
            $('#locResult').html("Please fill your address field ");
            iflag = false;
          }
          else {
            $('#locResult').html("");
          }

          if(iflag)
          {

            var temp = formData.filter(x => x.name == "pizzaSize")
            var pizzaSize = ''
            $.each(temp, (key, value) => {
              pizzaSize = value.value
            })

            var temp = formData.filter(x => x.name == "topping")
            var topping = ''
            $.each(temp, (key, value) => {
              topping = value.value
            })

            var temp = formData.filter(x => x.name == "pizzaStore[]")
            var pizzaStore = []
            $.each(temp, (key, value) => {
              pizzaStore.push(value.value)
            })

            var temp = formData.filter(x => x.name == "deliveryMethod")
            var deliveryMethod = ''
            $.each(temp, (key, value) => {
              deliveryMethod = value.value
            })

            var temp = formData.filter(x=>x.name == "location")
            var address = ''
            $.each(temp, (key, value) => {
              address = value.value
            })

            var data = {
             
              'pizzaSize':pizzaSize,
              'pizzaStore':pizzaStore,
              'deliveryMethod':deliveryMethod,
              'topping':topping,
              'location':address
            };
            console.log(pizzaStore);

            // getLocation();
            // var detail=JSON.stringify(data);
            // localStorage.setItem('detail', detail);
            $('#detailModal').modal('toggle');
            if($(location).attr('href').includes('order-without-login'))
            {
              $("#detailModal").modal('hide');
              var info = JSON.stringify(data);
              var loading = '<div class="lds-hourglass" style="text-align: center"> Loading...</div>';
              $(".store-list").html(loading);
              
              $.ajax({
                url:"{{ route('store.preference') }}",
                type:"post",
                data:{data:info, from: 'wihtoutLogin', _token: "{{ csrf_token() }}"},
                dataType:'json',
                success:function(data)
                {
                  console.log(data)
                  $(".store-list").html(data);
                },
                error: function (data) {
                  var error = '<div style="text-align: center"> Error Occured!!!!</div>';
                  $(".store-list").html(error);
                },
              })
            }
            
          }
        })
      }
      else
      {
          //alert("its here");
        // if($(location).attr('href').includes('order-wihtout-login'))
        // {
        //   $("#detailModal").modal('hide');
        //   var info = localStorage.getItem('detail');
         

        //   $.ajax({
        //     url:"{{ route('store.preference') }}",
        //     type:"post",
        //     data:{data:localStorage.getItem('detail'), from: 'wihtoutLogin', _token: "{{ csrf_token() }}"},
        //     dataType:'json',
        //     success:function(data)
        //     {
        //       console.log(data)
        //       $(".store-list").html(data);
        //     },
        //     error: function (data) {
        //       console.log(data.message);
        //     },
        //   })
        // }
      }
    }
    else
    {
      localStorage.clear();
    }
  })
</script>
@endsection
