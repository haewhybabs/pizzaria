@extends('layouts.user.minimal')
@section('css')
<link rel="stylesheet" href="{{ asset('userAssets/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('userAssets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('userAssets/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('userAssets/css/red-color.css')}}">
    <link rel="stylesheet" href="{{ asset('userAssets/css/yellow-color.css')}}">
    <link rel="stylesheet" href="{{ asset('userAssets/css/responsive.css')}}">
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
    .bgimg{
        background-position: center; 
        background-repeat: no-repeat;
        background-size: cover;
    }
    </style>
    
 @endsection   
</head>
@section('content')
    <main>
        <section>

            <div class="block">
                 @if(session()->has('success'))
                 <div class="col-md-12" align="center" >
                    <div class="alert alert-success msg">
                        <div align="center" >{{ session()->get('success') }}</div>
                    </div>
                </div>
                @endif
                 @if(session()->has('storeError'))
                 <div class="col-md-12" align="center" >
                    <div class="alert alert-danger msg">
                        <div align="center">{{ session()->get('storeError') }}</div>
                    </div>
                </div>
                @endif
                <div style="background-image: url({{ asset('userAssets/images/topbg.jpg') }});" class="fixed-bg full-height bgimg"></div>

                <div class="coming-soon-wrapper text-center">

 
                    <div class="coming-soon-inner">
                        <!-- <div class="logo"> -->
                            <h2 itemprop="headline" class="logotext">
                                Pizza Pizzaria
                            </h2>
                        <!--  </div> -->
                        <span class="yellow-clr">WE'RE WORKING ON SOMTHING NEW!</span>
                        <h1 itemprop="headline" class="wow flash" data-wow-delay="0.2s">Coming Soon</h1>
                        <a class="brd-rd2 yellow-bg addstore" href="/add-store" title="" itemprop="url"><i class="fa fa-home"></i> ADD STORE</a>
                        <div class="follow-us">
                            <span>Will be available on :</span>
                            <img src="{{ asset('userAssets/images/appstore.png') }}" width="5%">
                            <img src="{{ asset('userAssets/images/playstore.png') }}" width="5%" style="padding-left: 10px">
                        </div>
                       
                    </div>
                </div><!-- Coming Soon Wrapper -->
            </div>
        </section>
    </main>
@endsection
@section('js')
    <script type="text/javascript">
        $('.msg').fadeIn().delay(3000).fadeOut();
    </script>
@endsection
