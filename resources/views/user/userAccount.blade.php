@extends('layouts.user.app')
@section('css')
<link href="{{ asset('adminAssets/css/dropify.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<style type="text/css">
  input.rd{
    height:auto;
  }
  .radio-inline+.radio-inline {
    margin-top: 0;
    margin-left: 0;
  }
  .btnUpdate{
    margin-top: 20px;
  }
  .change-password{
    padding:34px;
  }
  .password-panel{
    margin-top:27px;
  }
  .user-info > img {
    border-color: red;
    float: none;
    margin-right: 0px;
    margin-bottom: 20px;
  }
  .user-info-inner a{
    color: black;
  } 
  .user-info-inner a:focus, .user-info-inner a:hover {
    color: red;
  }
  .user-info-inner {
    display: contents;
  }
  .user-info {
    text-align: center;
    padding-bottom: 0px;
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
</style>
@endsection
@section('content')


<section>
  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">User Profile</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4 col-sm-12 col-lg-4">
            <div class="profile-sidebar brd-rd5 wow fadeIn" data-wow-delay="0.2s">
              <div class="profile-sidebar-inner brd-rd5">
                <div class="user-info">
                  @if($user->imgname)
                  <img class="brd-rd50" src="{{asset('userAssets/userImage/'.$user->imgname)}}" style="height:76px;width: 76px">
                  @else
                  <img class="brd-rd50" src="{{asset('userAssets/userImage/user.png')}}" style="height:76px;width: 76px">
                  @endif
                  <div class="user-info-inner">
                    <h5 itemprop="headline"><a href="#" title="" itemprop="url">{{ $user->name }}</a></h5>
                    <span><a href="#" title="" itemprop="url">{{ $user->email }}</a></span>
                  </div>

                </div>
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#account-settings" data-toggle="tab"><i class="fa fa-cog"></i> ACCOUNT SETTINGS</a></li>
                  <li ><a href="#change-password" data-toggle="tab"><i class="fa fa-cog"></i> CHANGE PASSWORD</a></li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-md-8 col-sm-12 col-lg-8">
            <div style="text-align:center;">
              <h4 itemprop="headline">ACCOUNT SETTINGS</h4>
            </div>

            <div class="">
              <form class="" method="post" enctype="multipart/form-data" id="upForm" action="{{ route('profile.update') }}">
                @csrf
                <div hidden="true">
                  <input type="text" name="id" value="{{ $user->id }}">
                </div>
                <div class="row mrg20">
                  <div class="form-group col-md-12 col-sm-12 col-lg-12">
                    <label>Complete Name </label>
                    <input type="text" class="form-control" placeholder="Enter Your Name" name="name" value="{{ $user->name}}">
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-lg-12">
                    <label>Email Address </label>
                    <input class="form-control" type="email" placeholder="Enter Your Email Address" value="{{ $user->email}}" name="email"  readonly="true">
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-lg-12">
                    <label>Phone No </label>
                    <input class="form-control" type="text" placeholder="Enter Your Phone No" name="phone" value="{{ $user->phone}}">
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-lg-12">
                    <label>Address </label>
                    <textarea class="form-control" name="address">{{ $user->address }}</textarea>
                  </div>
                  <div class="form-group col-md-6 col-sm-6 col-lg-6">
                    <label>Country </label>
                    <input class="form-control" type="text" value="{{ $user->country }}" name="country">
                  </div>
                  <div class="form-group col-md-6 col-sm-6 col-lg-6">
                    <label>State </label>
                    <input class="form-control" type="text" value="{{ $user->state }}" name="state">
                  </div>
                  <div class="form-group col-md-6 col-sm-6 col-lg-6">
                    <label>City </label>
                    <input class="form-control" type="text" value="{{ $user->city }}" name="city">
                  </div>

                  <div class="form-group col-md-6 col-sm-6 col-lg-6">
                    <label>Zip Code</label>
                    <input class="form-control" type="text" value="{{ $user->zip_code }}" name="zip_code">
                  </div>


                  <div class="form-group col-md-6 col-sm-6 col-lg-6">
                    <label for="deliveryMethod"><u>Delivery methods</u></label>
                    <div class="d-flex">
                      @if($userPref)
                        <div class="form-check">
                          @if($userPref->delivery_method=="pickup")  
                            <input class="form-check-input deliveryMethod pickup" type="checkbox" name="deliveryMethod" id="deliveryMethodpickup" value="pickup" checked>
                          @else
                            <input class="form-check-input deliveryMethod pickup" type="checkbox" name="deliveryMethod" id="deliveryMethodpickup" value="pickup">
                          @endif
                          <label class="form-check-label" for="deliveryMethodpickup">
                            Pickup
                          </label>
                        </div>
                        <div class="form-check">
                          @if($userPref->delivery_method=="delivery")  
                            <input class="form-check-input deliveryMethod delivery" type="checkbox" name="deliveryMethod" id="deliveryMethoddelivery" value="delivery" checked>
                          @else
                            <input class="form-check-input deliveryMethod delivery" type="checkbox" name="deliveryMethod" id="deliveryMethoddelivery" value="delivery">
                          @endif
                          <label class="form-check-label" for="deliveryMethoddelivery">
                            Delivery
                          </label>
                        </div>
                      @else
                        

                        <div class="form-check">
                          @if($userPref->delivery_method="delivery")  
                          <input class="form-check-input deliveryMethod delivery" type="checkbox" name="deliveryMethod" id="deliveryMethoddelivery" value="delivery" checked>
                          <label class="form-check-label" for="deliveryMethoddelivery">
                            Delivery
                          </label>
                          @else
                          <input class="form-check-input deliveryMethod delivery" type="checkbox" name="deliveryMethod" id="deliveryMethoddelivery" value="delivery" checked>
                          <label class="form-check-label" for="deliveryMethoddelivery">
                            Delivery
                          </label>
                          @endif

                        </div>
                      @endif
                    </div>
                    <label id="delResult" class="errMsg"></label>
                  </div>
                  
                  {{-- <div class="form-group col-md-12 col-sm-12 col-lg-12">
                    <label>Favourite pizza store </label>
                    <div class="select-wrp">
                      <select name="pizzaStore[]" data-placeholder="Choose a Pizza stores" multiple id="pizzaStore">
                        @foreach($com as $row)
                        <option value="{{ $row->id }}" @if(in_array($row->id,explode(",",$user->fav_com))) selected @endif>{{ $row->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div> --}}

                  <div class="form-group col-md-6 col-sm-6 col-lg-6">
                    <label for="pizzaStore"><u>Pizza Franchise</u>(Max 3)</label>
                    <label>
                      <?php $storeCheck=[];?>
                      @if(count($stores)>0)
                        @foreach($stores as $store)
                          <?php $storeCheck[] =$store->id ?>
                          {{$store->name}},
                        @endforeach
                      @endif
                    </label>
                    
                      <select data-placeholder="Choose your favourite stores" multiple class="selectpicker form-control" name="pizzaStore[]"   id="pizzaStore" >
                        @foreach($com as $row)
                          
                          <option value="{{ $row->id }}" >{{ $row->name }}</option>
                           
                        @endforeach
                      </select>
                    <label id="storeResult" class="errMsg"></label>
                  </div>

                  

                  <div class="form-group col-md-6 col-sm-6 col-lg-6">
                    <label for="topping"><u>Toppings</u></label>
                    <div class="" id="topping">
                      <div class="d-flex">
                        @foreach($toppings as $topping)
                          <div class="form-check">
                          @if($userPref)
                            @if($topping->toppings==$userPref->toppings)
                              <input class="form-check-input topping" type="checkbox" name="topping" id="topping{{$topping->idtoppings}}" value="{{$topping->toppings}}" checked>
                            @else
                              <input class="form-check-input topping" type="checkbox" name="topping" id="topping{{$topping->idtoppings}}" value="{{$topping->toppings}}">
                            @endif
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

                  <div class="form-group col-md-6 col-sm-6 col-lg-6">
                    <label for="pizzaSize"><u>Pizza Size</u></label>
                    <div class="" id="pizzaSize">
                      <div class="d-flex">
                        @foreach($sizes as $size)
                        <div class="form-check">
                          @if($userPref)
                            @if($size->pizzaSize == $userPref->pizzaSize)
                              <input class="form-check-input pizzaSize" type="checkbox" name="pizzaSize" id="pizzaSize{{$size->idsize}}" value="{{$size->pizzaSize}}" checked>
                            @else
                              <input class="form-check-input pizzaSize" type="checkbox" name="pizzaSize" id="pizzaSize{{$size->idsize}}" value="{{$size->pizzaSize}}">
                            @endif
                          @else
                            <input class="form-check-input pizzaSize" type="checkbox" name="pizzaSize" id="pizzaSize{{$size->idsize}}" value="{{$size->pizzaSize}}">
                          @endif
                        
                          <label class="form-check-label" for="pizzaSize{{$size->idsize}}">
                            {{$size->pizzaSize}}
                          </label>
                        </div>
                        @endforeach
                      </div>
                    </div>
                    <label id="sizeResult" class="errMsg"></label>
                  </div>

                  {{-- <div class="col-md-6 col-sm-6 col-lg-6">
                    <label>Favourite pizza size</label>
                    <div class="select-wrp">
                      <select  name="pizzaSize" id="pizzaSize">
                        <option value="0" @if($user->pizza_size == 0) selected @endif>Small</option>
                        <option value="1" @if($user->pizza_size == 1) selected @endif>Medium</option>
                        <option value="2" @if($user->pizza_size == 2) selected @endif>Large</option>
                        <option value="3" @if($user->pizza_size == 3) selected @endif>Extra large</option>
                      </select>
                    </div>
                  </div> --}}

                  <div class="col-md-12 col-sm-12 col-lg-12">
                    <label>Profile Image </label>
                    <input class="brd-rd3 dropify" type="file"  name="uimg" data-allowed-file-extensions="png jpeg jpg" data-default-file="{{asset('userAssets/userImage/'.$user->imgname)}}">
                  </div>
                  <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                    <button class="red-bg brd-rd3 btn-lg btnUpdate" type="submit" style="color:white" >UPDATE PROFILE</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="block less-spacing gray-bg top-padd30">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
          <div class="sec-box">
            <div class="dashboard-tabs-wrapper">
              <div class="row">
                <div class="col-md-4 col-sm-12 col-lg-4">
                  <div class="profile-sidebar brd-rd5 wow fadeIn" data-wow-delay="0.2s">
                    <div class="profile-sidebar-inner brd-rd5">
                      <div class="user-info">
                        @if($user->imgname)
                        <img class="brd-rd50" src="{{asset('userAssets/userImage/'.$user->imgname)}}" style="height:76px;width: 76px">
                        @else
                        <img class="brd-rd50" src="{{asset('userAssets/userImage/user.png')}}" style="height:76px;width: 76px">
                        @endif
                        <div class="user-info-inner">
                          <h5 itemprop="headline"><a href="#" title="" itemprop="url">{{ $user->name }}</a></h5>
                          <span><a href="#" title="" itemprop="url">{{ $user->email }}</a></span>
                        </div>

                      </div>
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#account-settings" data-toggle="tab"><i class="fa fa-cog"></i> ACCOUNT SETTINGS</a></li>
                        <li ><a href="#change-password" data-toggle="tab"><i class="fa fa-cog"></i> CHANGE PASSWORD</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-8 col-sm-12 col-lg-8">
                  <div class="tab-content">
                    <div class="tab-pane fade in active" id="account-settings">
                      <div class="tabs-wrp account-settings brd-rd5">
                        <h4 itemprop="headline">ACCOUNT SETTINGS</h4>
                        <div class="account-settings-inner">
                          <div class="row">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                              <div class="profile-info text-center">
                                <div class="profile-thumb brd-rd50">
                                  @if($user->imgname)
                                  <img  id="profile-display" src="{{asset('userAssets/userImage/'.$user->imgname)}}" >
                                  @else
                                  <img  id="profile-display" src="{{asset('userAssets/userImage/user.png')}}" >
                                  @endif
                                  <div class="user-info-inner">

                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-8 col-sm-8 col-lg-8">
                              <div class="profile-info-form-wrap">
                                <form class="profile-info-form" method="post" enctype="multipart/form-data" id="upForm" action="{{ route('profile.update') }}">
                                  @csrf
                                  <div hidden="true">
                                    <input type="text" name="id" value="{{ $user->id }}">
                                  </div>
                                  <div class="row mrg20">
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                      <label>Complete Name </label>
                                      <input class="brd-rd3" type="text" placeholder="Enter Your Name" name="name" value="{{ $user->name}}">
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                      <label>Email Address </label>
                                      <input class="brd-rd3" type="email" placeholder="Enter Your Email Address" value="{{ $user->email}}" name="email"  readonly="true">
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                      <label>Phone No </label>
                                      <input class="brd-rd3" type="text" placeholder="Enter Your Phone No" name="phone" value="{{ $user->phone}}">
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                      <label>Address </label>
                                      <textarea class="brd-rd3" name="address">{{ $user->address }}</textarea>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                      <label>Country </label>
                                      <input class="brd-rd3" type="text" value="{{ $user->country }}" name="country">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                      <label>State </label>
                                      <input class="brd-rd3" type="text" value="{{ $user->state }}" name="state">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                      <label>City </label>
                                      <input class="brd-rd3" type="text" value="{{ $user->city }}" name="city">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                      <label>Delivery methods </label>
                                      <div class="select-wrp">
                                        <select  name="deliveryMethod" id="deliveryMethod">
                                          <?php $d= $user->delivery_method; ?>
                                          <option value="delivery" @if($d == "delivery") selected @endif>Delivery </option>
                                          <optgroup label="Delivery Service">
                                            <option value="ubereats"  @if($d == "ubereats") selected @endif>Ubereats </option>
                                            <option value="postmates"  @if($d == "postmates") selected @endif>Postmates </option>
                                            <option value="grubhub" @if($d == "grubhub") selected @endif>Grubhub </option>
                                            <option value="doordash" @if($d == "doordash") selected @endif>Doordash</option>
                                          </optgroup>
                                          <option value="pickup" @if($d == "pickup") selected @endif>Pickup</option>
                                          <option value="eatin" @if($d == "eatin") selected @endif>Eat-In</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                      <label>Pizza preference </label>
                                      <div class="select-wrp">
                                        <select name="pizzaType[]" data-placeholder="Choose a Pizza type" multiple >
                                          @foreach($cate as $row)
                                          <option value="{{ $row->id }}" @if(in_array($row->id,explode(",",$user->preference))) selected @endif>{{ $row->category }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                      <label>Favourite pizza store </label>
                                      <div class="select-wrp">
                                        <select name="pizzaStore[]" data-placeholder="Choose a Pizza stores" multiple id="pizzaStore">
                                          @foreach($com as $row)
                                          <option value="{{ $row->id }}" @if(in_array($row->id,explode(",",$user->fav_com))) selected @endif>{{ $row->name }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                      <label>Do you like buffet?</label>

                                      <label class="radio-inline">
                                        <input type="radio" class="rd" name="buffet" value="0" @if($user->buffet == 0) checked @endif>NO
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" class="rd"  name="buffet" value="1" @if($user->buffet == 1) checked @endif>YES
                                      </label>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                      <label>Favourite pizza size</label>
                                      <div class="select-wrp">
                                        <select  name="pizzaSize" id="pizzaSize">
                                          <option value="0" @if($user->pizza_size == 0) selected @endif>Small</option>
                                          <option value="1" @if($user->pizza_size == 1) selected @endif>Medium</option>
                                          <option value="2" @if($user->pizza_size == 2) selected @endif>Large</option>
                                          <option value="3" @if($user->pizza_size == 3) selected @endif>Extra large</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                      <label>Profile Image </label>
                                      <input class="brd-rd3 dropify" type="file"  name="uimg" data-allowed-file-extensions="png jpeg jpg" data-default-file="{{asset('userAssets/userImage/'.$user->imgname)}}">
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                      <button class="red-bg brd-rd3 btn-lg btnUpdate" type="submit" style="color:white" >UPDATE PROFILE</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane " id="change-password">
                     <div class="tabs-wrp change-password brd-rd5">
                       <h4 itemprop="headline">CHANGE PASSWORD</h4>
                       <div class="change-password-inner">
                         <div class="col-md-2 col-sm-4 col-lg-2"></div>
                         <div class="col-md-8 col-sm-8 col-lg-8 password-panel">
                          <form class="profile-info-form" method="post" id="chngPassword" action="{{ route('profile.changePass')}}">
                            @csrf
                            <div class="row mrg20">
                              <div class="col-md-12 col-sm-12 col-lg-12">
                                <label>Old Password</label>
                                <input class="brd-rd3" name="oldpass" id="oldpass" type="password" placeholder="old password" >
                              </div>
                              <div class="col-md-12 col-sm-12 col-lg-12">
                                <label>New Password</label>
                                <input class="brd-rd3" name="newpass" id="newpass" type="password" placeholder="new password" >
                              </div>
                              <div class="col-md-12 col-sm-12 col-lg-12">
                                <label>Confirm password Password</label>
                                <input class="brd-rd3" name="confpass" type="password"  placeholder="confirm password" >
                              </div>
                              <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <button class="red-bg brd-rd3 btn-lg" type="submit" style="color:white" >UPDATE PASSWORD</button>
                              </div>
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
        </div><!-- Section Box -->
      </div>
    </div>
  </div>
</div>
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('adminAssets/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('adminAssets/js/additional-methods.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('adminAssets/js/dropify.min.js')}}"></script>
<script type="text/javascript">
  $(window).on('load',function(){
    $('.dropify').dropify({
      messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error' :'Please select image  file with JPEG JPG OR PNG format',
      }
    });
  })
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(function () {
      $('select').selectpicker();
    });
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
    jQuery.validator.addMethod("checkPizzaStore", function(value, element) {
      return ($('#pizzaStore').val().length > 0) ? true : false
    }, "Please select atleast one pizza store");
    $('#upForm').validate({
      errorClass: "errMsg",
      rules:{
        name:"required",
        email:{
          required:true,
          email:true,
        },
        password:"required",
        password_confirmation:{
          equalTo:'#password'
        },
        zip_code:"required",
        address:"required",
        phone:"required",
        city:"required",
        state:"required",
        country:"required",
        pizzaStore:{
          checkPizzaStore: true,
        },
        pizzaStore:"required",
        pizzaSize:"required",
        topping:'required',
        pizzaType:"required",
        deliveryMethod:"required",
        uimg:{

          extension:"jpg|jpeg|png"
        },

      },
      messages:{
        name:"Please enter name",
        email:{
          required:"Please enter email",
          email:"Please enter valid email"
        },
        password:"Please enter password",
        password_confirmation:{
          equalTo:"confirm password not same",
        },
        address:"Please enter address",
        phone:"Please enter phone number",
        city:"Please enter city",
        state:"Please enter state",
        country:"Please enter country",
        pizzaStore:{
          checkPizzaStore: "Please select your favourite pizza stores",
        },        
        pizzaSize:"Please select your favourite pizza size",
        pizzaType:"Please select your favourite pizza types",
        uimg:{
          required:"Please select image",
          extension:"Image should be JPG JPEG or PNG format"
        }
      },
      submitHandler:function(form)
      {
        form.submit();
      }

    });

    $('#chngPassword').validate({
      errorClass: "errMsg",
      rules:{
        oldpass:{
          required:true,
          remote:{
            url:"{{ route('profile.checkPass') }}",
            type:"post",
            data:{
              "_token": "{{ csrf_token() }}",
              pass:function(){
                return $('#chngPassword :input[name="oldpass"]').val();
              }
            },
          },
        },
        newpass:{
          required:true,
          notEqualTo:"#oldpass",
        },
        confpass:{
          equalTo:"#newpass"
        }
      },
      messages:{
        oldpass:{
          required:"Please enter your current password",
          remote:"Password is incorrect",
        },
        newpass:{
          required:"Please enter new password",
          notEqualTo:"New password must be diffrent than the current one"
        },
        confpass:"confirm password must match with new password"
      },
      submitHandler:function(form)
      {
        form.submit();
      }

    });

  })

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
            var temp = formData.filter(x => x.name == "pizzaPref")
           

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
              'pizzaPref':pizzaPref,
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
            if($(location).attr('href').includes('order-wihtout-login'))
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
</script>
@endsection