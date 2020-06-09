@extends('layouts.user.minimal')
@section('css')
<link rel="stylesheet" href="{{ asset('userAssets/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('userAssets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('userAssets/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('userAssets/css/red-color.css')}}">
    <link rel="stylesheet" href="{{ asset('userAssets/css/yellow-color.css')}}">
    <link rel="stylesheet" href="{{ asset('userAssets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('userAssets/css/bootstrap-datetimepicker.css')}}">
    <link href="{{ asset('adminAssets/css/switchery.min.css') }}" rel="stylesheet">

   

    <style type="text/css">

    .logotext{
        font-size:48px;
        color:white;
    }
    .addstore{
        display: inline-block;
        font-family: Poppins;
        font-weight: 700;
        font-size: 12px;
        color: #171616;
        border: 2px solid;
        padding: 15px 40px;
        margin-top: 18px;
    }
    .addstore:hover{
        color: #ffbe00;
        background-color: transparent;
    }
     label.errMsg {
        color:red;
        font-size: 14px;
    }
    .restaurant-info-form input
    {
        float: left;
        width: 100%;
        margin-bottom: 17px;
        font-size: 11px;
        color: #888;
        font-family: lato;
        height: 32px;
        padding: 10px 18px;
    }
    </style>
    
 @endsection   
@section('content')
<main>
    <section>
        <div class="block top-padd30 gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-1 col-sm-12 col-lg-1"></div>
                    <div class="col-md-10 col-sm-12 col-lg-10">
                        <h2 align="center" itemprop="headline">Add your store</h2>
                        <form class="restaurant-info-form brd-rd5" id="addStore" action="{{ route('addstore.add') }}" method="post">
                            @csrf
                            <div class="row mrg20">
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <label>Store name </label>
                                    <input class="brd-rd3" type="text" name="sname">
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <label>Store Phone </label>
                                    <input class="brd-rd3" type="text" name="sphone">
                                </div>
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <label>Company name </label>
                                    <div class="select-wrp">
                                        <select name="companyid">
                                            <option value="">select company</option>
                                            @foreach($company as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <h4 itemprop="headline">LOCATION</h4>
                                </div>
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <label>Address </label>
                                    <textarea class="brd-rd3" name="sadd"></textarea>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <label> Street </label>
                                    <input class="brd-rd3" type="text" name="street">
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <label> County </label>
                                    <input class="brd-rd3" type="text" name="county">
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <label>Country </label>
                                    <div class="select-wrp">
                                        <select name="country">
                                            <option value="">select country</option>
                                            <option value="usa">USA</option>
                                            <option value="canada">Canada</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <label>State </label>
                                    <input class="brd-rd3" type="text" name="state">
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <label>City </label>
                                     <input class="brd-rd3" type="text" name="city">
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <label>Zip code </label>
                                    <input class="brd-rd3" type="text" name="zipcode">
                                </div>
                                <!-- <div class="col-md-12 col-sm-12 col-lg-12">
                                    <label>Store url </label>
                                    <input class="brd-rd3" type="text" name="url">
                                </div> -->
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <h4 itemprop="headline">TIMING DETAILS</h4>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <label>Monday&nbsp&nbsp&nbsp<input type="checkbox" name="monday" class="js-switch" data-id="t1"  checked></label>
                                     
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                             <input class="brd-rd3 start t1 timefield" type="text" name="t1start[]"  >
                                        </div>
                                        <div class="col-md-6">
                                             <input class="brd-rd3 end t1 timefield" type="text" name="t1end[]"   >
                                        </div>
                                        
                                    </div>
                                </div>
                                 <div  class="col-md-6 col-sm-6 col-lg-6">
                                    <label>Tuseday&nbsp&nbsp&nbsp<input type="checkbox" name="monday" class="js-switch" data-id="t2" checked></label>
                                     
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                             <input class="brd-rd3  start t2 timefield" type="text" name="t2start[]"  >
                                        </div>
                                        <div class="col-md-6">
                                             <input class="brd-rd3 end t2 timefield" type="text" name="t2end[]"  >
                                        </div>
                                    </div>
                                </div>
                                 <div  class="col-md-6 col-sm-6 col-lg-6">
                                    <label>wednesday&nbsp&nbsp&nbsp<input type="checkbox" name="" class="js-switch" data-id="t3" checked></label>
                                     
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                             <input class="brd-rd3 start t3 timefield" type="text" name="t3start[]" >
                                        </div>
                                        <div class="col-md-6">
                                             <input class="brd-rd3 end t3 timefield" type="text" name="t3end[]"  >
                                        </div>
                                    </div>
                                </div>
                                 <div  class="col-md-6 col-sm-6 col-lg-6">
                                    <label>Thursday&nbsp&nbsp&nbsp<input type="checkbox" name="" class="js-switch" data-id="t4" checked></label>
                                     
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                             <input class="brd-rd3 start t4 timefield" type="text" name="t4start[]"  >
                                        </div>
                                        <div class="col-md-6">
                                             <input class="brd-rd3 end t4 timefield" type="text" name="t4end[]"  >
                                        </div>
                                    </div>
                                </div>
                                 <div  class="col-md-6 col-sm-6 col-lg-6">
                                    <label>Friday&nbsp&nbsp&nbsp<input type="checkbox" name="" class="js-switch" data-id="t5" checked></label>
                                     
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                             <input class="brd-rd3 start t5 timefield" type="text" name="t5start[]"  >
                                        </div>
                                        <div class="col-md-6">
                                             <input class="brd-rd3 end t5 timefield" type="text" name="t5end[]"  >
                                        </div>
                                    </div>
                                </div>
                                 <div  class="col-md-6 col-sm-6 col-lg-6">
                                    <label>Saturday&nbsp&nbsp&nbsp<input type="checkbox" name="" class="js-switch" data-id="t6 " checked></label>
                                     
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                             <input class="brd-rd3 start t6 timefield" type="text" name="t6start[]"  >
                                        </div>
                                        <div class="col-md-6">
                                             <input class="brd-rd3 end t6 timefield" type="text" name="t6end[]"  >
                                        </div>
                                    </div>
                                </div>
                                <div  class="col-md-6 col-sm-6 col-lg-6">
                                    <label>Sunday&nbsp&nbsp&nbsp<input type="checkbox" name="" class="js-switch" data-id="t7" checked></label>
                                     
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                             <input class="brd-rd3 start t7 timefield" type="text" name="t7start[]"  >
                                        </div>
                                        <div class="col-md-6">
                                             <input class="brd-rd3 end t7 timefield" type="text" name="t7end[]"  >
                                        </div>
                                    </div>
                                </div>
                                <div  class="col-md-12 col-sm-12 col-lg-12">
                                    <h4 itemprop="headline">PERSONAL DETAILS</h4>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <label>Name </label>
                                    <input class="brd-rd3" type="text" name="uname">
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <label>Email </label>
                                    <input class="brd-rd3" type="email" name="uemail">
                                </div>
                                <div  class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="step-buttons">
                                        <button class="brd-rd3 red-bg" type="submit" itemprop="url">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@section('js')
    <script type="text/javascript" src="{{ asset('adminAssets/js/jquery.validate.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('adminAssets/js/additional-methods.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('adminAssets/js/moment.min.js')}}"></script>
  <script src="{{ asset('adminAssets/js/switchery.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('adminAssets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

        $('.start').val('09:00 AM');
        $('.end').val('06:00 PM');
            $('.timefield').datetimepicker({
               format: 'hh:mm A'
            });
        var a = Array.prototype.slice.call(document.querySelectorAll(".js-switch"));
        a.forEach(function(a) {
            new Switchery(a,{
                color: "#26B99A",
                 size:'small',
            })
         });

        $('.js-switch').click(function(){

            var id = $(this).data('id');

            //alert($('#'+id).is(':hidden'));
            
            var  dis= $('.'+id).prop('disabled');
            //alert(dis);
            if(dis)
            {
                $('.'+id).prop('disabled',false);
            }
            else
            {
                $('.'+id).prop('disabled',true);
            }
        });




        })
    </script>



    <script type="text/javascript">

        $('#addStore').validate({
            errorClass: "errMsg",
            rules:{
                sname:"required",
                sphone:{
                    required:true,
                    number:true,
                    remote:{
                        url:"{{ route('addstore.checkphone')}}",
                        type:"post",
                        data:{
                                "_token": "{{ csrf_token() }}",
                                phone:function(){
                                    return $('#addStore :input[name="sphone"]').val();
                                  }
                            }
                    }
                },
                companyid:"required",
                sadd:"required",
                street:"required",
                county:"required",
                country:"required",
                state:"required",
                city:"required",
                zipcode:"required",
                //url:"required",
                uname:"required",
                uemail:"required"
            },
            messages:{
                sname:"Please enter store name",
                sphone:{
                    required:"Please enter store contact no",
                    number:"Phone number should be in digit",
                    remote:"This number is used please use antoher number"
                },
                companyid:"Please select the company",
                sadd:"Please enter address",
                street:"Please enter street",
                county:"Please enter county",
                country:"Please select the company",
                state:"Please enter state",
                city:"Please enter city",
                zipcode:"Please enter zipcode",
                //url:"Please enter url",
                uname:"Please enter your name",
                uemail:"Please enter your email"

            },
            submitHandler:function(form)
            {
                form.submit();
            }
        })
    </script>
@endsection
    