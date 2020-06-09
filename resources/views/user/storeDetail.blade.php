@extends('layouts.user.app')
@section('css')
<style type="text/css">
	.slick-slide{
		padding-bottom: 0px;

	}
	.summary {
		border: 1px solid black;
		margin-bottom: 10px;
	}
	.description {
		padding-bottom: 10px;
	}
	.deal-description{
		padding-bottom: 10px;
		border-right: 1px solid black;
	}
	.button-redirect{
		text-align: center;
		padding: 0px;
		padding-top: 10px;
	}
	.deal-button {
		padding-top: 10px !important;
	}
	.redirect-div{
		border-left: 1px solid black;
		padding: 0px;
		padding-bottom: 10px;
	}
	.deal-redirect {
		padding: 0px;
		text-align: center;
	}
	.coupons-code {
		text-align: center;
		padding: 4px;
		font-size: 17px;
		font-weight: 600;
		color: white;
		background: #00000061;
		width: 120px;
		margin: auto;
		margin-top: 15px;
	}
	.coupons-code span{
		word-wrap: break-word;
	}
</style>
@endsection
@section('content')

<section>
	<div class="block gray-bg top-padd30">
		<div class="container">
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
												<img class="logoImage lazy" data-src="{{ asset('adminAssets/franchiseLogo/'.$franchiseRow->logo) }}" style="width: 50%" itemprop="image">
											</div>
											<div class="restaurant-detail-title">
												<h1 itemprop="headline">{{$franchiseRow->name}}</h1>
												<div class="info-meta">
													<span>{{$franchiseRow->description}}</span>
													<span><a href="#" title="" itemprop="url">static</a>, <a href="#" title="" itemprop="url">static</a></span>
												</div>
											</div>
											<div class="restaurant-detail-tabs">
												<ul class="nav nav-tabs">
													<li class="active"><a href="#tab1-1" data-toggle="tab"><i class="fa fa-cutlery"></i> Pizzas</a></li>
													<li><a href="#tab1-2" data-toggle="tab"><i class="fa fa-percent"></i>Coupons</a></li>
													<li><a href="#tab1-3" data-toggle="tab"><i class="fa fa-percent"></i>Sales and Offers</a></li>
													<li><a href="#tab1-5" data-toggle="tab"><i class="fa fa-info"></i> Store Info</a></li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane fade in active" id="tab1-1">
													<!-- <form class="search-dish">
														<input type="text" placeholder="Search here">
														<button type="submit"><i class="fa fa-search"></i></button>
													</form> -->
													<div class="dishes-list-wrapper">
														<h4 class="title3" itemprop="headline"><span class="sudo-bottom sudo-bg-red">Pizza</span></h4>
														<ul class="dishes-list">
															@foreach($product as $prd)
															<li class="wow fadeInUp" data-wow-delay="0.1s">
																<div class="featured-restaurant-box">
																	<div class="featured-restaurant-thumb">
																		<a href="#" title="" itemprop="url"><img data-src="{{ asset('pizzaImage/'.$prd->pizzaImage) }}" width="99px" height="111px" itemprop="image" class="lazy"></a>
																	</div>
																	<div class="featured-restaurant-info">
																		<div class="row">
																			<div class="col-md-10">
																				<h4 itemprop="headline"><a href="#" title="" itemprop="url">{{$prd->name}}</a></h4>
																			</div>
																			<div class="col-md-2">
																				<span class="price">${{ $prd->price}}</span>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-12">
																				<p itemprop="description " style="font-family:unset;"> Type : {{ $prd->category->category }} , {{ $prd->topping }} toppings {{ $prd->end_date }} </p>
																			</div>
																		</div>

																	</div>
																	<div class="ord-btn">
																		<a class="brd-rd2" href="/order/{{ $prd->id }}" title="Order Now" itemprop="url">Order Now</a>
																	</div>
																</div>
															</li>
															@endforeach
														</ul>
													</div>
												</div>
												<div class="tab-pane fade in" id="tab1-2">
													<div class="dishes-list-wrapper">
														<h4 class="title3" itemprop="headline"><span class="sudo-bottom sudo-bg-red">Coupons</span></h4>
														<ul class="dishes-list">
															@if($coupons != null)
															@foreach($coupons as $row)
															<li class="wow fadeInUp" data-wow-delay="0.1s">
																<div class="row summary">
																	<div class="col-sm-10 description">
																		<div>
																			<h3>{{ $row['discount'] }}</h3>
																		</div>
																		<div>
																			{{ $row['pizzaSummary'] }}
																		</div>
																	</div>
																	<div class="col-sm-2 redirect-div">
																		<div class="button-redirect">
																			<a class="btn btn-primary copyCoupon" data-code= "{{ $row['couponCode'] }}" data-url="{{ $row['websiteName'] }}">
																				Use this code
																			</a>
																		</div>
																		<div class="coupons-code">
																			<span>
																				{{ $row['couponCode'] }}
																			</span>
																		</div>
																	</div>
																</div>
															</li>
															@endforeach
															@endif
														</ul>
													</div>
												</div>
												<div class="tab-pane fade in" id="tab1-3">
													<div class="dishes-list-wrapper">
														<h4 class="title3" itemprop="headline"><span class="sudo-bottom sudo-bg-red">Sales and Offers</span></h4>
														<ul class="dishes-list">
															@if($deals != null)
															@foreach($deals as $row)
															<li class="wow fadeInUp" data-wow-delay="0.1s">
																<div class="row summary">
																	<div class="col-sm-10 deal-description">
																		<div>
																			<h3>{{ $row['discount'] }}</h3>
																		</div>
																		<div>
																			{{ $row['pizzaSummary'] }}
																		</div>
																	</div>
																	<div class="col-sm-2 deal-redirect">
																		<div class=" deal-button">
																			<a class="btn btn-primary" href="{{ $row['websiteName'] }}" target="_blank">
																				Use this deal
																			</a>
																		</div>
																	</div>
																</div>
															</li>
															@endforeach
															@endif
														</ul>
													</div>
												</div>
												<div class="tab-pane fade" id="tab1-5">
													<div class="restaurant-info-wrapper">
														<h3 class="title3" itemprop="headline"><span class="sudo-bottom sudo-bg-red">Book</span> This Restaurant Table</h3>
														<div class="loc-map" id="loc-map"></div>
														<ul class="restaurant-info-list">
															<li>
																<i class="fa fa-map-marker red-clr"></i>
																<strong>Address :</strong>
																<span>static</span>
															</li>
															<li>
																<i class="fa fa-phone red-clr"></i>
																<strong>Call us</strong>
																<span>static</span>
															</li>

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
	</div>
</div>
</section>
@endsection
@section('js')

<script src="{{ asset('userAssets//js/plugins.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<!--  <script src="{{ asset('userAssets//js/google-map-int.js')}}"></script> -->
<script src="../../www.google.com/recaptcha/api.js"></script>
<script type="text/javascript">
	var lt = "";
	var lg = "";
	$(document).ready(function(){
		function initialize() {
			var myLatlng = new google.maps.LatLng(lt,lg);
			var mapOptions = {
				zoom: 10,
				disableDefaultUI: true,
				scrollwheel: false,
				center: myLatlng
			}
			var map = new google.maps.Map(document.getElementById('loc-map'), mapOptions);

			var myLatLng = new google.maps.LatLng(lt,lg);
			var beachMarker = new google.maps.Marker({
				position: myLatLng,
				map: map,
			});

		}
		google.maps.event.addDomListener(window, 'load', initialize);

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
			})

			setTimeout(function(){
				window.open(url, '_blank');
			}, 2500);
		});
	});
</script>
@endsection
