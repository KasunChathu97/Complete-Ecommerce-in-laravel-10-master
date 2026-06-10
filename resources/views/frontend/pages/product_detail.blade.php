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

		<!-- Breadcrumbs 
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
	 End Breadcrumbs -->
                
		<!-- Shop Single -->
		<section class="shop single section product-detail-page">
			<div class="container">
				<div class="row"> 
					<div class="col-12">
						<div class="row">
							<div class="col-lg-5 col-12">
								<!-- Product Gallery -->
								<div class="product-gallery-new">
									<!-- Main Image Display -->
									<div class="main-image-container shadow-sm">
										@if($product_detail->discount>0)
											<span class="badge badge-danger discount-badge-new">{{$product_detail->discount}}% OFF</span>
										@elseif(now()->diffInDays($product_detail->created_at) < 30)
											<span class="badge badge-success discount-badge-new">New</span>
										@endif
										
										@php
											$photos=[];
											foreach(explode(',', (string) $product_detail->photo) as $p){
												$p=trim($p);
												if(!$p) continue;
												if(!preg_match('~^https?://~i', $p) && substr($p,0,1) !== '/') {
													$p = '/'.$p;
												}
												if(!preg_match('~^https?://~i', $p)) {
													$cleanPath = ltrim($p, '/');
													if (file_exists(public_path($cleanPath))) {
														$p .= '?t=' . filemtime(public_path($cleanPath));
														$photos[]=$p;
													}
												} else {
													$photos[]=$p;
												}
											}
											if(empty($photos)){
												$photos[] = asset('backend/img/logo3.png');
											}
										@endphp

										<a href="{{ $photos[0] }}" class="product-image-popup-link" id="main-image-link">
											<img src="{{ $photos[0] }}" id="main-product-image" alt="{{$product_detail->title}}">
										</a>
									</div>

									<!-- Thumbnails List -->
									@if(count($photos) > 1)
									<div class="thumbnails-container-new">
										@foreach($photos as $index => $img)
											<div class="thumbnail-item-new {{ $index === 0 ? 'active' : '' }}" data-src="{{ $img }}">
												<img src="{{ $img }}" alt="Thumbnail {{ $index + 1 }}">
											</div>
										@endforeach
									</div>
									@endif
								</div>
								<!-- End Product slider -->

								@if(!empty($product_detail->youtube_link))
									@php
										$yt = trim((string) $product_detail->youtube_link);
										$ytId = null;
										if (preg_match('~youtu\.be/([\w-]{6,})~i', $yt, $m)) {
											$ytId = $m[1];
										} elseif (preg_match('~[\?&]v=([\w-]{6,})~i', $yt, $m)) {
											$ytId = $m[1];
										} elseif (preg_match('~youtube\.com/(?:embed|shorts)/([\w-]{6,})~i', $yt, $m)) {
											$ytId = $m[1];
										}
									@endphp
									<div class="card product-video-card mt-3">
										<div class="card-header">
											<i class="fa fa-youtube-play mr-1 text-danger"></i>Product Video
										</div>
										<div class="card-body">
											@if($ytId)
												<div class="embed-responsive embed-responsive-16by9" style="background:#000;border-radius:6px;overflow:hidden;">
													<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $ytId }}" allowfullscreen></iframe>
											</div>
										@else
											<a href="{{ e($yt) }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-danger">Watch on YouTube</a>
										@endif
										</div>
									</div>
								@endif
							</div>
							<div class="col-lg-7 col-12">
								<div class="product-des">
									<!-- Description -->
									<div class="short">
										<div class="d-flex align-items-center mb-2">
											<h4 class="mb-0">{{$product_detail->title}}</h4>
											<span class="badge badge-info ml-3" style="font-size:0.95rem;"><i class="fa fa-certificate mr-1"></i>100% Genuine</span>
											@if(!empty($product_detail->warranty))
												<span class="badge badge-warning ml-2" style="font-size:0.95rem;"><i class="fa fa-shield mr-1"></i>Warranty</span>
											@endif
											@if(!empty($product_detail->free_shipping) || !empty($product_detail->free_shipping_enabled))
												<span class="badge badge-success ml-2" style="font-size:0.95rem;">Free Shipping</span>
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
										@if(!empty($product_detail->weight))
										<div class="product-weight mt-2">
											<strong>Weight:</strong> {{ rtrim(rtrim(number_format($product_detail->weight, 2, '.', ''), '0'), '.') }} kg
										</div>
										@endif

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
										<div class="product-action-row" style="display:flex;align-items:flex-end;justify-content:space-between;gap:12px;flex-wrap:wrap;">
											<form action="{{route('single-add-to-cart')}}" method="POST" style="flex:1 1 320px;margin:0;">
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
												<div class="add-to-cart mt-4">
													<button type="submit" class="btn add-to-cart-btn-aliexpress same-size-btn" style="min-width: 160px; font-size:1.1rem; font-weight:600;">
														Add to Cart
													</button>
													<style>
													.add-to-cart-btn-aliexpress:hover, .add-to-cart-btn-aliexpress:focus {
														background: #e02e24 !important;
														border-color: #e02e24 !important;
														color: #fff !important;
														box-shadow: 0 4px 16px rgba(255,71,71,0.25);
													}
													</style>
												</div>
											</form>
											<form action="{{ route('buy-now') }}" method="POST" style="flex:0 0 auto;margin:0;">
												@csrf
												<input type="hidden" name="slug" value="{{$product_detail->slug}}">
												<input type="hidden" name="quant[1]" id="buy_now_quantity" value="1">
												<button type="submit" class="btn buy-now-btn-aliexpress same-size-btn" style="min-width: 160px; font-size:1.1rem; font-weight:600;">
													Buy Now
												</button>
											</form>
										</div>
										<style>
										.buy-now-btn-aliexpress:hover, .buy-now-btn-aliexpress:focus {
											background: #e02e24 !important;
											border-color: #e02e24 !important;
											color: #fff !important;
											box-shadow: 0 4px 16px rgba(255,71,71,0.25);
										}
										</style>
									</div>
									<p class="cat mt-3">Category :<a href="{{route('product-cat',$product_detail->cat_info['slug'])}}">{{$product_detail->cat_info['title']}}</a></p>
									@if($product_detail->sub_cat_info)
									<p class="cat mt-1">Sub Category :<a href="{{route('product-sub-cat',[$product_detail->cat_info['slug'],$product_detail->sub_cat_info['slug']])}}">{{$product_detail->sub_cat_info['title']}}</a></p>
									@endif
									<p class="availability">Stock : @if($product_detail->stock>0)<span class="badge badge-success">{{$product_detail->stock}}</span>@else <span class="badge badge-danger">{{$product_detail->stock}}</span>  @endif</p>
									<div class="mt-4">
										<h6 class="mb-2">Wholesale Pricing</h6>
										<p class="mb-3">Interested in wholesale pricing? Send us a request and we will contact you.</p>
										<a href="{{ route('wholesale.request', ['product' => $product_detail->slug]) }}" class="btn wholesale-btn">Request Wholesale Pricing</a>
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
																@php
																	$hasPurchased = false;
																	if(auth()->check()) {
																		$orders = auth()->user()->orders()->with('cart_info')->get();
																		foreach($orders as $order) {
																			foreach($order->cart_info as $cart) {
																				if($cart->product_id == $product_detail->id) {
																					$hasPurchased = true;
																					break 2;
																				}
																			}
																		}
																	}
																@endphp
																@if($hasPurchased)
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
																	Only customers who have purchased this product can leave a review.
																</p>
																@endif
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
												if($firstPhoto && !preg_match('~^https?://~i',$firstPhoto)) {
													$cleanPhoto = ltrim($firstPhoto, '/');
													if(file_exists(public_path($cleanPhoto))) {
														$firstPhoto .= '?t=' . filemtime(public_path($cleanPhoto));
													} else {
														$firstPhoto .= '?t=' . time();
													}
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
																		if(!preg_match('~^https?://~i', $p)) {
																			$cleanP = ltrim($p, '/');
																			if(file_exists(public_path($cleanP))) {
																				$p .= '?t=' . filemtime(public_path($cleanP));
																			} else {
																				$p .= '?t=' . time();
																			}
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

		.wholesale-btn {
			background: #b3d8fd;
			color: #000 !important;
			border: none;
			border-radius: 7px;
			padding: 10px 22px;
			font-weight: 500;
			transition: background 0.2s, color 0.2s;
		}
		.wholesale-btn:hover, .wholesale-btn:focus {
			background: #111;
			color: #fff !important;
		}
		.buy-now-btn-aliexpress {
			background: #ff4747 !important;
			color: #fff !important;
			border-color: #ff4747 !important;
			border-radius: 7px !important;
			box-shadow: 0 2px 8px rgba(255,71,71,0.15);
			transition: background 0.2s, color 0.2s, box-shadow 0.2s;
		}
		.buy-now-btn-aliexpress:hover, .buy-now-btn-aliexpress:focus {
			background: #e02e24 !important;
			color: #fff !important;
			border-color: #e02e24 !important;
			box-shadow: 0 4px 16px rgba(255,71,71,0.25);
		}
		.add-to-cart-btn-aliexpress {
			background: #ffe066 !important;
			color: #222 !important;
			border-color: #ffe066 !important;
			border-radius: 7px !important;
			box-shadow: 0 2px 8px rgba(255,224,102,0.15);
			transition: background 0.2s, color 0.2s, box-shadow 0.2s;
		}
		.add-to-cart-btn-aliexpress:hover, .add-to-cart-btn-aliexpress:focus {
			background: #fff !important;
			color: #222 !important;
			border-color: #ffe066 !important;
			box-shadow: 0 4px 16px rgba(255,224,102,0.25);
		}
		.same-size-btn {
			min-width: 160px !important;
			height: 44px !important;
			padding: 0 24px !important;
			display: inline-flex;
			align-items: center;
			justify-content: center;
		}

		/* Modern Image Gallery Styling */
		.product-gallery-new {
			display: flex;
			flex-direction: column;
			width: 100%;
		}
		.main-image-container {
			position: relative;
			width: 100%;
			height: 450px;
			background: #fff;
			border-radius: 12px;
			overflow: hidden;
			border: 1px solid #eaeaea;
			display: flex;
			align-items: center;
			justify-content: center;
			box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
			cursor: zoom-in;
			transition: box-shadow 0.3s ease;
		}
		.main-image-container:hover {
			box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
		}
		.discount-badge-new {
			position: absolute;
			top: 15px;
			left: 15px;
			font-size: 0.9rem;
			z-index: 10;
			padding: 6px 12px;
			border-radius: 6px;
			font-weight: 600;
			box-shadow: 0 4px 8px rgba(0,0,0,0.1);
		}
		.main-image-container a {
			display: flex;
			align-items: center;
			justify-content: center;
			width: 100%;
			height: 100%;
		}
		.main-image-container img {
			max-width: 95%;
			max-height: 95%;
			object-fit: contain;
			transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.2s ease;
			transform-origin: center center;
		}
		.thumbnails-container-new {
			display: flex;
			gap: 12px;
			margin-top: 15px;
			padding: 5px 2px;
			overflow-x: auto;
			scrollbar-width: thin;
			scrollbar-color: #F7941D #f1f1f1;
		}
		/* Custom Scrollbar for Thumbnails */
		.thumbnails-container-new::-webkit-scrollbar {
			height: 6px;
		}
		.thumbnails-container-new::-webkit-scrollbar-track {
			background: #f1f1f1;
			border-radius: 10px;
		}
		.thumbnails-container-new::-webkit-scrollbar-thumb {
			background: #F7941D;
			border-radius: 10px;
		}
		.thumbnail-item-new {
			flex: 0 0 75px;
			width: 75px;
			height: 75px;
			border-radius: 8px;
			overflow: hidden;
			border: 2px solid #eaeaea;
			background: #fff;
			cursor: pointer;
			transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
			box-shadow: 0 2px 5px rgba(0,0,0,0.05);
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.thumbnail-item-new img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			transition: transform 0.3s ease;
		}
		.thumbnail-item-new:hover {
			transform: translateY(-3px) scale(1.05);
			border-color: #F7941D;
			box-shadow: 0 6px 12px rgba(247, 148, 29, 0.2);
		}
		.thumbnail-item-new:hover img {
			transform: scale(1.1);
		}
		.thumbnail-item-new.active {
			border-color: #F7941D;
			box-shadow: 0 0 0 3px rgba(247, 148, 29, 0.15);
		}

		/* Responsive gallery tweaks */
		@media (max-width: 767px) {
			.main-image-container {
				height: 320px;
			}
			.thumbnail-item-new {
				flex: 0 0 65px;
				width: 65px;
				height: 65px;
			}
		}
	</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="/frontend/js/magnific-popup.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
<script>
$(document).ready(function() {
	const mainContainer = document.querySelector('.main-image-container');
	const mainImage = document.querySelector('#main-product-image');
	const mainImgLink = document.querySelector('#main-image-link');
	const thumbnails = document.querySelectorAll('.thumbnail-item-new');

	// Hover zoom/pan effect for the main image
	if (mainContainer && mainImage) {
		mainContainer.addEventListener('mousemove', function(e) {
			const rect = mainContainer.getBoundingClientRect();
			const x = ((e.clientX - rect.left) / rect.width) * 100;
			const y = ((e.clientY - rect.top) / rect.height) * 100;
			
			mainImage.style.transformOrigin = `${x}% ${y}%`;
			mainImage.style.transform = 'scale(1.5)';
		});
		
		mainContainer.addEventListener('mouseleave', function() {
			mainImage.style.transform = 'scale(1)';
			mainImage.style.transformOrigin = 'center center';
		});
	}

	// Switch main image when hovering/clicking thumbnails
	thumbnails.forEach(thumb => {
		const switchImage = function() {
			const newSrc = thumb.getAttribute('data-src');
			if (mainImage.getAttribute('src') !== newSrc) {
				mainImage.style.opacity = '0.3';
				setTimeout(() => {
					mainImage.setAttribute('src', newSrc);
					mainImgLink.setAttribute('href', newSrc);
					mainImage.style.opacity = '1';
				}, 100);
				
				thumbnails.forEach(t => t.classList.remove('active'));
				thumb.classList.add('active');
			}
		};
		
		thumb.addEventListener('mouseenter', switchImage);
		thumb.addEventListener('click', switchImage);
	});

	// Array of all photo URLs for Magnific Popup Lightbox (only existing photos)
	const galleryImages = @json($photos);

	$('.product-image-popup-link').on('click', function(e) {
		e.preventDefault();
		
		const activeSrc = $('#main-product-image').attr('src');
		const cleanActiveSrc = activeSrc.split('?')[0];
		
		let activeIndex = galleryImages.findIndex(img => img.split('?')[0] === cleanActiveSrc);
		if (activeIndex === -1) activeIndex = 0;
		
		$.magnificPopup.open({
			items: galleryImages.map(img => ({ src: img, title: '{{$product_detail->title}}' })),
			gallery: { enabled: true },
			type: 'image',
			mainClass: 'mfp-fade',
			removalDelay: 300,
			startAt: activeIndex
		});
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