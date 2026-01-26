@extends('frontend.layouts.master')

@section('meta')
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">
	<meta name="description" content="{{$product_detail->summary}}">
	<meta property="og:url" content="{{route('product-detail',$product_detail->slug)}}">
	<meta property="og:type" content="article">
	<meta property="og:title" content="{{$product_detail->title}}">
	<meta property="og:image" content="{{$product_detail->photo}}">
	<meta property="og:description" content="{{$product_detail->description}}">
@endsection
@section('title','DL || PRODUCT DETAIL')
@section('main-content')

		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="">Shop Details</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
                
		<!-- Shop Single -->
		<section class="shop single section">
			<div class="container">
				<div class="row"> 
					<div class="col-12">
						<div class="row">
							<div class="col-lg-6 col-12">
								<!-- Product Slider -->
								<div class="product-gallery shadow rounded p-2 position-relative" style="background:#fff;">
									<!-- Product Badge -->
									@if($product_detail->discount>0)
										<span class="badge badge-danger position-absolute" style="top:15px;left:15px;font-size:1rem;z-index:2;">{{$product_detail->discount}}% OFF</span>
									@elseif(now()->diffInDays($product_detail->created_at) < 30)
										<span class="badge badge-success position-absolute" style="top:15px;left:15px;font-size:1rem;z-index:2;">New</span>
									@endif
									<!-- Main Image Slider -->
									<div id="product-main-slider" class="flexslider">
										<ul class="slides">
											@php
												$photos=[];
												foreach(explode(',', (string) $product_detail->photo) as $p){
													$p=trim($p);
													if(!$p) continue;
													if(!preg_match('~^https?://~i', $p) && substr($p,0,1) !== '/') {
														$p = '/'.$p;
													}
													$photos[]=$p;
												}
												if(empty($photos)){
													$photos[] = asset('backend/img/logo3.png');
												}
											@endphp
											@foreach($photos as $img)
												<li>
													<a href="{{$img}}" class="product-image-popup" title="{{$product_detail->title}}">
														<img src="{{$img}}" alt="{{$product_detail->title}}" style="width:100%;max-height:400px;object-fit:contain;">
													</a>
												</li>
											@endforeach
										<style>
											.product-image-caption {
												margin-top: 10px;
												text-align: center;
												font-size: 15px;
												color: #444;
												line-height: 1.5;
												background: #f8f9fa;
												padding: 8px 12px;
												border-radius: 4px;
												min-height: 40px;
											}
										</style>
										</ul>
									</div>
									<!-- Thumbnail Navigation Slider -->
									<div id="product-thumb-slider" class="flexslider flexslider-thumbnails" style="margin-top:15px;">
										<ul class="slides">
											@foreach($photos as $img)
												<li>
													<img src="{{$img}}" alt="{{$product_detail->title}}" class="thumb-img" style="height:70px;width:70px;object-fit:cover;border:2px solid #eee;border-radius:4px;cursor:pointer;transition:box-shadow .2s;">
												</li>
											@endforeach
										</ul>
									</div>
								</div>
								<!-- End Product slider -->
							</div>
							<div class="col-lg-6 col-12">
								<div class="product-des">
									<!-- Description -->
									<div class="short">
										<div class="d-flex align-items-center mb-2">
											<h4 class="mb-0">{{$product_detail->title}}</h4>
											<span class="badge badge-info ml-3" style="font-size:0.95rem;"><i class="fa fa-certificate mr-1"></i>100% Genuine</span>
											@if(!empty($product_detail->warranty))
												<span class="badge badge-warning ml-2" style="font-size:0.95rem;"><i class="fa fa-shield mr-1"></i>Warranty</span>
											@endif
										</div>
										<div class="rating-main mb-2">
											<ul class="rating">
												@php
													$rate=ceil($product_detail->getReview->avg('rate'))
												@endphp
													@for($i=1; $i<=5; $i++)
														@if($rate>=$i)
															<li><i class="fa fa-star"></i></li>
														@else 
															<li><i class="fa fa-star-o"></i></li>
														@endif
													@endfor
											</ul>
											<a href="#" class="total-review">({{$product_detail['getReview']->count()}}) Review</a>
										</div>
										@php 
											$after_discount=($product_detail->price-(($product_detail->price*$product_detail->discount)/100));
										@endphp
										<p class="price mb-2" style="font-size:1.7rem;font-weight:600;color:#e74c3c;">
											<span class="discount">{{Helper::formatCurrency($after_discount)}}</span>
											@if($product_detail->discount>0)
												<s style="font-size:1.1rem;color:#888;">{{Helper::formatCurrency($product_detail->price)}}</s>
											@endif
										</p>
										<p class="description">{!!($product_detail->summary)!!}</p>

										@if(!empty($product_detail->warranty))
										<div class="product-warranty mt-3">
											<h5 style="font-weight:bold;"><i class="fa fa-shield mr-1 text-warning"></i>Warranty</h5>
											<div style="background:#f8f9fa;padding:10px 15px;border-radius:4px;">{!! nl2br(e($product_detail->warranty)) !!}</div>
										</div>
										@endif

										@if(!empty($product_detail->returns))
										<div class="product-returns mt-3">
											<h5 style="font-weight:bold;"><i class="fa fa-undo mr-1 text-info"></i>Returns</h5>
											<div style="background:#f8f9fa;padding:10px 15px;border-radius:4px;">{!! nl2br(e($product_detail->returns)) !!}</div>
										</div>
										@endif
									</div>
									<!--/ End Description -->
									<!-- Size -->
									@if($product_detail->size)
										<div class="size mt-4">
											<h4>Size</h4>
											<ul>
												@php 
													$sizes=explode(',',$product_detail->size);
												@endphp
												@foreach($sizes as $size)
												<li><a href="#" class="one">{{$size}}</a></li>
												@endforeach
											</ul>
										</div>
									@endif
									<!--/ End Size -->
									<!-- Product Buy -->
									<div class="product-buy">
										<form action="{{route('single-add-to-cart')}}" method="POST">
											@csrf 
											<div class="quantity">
												<h6>Quantity :</h6>
												<!-- Input Order -->
												<div class="input-group">
													<div class="button minus">
														<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
															<i class="ti-minus"></i>
														</button>
													</div>
													<input type="hidden" name="slug" value="{{$product_detail->slug}}">
													<input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1" id="quantity">
													<div class="button plus">
														<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
															<i class="ti-plus"></i>
														</button>
													</div>
												</div>
											<!--/ End Input Order -->
											</div>
											<div class="add-to-cart mt-4 d-flex align-items-center gap-2" style="gap: 12px;">
												<button type="submit" class="btn btn-primary d-flex align-items-center" style="min-width: 140px;font-size:1.1rem;"><i class="ti-shopping-cart mr-2"></i> Add to Cart</button>
											</div>
										</form>
										<form action="{{ route('buy-now') }}" method="POST" style="display:inline;">
											@csrf
											<input type="hidden" name="slug" value="{{$product_detail->slug}}">
											<input type="hidden" name="quant[1]" id="buy_now_quantity" value="1">
											<button type="submit" class="btn btn-success mt-2 d-flex align-items-center" style="min-width: 140px;font-size:1.1rem;"><i class="fa fa-bolt mr-2"></i> Buy Now</button>
										</form>
										<a href="{{route('add-to-wishlist',$product_detail->slug)}}" class="btn min ml-2" style="background: #f8f9fa; color: #e74c3c; border: 1px solid #e74c3c;"><i class="ti-heart"></i></a>
									</div>
									<p class="cat mt-3">Category :<a href="{{route('product-cat',$product_detail->cat_info['slug'])}}">{{$product_detail->cat_info['title']}}</a></p>
									@if($product_detail->sub_cat_info)
									<p class="cat mt-1">Sub Category :<a href="{{route('product-sub-cat',[$product_detail->cat_info['slug'],$product_detail->sub_cat_info['slug']])}}">{{$product_detail->sub_cat_info['title']}}</a></p>
									@endif
									<p class="availability">Stock : @if($product_detail->stock>0)<span class="badge badge-success">{{$product_detail->stock}}</span>@else <span class="badge badge-danger">{{$product_detail->stock}}</span>  @endif</p>
									<div class="mt-4">
										<h6 class="mb-2">Wholesale Pricing</h6>
										<p class="mb-3">Interested in wholesale pricing? Send us a request and we will contact you.</p>
										<a href="{{ route('wholesale.request', ['product' => $product_detail->slug]) }}" class="btn btn-outline-primary">Request Wholesale Pricing</a>
									</div>
								</div>
							</div>
						</div>
								<div class="row">
									<div class="col-12">
										<div class="product-info">
											<div class="nav-main">
												<!-- Tab Nav -->
												<ul class="nav nav-tabs" id="myTab" role="tablist">
													<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a></li>
													<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews</a></li>
												</ul>
												<!--/ End Tab Nav -->
											</div>
											<div class="tab-content" id="myTabContent">
												<!-- Description Tab -->
												<div class="tab-pane fade show active" id="description" role="tabpanel">
													<div class="tab-single">
														<div class="row">
															<div class="col-12">
																<div class="single-des">
																	<p>{!! ($product_detail->description) !!}</p>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!--/ End Description Tab -->
												<!-- Reviews Tab -->
												<div class="tab-pane fade" id="reviews" role="tabpanel">
													<div class="tab-single review-panel">
														<div class="row">
															<div class="col-12">
																
																<!-- Review -->
																<div class="comment-review">
																	<div class="add-review">
																		<h5>Add A Review</h5>
																		<p>Your email address will not be published. Required fields are marked</p>
																	</div>
																	<h4>Your Rating <span class="text-danger">*</span></h4>
																	<div class="review-inner">
																			<!-- Form -->
																@auth
																<form class="form" method="post" action="{{route('review.store',$product_detail->slug)}}">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-12">
                                                                            <div class="rating_box">
                                                                                  <div class="star-rating">
                                                                                    <div class="star-rating__wrap">
                                                                                      <input class="star-rating__input" id="star-rating-5" type="radio" name="rate" value="5">
                                                                                      <label class="star-rating__ico fa fa-star-o" for="star-rating-5" title="5 out of 5 stars"></label>
                                                                                      <input class="star-rating__input" id="star-rating-4" type="radio" name="rate" value="4">
                                                                                      <label class="star-rating__ico fa fa-star-o" for="star-rating-4" title="4 out of 5 stars"></label>
                                                                                      <input class="star-rating__input" id="star-rating-3" type="radio" name="rate" value="3">
                                                                                      <label class="star-rating__ico fa fa-star-o" for="star-rating-3" title="3 out of 5 stars"></label>
                                                                                      <input class="star-rating__input" id="star-rating-2" type="radio" name="rate" value="2">
                                                                                      <label class="star-rating__ico fa fa-star-o" for="star-rating-2" title="2 out of 5 stars"></label>
                                                                                      <input class="star-rating__input" id="star-rating-1" type="radio" name="rate" value="1">
																					  <label class="star-rating__ico fa fa-star-o" for="star-rating-1" title="1 out of 5 stars"></label>
																					  @error('rate')
																						<span class="text-danger">{{$message}}</span>
																					  @enderror
                                                                                    </div>
                                                                                  </div>
                                                                            </div>
                                                                        </div>
																		<div class="col-lg-12 col-12">
																			<div class="form-group">
																				<label>Write a review</label>
																				<textarea name="review" rows="6" placeholder="" ></textarea>
																			</div>
																		</div>
																		<div class="col-lg-12 col-12">
																			<div class="form-group button5">	
																				<button type="submit" class="btn">Submit</button>
																			</div>
																		</div>
																	</div>
																</form>
																@else 
																<p class="text-center p-5">
																	You need to <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Login</a> OR <a style="color:blue" href="{{route('register.form')}}">Register</a>

																</p>
																<!--/ End Form -->
																@endauth
																	</div>
																</div>
															
																<div class="ratting-main">
																	<div class="avg-ratting">
																		{{-- @php 
																			$rate=0;
																			foreach($product_detail->rate as $key=>$rate){
																				$rate +=$rate
																			}
																		@endphp --}}
																		<h4>{{ceil($product_detail->getReview->avg('rate'))}} <span>(Overall)</span></h4>
																		<span>Based on {{$product_detail->getReview->count()}} Comments</span>
																	</div>
																	@foreach($product_detail['getReview'] as $data)
																	<!-- Single Rating -->
																	<div class="single-rating">
																		<div class="rating-author">
																			@if($data->user_info['photo'])
																			<img src="{{$data->user_info['photo']}}" alt="{{$data->user_info['photo']}}">
																			@else 
																			<img src="{{asset('backend/img/avatar.png')}}" alt="Profile.jpg">
																			@endif
																		</div>
																		<div class="rating-des">
																			<h6>{{$data->user_info['name']}}</h6>
																			<div class="ratings">

																				<ul class="rating">
																					@for($i=1; $i<=5; $i++)
																						@if($data->rate>=$i)
																							<li><i class="fa fa-star"></i></li>
																						@else 
																							<li><i class="fa fa-star-o"></i></li>
																						@endif
																					@endfor
																				</ul>
																				<div class="rate-count">(<span>{{$data->rate}}</span>)</div>
																			</div>
																			<p>{{$data->review}}</p>
																		</div>
																	</div>
																	<!--/ End Single Rating -->
																	@endforeach
																</div>
																
																<!--/ End Review -->
																
															</div>
														</div>
													</div>
												</div>
												<!--/ End Reviews Tab -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
		</section>
		<!--/ End Shop Single -->
		
		<!-- Start Most Popular -->
	<div class="product-area most-popular related-product section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Related Products</h2>
					</div>
				</div>
            </div>
            <div class="row">
                {{-- {{$product_detail->rel_prods}} --}}
                <div class="col-12">
						<div class="owl-carousel popular-slider">
                        @foreach($product_detail->rel_prods as $data)
                            @if($data->id !==$product_detail->id)
                                <!-- Start Single Product -->
                                <div class="single-product" data-product-url="{{route('product-detail',$data->slug)}}">
                                    <div class="product-img">
										<a href="{{route('product-detail',$data->slug)}}">
											@php 
												$photo=explode(',',$data->photo);
												$firstPhoto=trim($photo[0] ?? '');
												if($firstPhoto && !preg_match('~^https?://~i',$firstPhoto) && substr($firstPhoto,0,1) !== '/') {
													$firstPhoto='/' . $firstPhoto;
												}
											@endphp
															<img class="default-img" src="{{$firstPhoto}}" alt="{{$data->title}}">
															<img class="hover-img" src="{{$firstPhoto}}" alt="{{$data->title}}">
													@if($data->discount>0)
														<span class="price-dec">{{$data->discount}} % Off</span>
													@endif
                                                                    {{-- <span class="out-of-stock">Hot</span> --}}
                                        </a>
                                        <div class="button-head">
                                            <div class="product-action">
                                                <a data-toggle="modal" data-target="#quickview-{{$data->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                                <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                                <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
                                            </div>
                                            <div class="product-action-2">
                                                <a title="Add to cart" href="#">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{route('product-detail',$data->slug)}}">{{$data->title}}</a></h3>
                                        <div class="product-price">
                                            @php 
                                                $after_discount=($data->price-(($data->discount*$data->price)/100));
                                            @endphp
														<span>{{Helper::formatCurrency($after_discount)}}</span>
													@if($data->discount>0)
															<span class="old">{{Helper::formatCurrency($data->price)}}</span>
													@endif
                                        </div>
                                      
                                    </div>
                                </div>
                                <!-- End Single Product -->

								<!-- Quick View Modal (per related product) -->
								<div class="modal fade" id="quickview-{{$data->id}}" tabindex="-1" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
											</div>
											<div class="modal-body">
												<div class="row no-gutters">
													<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
														<div class="product-gallery">
															<div class="quickview-slider-active">
																@php
																	$modalPhotos=[];
																	foreach(explode(',', (string) $data->photo) as $p){
																		$p=trim($p);
																		if(!$p) continue;
																		if(!preg_match('~^https?://~i', $p) && substr($p,0,1) !== '/') {
																			$p='/' . $p;
																		}
																		$modalPhotos[]=$p;
																	}
																	if(empty($modalPhotos)){
																		$modalPhotos[] = asset('backend/img/logo3.png');
																	}
																@endphp
																@foreach($modalPhotos as $img)
																	<div class="single-slider">
																		<img src="{{$img}}" alt="{{$data->title}}">
																	</div>
																@endforeach
															</div>
														</div>
													</div>
													<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
														<div class="quickview-content">
															<h2>{{$data->title}}</h2>
															<div class="quickview-ratting-review">
																<div class="quickview-ratting-wrap">
																	<div class="quickview-ratting">
																		@php $rate=ceil($data->getReview->avg('rate')); @endphp
																		@for($i=1; $i<=5; $i++)
																			@if($rate>=$i)
																				<i class="yellow fa fa-star"></i>
																			@else
																				<i class="fa fa-star"></i>
																			@endif
																		@endfor
																	</div>
																	<a href="{{route('product-detail',$data->slug)}}"> ({{$data->getReview->count()}} customer review)</a>
																</div>
																<div class="quickview-stock">
																	<span><i class="fa fa-check-circle-o"></i> {{$data->stock}} in stock</span>
																</div>
															</div>
															@php $after_discount=($data->price-(($data->price*$data->discount)/100)); @endphp
																<h3>{{Helper::formatCurrency($after_discount)}} @if($data->discount>0) <s>{{Helper::formatCurrency($data->price)}}</s> @endif</h3>
															<div class="quickview-peragraph">
																<p>{!! $data->summary !!}</p>
															</div>
															<div class="add-to-cart">
																<a href="{{route('product-detail',$data->slug)}}" class="btn">View Details</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

                                	
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- End Most Popular Area -->
	
@endsection
@push('styles')
	<style>
		/* Rating */
		.rating_box {
		display: inline-flex;
		}

		.star-rating {
		font-size: 0;
		padding-left: 10px;
		padding-right: 10px;
		}

		.star-rating__wrap {
		display: inline-block;
		font-size: 1rem;
		}

		.star-rating__wrap:after {
		content: "";
		display: table;
		clear: both;
		}

		.star-rating__ico {
		float: right;
		padding-left: 2px;
		cursor: pointer;
		color: #F7941D;
		font-size: 16px;
		margin-top: 5px;
		}

		.star-rating__ico:last-child {
		padding-left: 0;
		}

		.star-rating__input {
		display: none;
		}

		.star-rating__ico:hover:before,
		.star-rating__ico:hover ~ .star-rating__ico:before,
		.star-rating__input:checked ~ .star-rating__ico:before {
		content: "\F005";
		}

	</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="/frontend/js/flex-slider.js"></script>
<script src="/frontend/js/magnific-popup.js"></script>
<link rel="stylesheet" href="/frontend/css/flex-slider.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
<style>
	#product-main-slider .slides img { width: 100%; max-height: 400px; object-fit: contain; }
	#product-thumb-slider .slides img { height: 70px; width: 70px; object-fit: cover; border: 2px solid #eee; border-radius: 4px; cursor: pointer; }
	#product-thumb-slider .flex-active-slide img { border: 2px solid #007bff; }
</style>
<script>
$(document).ready(function() {
	// FlexSlider main + thumbnail nav
	$('#product-main-slider').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		sync: "#product-thumb-slider"
	});
	$('#product-thumb-slider').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		itemWidth: 70,
		itemMargin: 8,
		asNavFor: '#product-main-slider'
	});
	// Show main image on thumbnail hover
	$('#product-thumb-slider .slides li').on('mouseenter', function() {
		var idx = $(this).index();
		$('#product-main-slider').flexslider(idx);
	});
	// Magnific Popup for gallery
	$('#product-main-slider').magnificPopup({
		delegate: 'a.product-image-popup',
		type: 'image',
		gallery: { enabled: true },
		mainClass: 'mfp-fade',
		removalDelay: 300,
		closeOnContentClick: false,
		closeBtnInside: false
	});
});
</script>

    {{-- <script>
        $('.cart').click(function(){
            var quantity=$('#quantity').val();
            var pro_id=$(this).data('id');
            // alert(quantity);
            $.ajax({
                url:"{{route('add-to-cart')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id
                },
                success:function(response){
                    console.log(response);
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						swal('success',response.msg,'success').then(function(){
							document.location.href=document.location.href;
						});
					}
					else{
                        swal('error',response.msg,'error').then(function(){
							document.location.href=document.location.href;
						});
                    }
                }
            })
        });
    </script> --}}

@endpush