
@if(count($franchise)<1)

<div class="col-md-12" ><h3 align="center">No stores available in your area</h3></div>
@else
<?php for($i=0; $i<count($franchise); $i++):?>
    
        
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="sec-box">
                <div class="sec-wrapper">
                    <div class="row">
                        <div class="col-md-2 col-sm-12 col-lg-2"></div>
                        <div class="col-md-8 col-sm-12 col-lg-8">
                            <div class="restaurant-detail-wrapper">
                                <div class="restaurant-detail-info">
                                    <div class="restaurant-detail-thumb">
                                        <img class="logoImage lazy" src="{{ asset('adminAssets/franchiseLogo/'.$franchise[$i]->logo) }}" style="width: 50%" itemprop="image">
                                    </div>
                                    <div class="restaurant-detail-title">
                                        <h1 itemprop="headline">{{$franchise[$i]->name}}</h1>
                                        <div class="info-meta">
                                            
                                            <span><a href="#" title="" itemprop="url">static</a>, <a href="#" title="" itemprop="url">static</a></span>
                                        </div>
                                    </div>
                                    <div class="restaurant-detail-tabs">
                                        <ul class="nav nav-tabs">
                                            
                                            <li><a href="#tab{{$i}}-2" data-toggle="tab"><i class="fa fa-percent"></i>Coupons</a></li>
                                            <li><a href="#tab{{$i}}-3" data-toggle="tab"><i class="fa fa-percent"></i>Sales and Offers</a></li>
                                            <li><a href="#tab{{$i}}-5" data-toggle="tab"><i class="fa fa-info"></i> franchise Info</a></li>
                                        </ul>
                                        <div class="tab-content">
                                           

                                        {{-- Coupons --}}

                                            <div class="tab-pane fade in" id="tab{{$i}}-2">
                                                <div class="dishes-list-wrapper">
                                                    <h4 class="title3" itemprop="headline"><span class="sudo-bottom sudo-bg-red">Coupons</span></h4>
                                                    <ul class="dishes-list">
                                                        {{-- @if($coupons != null) --}}
                                                        <?php for($j=0; $j<count($apiData[$i]['coupon']); $j++){?>
                                                        <li class="wow fadeInUp" data-wow-delay="0.1s">
                                                            <div class="row summary">
                                                                <div class="col-sm-10 description">
                                                                    <div>
                                                                        <h3>{{ $apiData[$i]['coupon'][$j]['discount'] }}</h3>
                                                                    </div>
                                                                    <div>
                                                                        {{ $apiData[$i]['coupon'][$j]['pizzaSummary'] }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2 redirect-div">
                                                                    <div class="button-redirect">
                                                                        <a class="btn btn-primary copyCoupon"  
                                                                            data-code= "{{ $apiData[$i]['coupon'][$j]['couponCode'] }}" 
                                                                            data-url="{{ $apiData[$i]['coupon'][$j]['websiteName'] }}"
                                                                        >
                                                                            Use this coupon
                                                                        </a>
                                                                    </div>
                                                                    <div class="coupons-code">
                                                                        <span>
                                                                            {{ $apiData[$i]['coupon'][$j]['couponCode'] }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php }?>
                                                        {{-- @endif --}}
                                                    </ul>
                                                </div>
                                            </div>

                                            {{-- Sales --}}

                                            <div class="tab-pane fade in" id="tab{{$i}}-3">
                                                <div class="dishes-list-wrapper">
                                                    <h4 class="title3" itemprop="headline"><span class="sudo-bottom sudo-bg-red">Sales and Offers</span></h4>
                                                    <ul class="dishes-list">
                                                        {{-- @if($deals != null) --}}
                                                        <?php for($j=0; $j<count($apiData[$i]['deals']); $j++){?>
                                                        <li class="wow fadeInUp" data-wow-delay="0.1s">
                                                            <div class="row summary">
                                                                <div class="col-sm-10 deal-description">
                                                                    <div>
                                                                        <h3>{{ $apiData[$i]['deals'][$j]['discount'] }}</h3>
                                                                    </div>
                                                                    <div>
                                                                        {{ $apiData[$i]['deals'][$j]['pizzaSummary'] }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2 deal-redirect">
                                                                    <div class=" deal-button">
                                                                        <a class="btn btn-primary" href="{{ $apiData[$i]['deals'][$j]['websiteName'] }}" target="_blank">
                                                                            Use this deal
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php }?>
                                                        {{-- @endif --}}
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
            </div>
        </div>
    </div>
        
   
    <?php endfor;?>

    <script type="text/javascript">
        var lt = "";
        var lg = "";
        $(document).ready(function(){
            $('.copyCoupon').click(function() {
                
                var code = $(this).data('code');
                var url = $(this).data('url');
                
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(code).select();
                document.execCommand("copy");
                $temp.remove();

                Swal.fire({
                    title: 'Coupon code copied to the clipboard',
                    animation: false,
                    customClass: {
                        popup: 'animated slideInDown faster',
                    },
                });

                setTimeout(function(){
                    window.open(url, '_blank');
                }, 2500);
            });
        });
    </script>
@endif
    
