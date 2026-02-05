@extends('frontend.layouts.master')
@section('title','DL || HOME PAGE')
@section('main-content')

<!-- Banner commented out for new layout -->
{{--
@if(count($banners)>0)
    <section id="Gslider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($banners as $key=>$banner)
        <li data-target="#Gslider" data-slide-to="{{$key}}" class="{{(($key==0)? 'active' : '')}}"></li>
            @endforeach

        </ol>
        <div class="carousel-inner" role="listbox">
                @foreach($banners as $key=>$banner)
                <div class="carousel-item {{(($key==0)? 'active' : '')}}">
                    <img class="first-slide" src="{{$banner->photo}}" alt="First slide">
                    <div class="carousel-caption d-none d-md-block text-left">
                        <h1 class="wow fadeInDown">{{$banner->title}}</h1>
                        <p>{!! html_entity_decode($banner->description) !!}</p>
                        <a class="btn btn-lg ws-btn wow fadeInUpBig" href="{{route('product-grids')}}" role="button">Shop Now<i class="far fa-arrow-alt-circle-right"></i></i></a>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </section>
@endif
--}}

<!--/ End Slider Area -->

<!-- Cream Horizontal Bar with Navigation and Marquee -->
<div style="width: 100%; background:linear-gradient(90deg,#afc9f3 60%,#fffbe7 100%);min-height: 100px; display: flex; flex-direction: column; align-items: center; justify-content: center; margin-bottom: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.03); font-size: 1.1em; font-weight: 500; position: relative; overflow: hidden;">
    <div style="width: 100%; overflow: hidden; height: 32px; margin-bottom: 4px;">
        <div id="marquee-offer" style="white-space: nowrap; display: inline-block; font-size: 2.15em; color: rgb(238, 0, 0); font-weight: bold; animation: marquee-move 12s linear infinite;">
            අද දින 20% ක වට්ටමක්. ඔබත් ඉක්මනින් ඇණවුම් කරන්න.
        </div>
    </div>
</div>

@push('styles')
        <style>
        @keyframes marquee-move {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        #marquee-offer {
            will-change: transform;
        }
        </style>
@endpush

<!-- Start Product Area -->
<div class="product-area section" style="margin-top:0 !important; padding-top:0 !important;">
        <div class="container" style="max-width:98vw; padding-left:8px; padding-right:8px;">
            <div class="row">
                <div class="col-12">
                    <div class="section-title" style="margin-top:0 !important; padding-top:0 !important; margin-bottom:0 !important;">
                        <h2>Trending Item</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-info">
                        <div class="nav-main">
                            <!-- Tab Nav -->
                            <ul class="nav nav-tabs filter-tope-group product-filter-tabs" id="myTab" role="tablist">
                                @php
                                    $categories=DB::table('categories')->where('status','active')->where('is_parent',1)->get();
                                    // dd($categories);
                                @endphp
                                @if($categories)
                                <li class="nav-item">
                                    <button type="button" class="filter-btn how-active1" data-filter="*">All Products</button>
                                </li>
                                    @foreach($categories as $key=>$cat)
                                    <li class="nav-item">
                                        <button type="button" class="filter-btn" data-filter=".cat-{{$cat->id}}">{{$cat->title}}</button>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                            <!--/ End Tab Nav -->
                        </div>
                        <div class="tab-content isotope-grid" id="myTabContent">
                             <!-- Start Single Tab -->
                            @if($product_lists)
                                @foreach($product_lists as $key=>$product)
                                <div class="col-6 col-md-4 col-lg-2 p-b-35 isotope-item cat-{{$product->cat_id}}">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{route('product-detail',$product->slug)}}">
                                                    @php
                                                        $photo=explode(',', $product->photo);
                                                    @endphp
                                                    <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                                    <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                                    @if($product->discount)
                                                        <div class="discount-badge">
                                                            <span>-{{$product->discount}}%</span>
                                                        </div>
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-category">
                                                    <span class="category-badge">{{$product->cat_info->title ?? ''}}</span>
                                                </div>
                                                <h3 class="product-title">
                                                    <a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a>
                                                </h3>
                                                
                                                <!-- Product Rating -->
                                                <div class="product-rating">
                                                    @php
                                                        $avg_rating = DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
                                                        $rating_count = DB::table('product_reviews')->where('product_id',$product->id)->count();
                                                    @endphp
                                                    <div class="stars">
                                                        @if($avg_rating > 0)
                                                            @for($i = 1; $i <= 5; $i++)
                                                                @if($avg_rating >= $i)
                                                                    <i class="fas fa-star"></i>
                                                                @elseif($avg_rating > ($i - 0.5))
                                                                    <i class="fas fa-star-half-alt"></i>
                                                                @else
                                                                    <i class="far fa-star"></i>
                                                                @endif
                                                            @endfor
                                                        @else
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="far fa-star"></i>
                                                            @endfor
                                                        @endif
                                                    </div>
                                                    @if($rating_count > 0)
                                                        <span class="rating-count">({{$rating_count}})</span>
                                                    @else
                                                        <span class="rating-count">No reviews</span>
                                                    @endif
                                                </div>
                                                
                                                <!-- Product Price -->
                                                <div class="product-price">
                                                    @php
                                                        $after_discount = ($product->price - ($product->price * $product->discount / 100));
                                                        $currency = 'Rs.';
                                                    @endphp
                                                    @if($product->discount)
                                                        <span class="current-price">{{$currency}}{{number_format($after_discount,2)}}</span>
                                                        <span class="old-price">{{$currency}}{{number_format($product->price,2)}}</span>
                                                    @else
                                                        <span class="current-price">{{$currency}}{{number_format($product->price,2)}}</span>
                                                    @endif
                                                </div>
                                                
                                                <!-- Stock Status -->
                                                <div class="stock-status">
                                                    @if($product->stock > 0)
                                                        <span class="in-stock">
                                                            <i class="fas fa-check-circle"></i>
                                                            In Stock
                                                        </span>
                                                    @else
                                                        <span class="out-of-stock">
                                                            <i class="fas fa-times-circle"></i>
                                                            Out of Stock
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                <!-- Product Actions -->
                                                <div class="product-actions">
                                                    <a href="{{route('add-to-cart',$product->slug)}}" class="btn-add-to-cart">
                                                        Add to Cart
                                                    </a>
                                                    <a href="{{route('product-detail',$product->slug)}}" class="btn-view-details">
                                                        View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                @endforeach

                             <!--/ End Single Tab -->
                            @endif

                            <div class="no-items-available" style="display:none;">No items available</div>

                        <!--/ End Single Tab -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- End Product Area -->
{{-- @php
    $featured=DB::table('products')->where('is_featured',1)->where('status','active')->orderBy('id','DESC')->limit(1)->get();
@endphp --}}

{{--
<!-- Start Most Popular -->
<div class="product-area most-popular section">
    <div class="container" style="max-width:95vw; padding-left:24px; padding-right:24px;">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Hot Item</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel popular-slider">
                    @foreach($product_lists as $product)
                        @if($product->condition=='hot')
                            <!-- Start Single Product -->
                        <div class="single-product" data-product-url="{{route('product-detail',$product->slug)}}">
                            <div class="product-img">
                                <a href="{{route('product-detail',$product->slug)}}">
                                    @php
                                        $photo=explode(',',$product->photo);
                                        $firstPhoto=$photo[0] ?? '';
                                        if ($firstPhoto && preg_match('~(/storage/[^,\s]+?\.(?:png|jpe?g|gif|webp|svg))~i', $firstPhoto, $m)) {
                                            $firstPhoto=$m[1];
                                        }
                                    @endphp
                                    <img class="default-img" src="{{$firstPhoto}}" alt="{{$product->title}}">
                                    <img class="hover-img" src="{{$firstPhoto}}" alt="{{$product->title}}">
                                    <!-- <span class="out-of-stock">Hot</span> -->
                                </a>
                                <div class="button-head">
                                    <div class="product-action">
                                        <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                    </div>
                                    <div class="product-action-2">
                                        <a href="{{route('add-to-cart',$product->slug)}}">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                <div class="product-price">
                                    @php
                                    $after_discount=($product->price-($product->price*$product->discount)/100)
                                    @endphp
                                    <span>{{Helper::formatCurrency($after_discount)}}</span>
                                    @if($product->discount>0)
                                        <span class="old">{{Helper::formatCurrency($product->price)}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Most Popular Area -->
--}}

<!-- Start Shop Home List  -->
<section class="shop-home-list section">
    <div class="container" style="max-width:98vw; padding-left:8px; padding-right:8px;">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="shop-section-title">
                            <h1>Latest Items</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @php
                        $latest_products=DB::table('products')->where('status','active')->orderBy('id','DESC')->limit(6)->get();
                    @endphp
                    @foreach($latest_products as $product)
                        <div class="col-md-3">
                            <!-- Start Single List  -->
                            <div class="single-list" data-product-url="{{route('product-detail',$product->slug)}}">
                                <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="list-image overlay">
                                        @php
                                            $photo=explode(',',$product->photo);
                                            // dd($photo);
                                        @endphp
                                        <a href="{{route('product-detail',$product->slug)}}">
                                            <img src="{{$photo[0]}}" alt="{{$product->title}}">
                                        </a>
                                        <a href="{{route('add-to-cart',$product->slug)}}" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 no-padding">
                                    <div class="content">
                                        <h4 class="title"><a href="#">{{$product->title}}</a></h4>
                                        @php
                                            $after_discount=($product->price-($product->price*$product->discount)/100);
                                        @endphp
                                        <p class="price with-discount">{{Helper::formatCurrency($after_discount)}}</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- End Single List  -->
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Home List  -->

<!-- Start Shop Blog  
<section class="shop-blog section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>From Our Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @if($posts)
                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Start Single Blog  
                        <div class="shop-single-blog">
                            <img src="{{$post->photo}}" alt="{{$post->photo}}">
                            <div class="content">
                                <p class="date">{{$post->created_at->format('d M , Y. D')}}</p>
                                <a href="{{route('blog.detail',$post->slug)}}" class="title">{{$post->title}}</a>
                                <a href="{{route('blog.detail',$post->slug)}}" class="more-btn">Continue Reading</a>
                            </div>
                        </div>
                        End Single Blog  
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</section>
 End Shop Blog  -->

<!-- Start Shop Services Area 
<section class="shop-services section home">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                 Start Single Service 
                <div class="single-service">
                    <i class="ti-rocket"></i>
                    <h4>Free shiping</h4>
                    <p>Orders over {{Helper::formatCurrency(100)}}</p>
                </div>
                End Single Service 
            </div>
            <div class="col-lg-3 col-md-6 col-12">
               Start Single Service 
                <div class="single-service">
                    <i class="ti-reload"></i>
                    <h4>Free Return</h4>
                    <p>Within 30 days returns</p>
                </div>
                 End Single Service 
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                 Start Single Service 
                <div class="single-service">
                    <i class="ti-lock"></i>
                    <h4>Sucure Payment</h4>
                    <p>100% secure payment</p>
                </div>
                 End Single Service 
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                 Start Single Service 
                <div class="single-service">
                    <i class="ti-tag"></i>
                    <h4>Best Peice</h4>
                    <p>Guaranteed price</p>
                </div>
                 End Single Service 
            </div>
        </div>
    </div>
</section>
 End Shop Services Area -->

@include('frontend.layouts.newsletter')

<!-- Modal -->
@if($product_lists)
    @foreach($product_lists as $key=>$product)
        <div class="modal fade" id="{{$product->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row no-gutters">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <!-- Product Slider -->
                                        <div class="product-gallery">
                                            <div class="quickview-slider-active">
                                                @php
                                                    $photo=explode(',',$product->photo);
                                                // dd($photo);
                                                @endphp
                                                @foreach($photo as $data)
                                                    <div class="single-slider">
                                                        <img src="{{$data}}" alt="{{$data}}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    <!-- End Product slider -->
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="quickview-content">
                                        <h2>{{$product->title}}</h2>
                                        <div class="quickview-ratting-review">
                                            <div class="quickview-ratting-wrap">
                                                <div class="quickview-ratting">
                                                    {{-- <i class="yellow fa fa-star"></i>
                                                    <i class="yellow fa fa-star"></i>
                                                    <i class="yellow fa fa-star"></i>
                                                    <i class="yellow fa fa-star"></i>
                                                    <i class="fa fa-star"></i> --}}
                                                    @php
                                                        $rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
                                                        $rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
                                                    @endphp
                                                    @for($i=1; $i<=5; $i++)
                                                        @if($rate>=$i)
                                                            <i class="yellow fa fa-star"></i>
                                                        @else
                                                        <i class="fa fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <a href="#"> ({{$rate_count}} customer review)</a>
                                            </div>
                                            <div class="quickview-stock">
                                                @if($product->stock >0)
                                                <span><i class="fa fa-check-circle-o"></i> {{$product->stock}} in stock</span>
                                                @else
                                                <span><i class="fa fa-times-circle-o text-danger"></i> {{$product->stock}} out stock</span>
                                                @endif
                                            </div>
                                        </div>
                                        @php
                                            $after_discount=($product->price-($product->price*$product->discount)/100);
                                        @endphp
                                            <h3><small><del class="text-muted">{{Helper::formatCurrency($product->price)}}</del></small>    {{Helper::formatCurrency($after_discount)}}  </h3>
                                        <div class="quickview-peragraph">
                                            <p>{!! html_entity_decode($product->summary) !!}</p>
                                        </div>
                                        @if($product->size)
                                            <div class="size">
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <h5 class="title">Size</h5>
                                                        <select>
                                                            @php
                                                            $sizes=explode(',',$product->size);
                                                            // dd($sizes);
                                                            @endphp
                                                            @foreach($sizes as $size)
                                                                <option>{{$size}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {{-- <div class="col-lg-6 col-12">
                                                        <h5 class="title">Color</h5>
                                                        <select>
                                                            <option selected="selected">orange</option>
                                                            <option>purple</option>
                                                            <option>black</option>
                                                            <option>pink</option>
                                                        </select>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        @endif
                                        <form action="{{route('single-add-to-cart')}}" method="POST" class="mt-4">
                                            @csrf
                                            <div class="quantity">
                                                <!-- Input Order -->
                                                <div class="input-group">
                                                    <div class="button minus">
                                                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                            <i class="ti-minus"></i>
                                                        </button>
                                                    </div>
													<input type="hidden" name="slug" value="{{$product->slug}}">
                                                    <input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1">
                                                    <div class="button plus">
                                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                                            <i class="ti-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!--/ End Input Order -->
                                            </div>
                                            <div class="add-to-cart">
                                                <button type="submit" class="btn">Add to cart</button>
                                            </div>
                                        </form>
                                        <div class="default-social"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    @endforeach
@endif
<!-- Modal end -->
@endsection

@push('styles')
    <style>
        /* Banner Sliding */
        #Gslider .carousel-inner {
        background: #000000;
        color:black;
        }

        #Gslider .carousel-inner{
        height: 550px;
        }
        #Gslider .carousel-inner img{
            width: 100% !important;
            opacity: .8;
        }

        #Gslider .carousel-inner .carousel-caption {
        bottom: 60%;
        }

        #Gslider .carousel-inner .carousel-caption h1 {
        font-size: 50px;
        font-weight: bold;
        line-height: 100%;
        color: #F7941D;
        }

        #Gslider .carousel-inner .carousel-caption p {
        font-size: 18px;
        color: black;
        margin: 28px 0 28px 0;
        }

        #Gslider .carousel-indicators {
        bottom: 70px;
        }

    /* Product Card Styles */
    .single-product {
        border: 1px solid #eaeaea;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        background: #fff;
        margin-bottom: 30px;
        position: relative;
    }
    
    .single-product:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-color: #000000;
    }
    
    .product-img {
        position: relative;
        overflow: hidden;
    }
    
    .product-img img {
        width: 100%;
        height: 230px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .single-product:hover .product-img img {
        transform: scale(1.05);
    }
    
    /* Discount Badge */
    .discount-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 5;
        background: #ff4444;
        color: white;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
    }
    
    /* Product Content */
    .product-content {
        padding: 20px;
    }
    
    .product-category {
        margin-bottom: 8px;
    }
    
    .category-badge {
        background: #f8f9fa;
        color: #6c757d;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .product-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 0px;
        line-height: 1.0;
        min-height: 32px;
    }
    
    .product-title a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .product-title a:hover {
        color: #F7941D;
    }
    
    /* Product Rating */
    .product-rating {
        display: flex;
        align-items: center;
        margin-bottom: 2px;
    }
    
    .stars {
        display: flex;
        align-items: center;
        margin-right: 8px;
    }
    
    .stars i {
        font-size: 14px;
        color: #ffc107;
        margin-right: 2px;
    }
    
    .stars .far {
        color: #ddd;
    }
    
    .stars .fas.fa-star-half-alt {
        color: #ffc107;
    }
    
    .rating-count {
        font-size: 12px;
        color: #6c757d;
    }
    
    /* Product Price */
    .product-price {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 2px;
        margin-bottom: 2px;
    }
    
    .current-price {
        font-size: 18px;
        font-weight: 700;
        color: #F7941D;
    }
    
    .old-price {
        font-size: 14px;
        color: #999;
        text-decoration: line-through;
    }
    
    /* Stock Status */
    .stock-status {
        font-size: 13px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    .in-stock {
        color: #28a745;
    }
    
    .in-stock i {
        color: #28a745;
    }
    
    .out-of-stock {
        color: #dc3545;
    }
    
    .out-of-stock i {
        color: #dc3545;
    }
    
    /* Product Actions - Rounded Buttons */
    .product-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }
    
    .btn-add-to-cart, .btn-view-details {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 12px 6px;
        border-radius: 25px;
        text-decoration: none;
        font-size: 11px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        text-align: center;
    }
    
    /* Add to Cart Button - Normal State */
    .btn-add-to-cart {
        background: #f4a13d;
        color: white !important;
        border: 1px solid #F7941D;
    }
    
    /* Add to Cart Button - Hover State */
    .btn-add-to-cart:hover {
        background: #000000 !important;
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        border-color: #000000;
    }
    
    /* View Details Button */
    .btn-view-details {
        background: transparent;
        color: #333;
        border: 1px solid #ddd;
    }
    
    .btn-view-details:hover {
        background: #f8f9fa;
        color: #F7941D;
        border-color: #F7941D;
        transform: translateY(-2px);
    }
    
    /* Modal Styles */
    .modal-lg {
        max-width: 900px;
    }
    
    .quickview-content .product-header {
        margin-bottom: 20px;
    }
    
    .quickview-content .product-meta {
        display: flex;
        gap: 15px;
        margin-top: 5px;
    }
    
    .quickview-content .product-meta span {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 14px;
        color: #6c757d;
    }
    
    /* Rating in Modal */
    .quickview-ratting {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    
    .quickview-ratting .stars {
        margin-right: 10px;
    }
    
    .quickview-ratting .stars i {
        font-size: 16px;
        color: #ffc107;
    }
    
    .quickview-ratting .stars .far {
        color: #ddd;
    }
    
    .quickview-ratting .stars .fas.fa-star-half-alt {
        color: #ffc107;
    }
    
    .quickview-stock {
        font-size: 14px;
    }
    
    .size-options {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    
    .size-option {
        position: relative;
    }
    
    .size-option input {
        display: none;
    }
    
    .size-option span {
        display: inline-block;
        padding: 8px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .size-option input:checked + span {
        border-color: #F7941D;
        background: #F7941D;
        color: white;
    }
    
    .quantity-input-group {
        display: flex;
        align-items: center;
        max-width: 150px;
    }
    
    .qty-btn {
        width: 40px;
        height: 40px;
        border: 1px solid #ddd;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        border-radius: 4px;
    }
    
    .qty-btn:hover {
        background: #f8f9fa;
        border-color: #F7941D;
        color: #F7941D;
    }
    
    .qty-input {
        width: 60px;
        height: 40px;
        border: 1px solid #ddd;
        border-left: none;
        border-right: none;
        text-align: center;
    }
    
    /* Modal Action Buttons - Rounded */
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .action-buttons .btn {
        flex: 1;
        min-width: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 14px 20px;
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    /* Modal Add to Cart Button */
    .btn-add-to-cart-modal {
        background: #57534d;
        color: white !important;
        border: 1px solid #F7941D;
    }
    
    .btn-add-to-cart-modal:hover {
        background: #000000 !important;
        color: white !important;
        border-color: #000000;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    /* Buy Now Button */
    .btn-buy-now {
        background: transparent;
        color: #F7941D;
        border: 1px solid #F7941D;
    }
    
    .btn-buy-now:hover {
        background: #F7941D;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(247, 148, 29, 0.3);
    }
    
    /* Pagination */
    .pagination {
        display: inline-flex;
    }
    
    .filter_button {
        text-align: center;
        background: #F7941D;
        padding: 10px 20px;
        margin-top: 10px;
        color: white;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .filter_button:hover {
        background: #e6891c;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(247, 148, 29, 0.3);
    }
    
    /* No Products */
    .no-products {
        padding: 60px 20px;
    }
    
    .no-products i {
        font-size: 80px;
        color: #eee;
        margin-bottom: 20px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- Add Font Awesome for star icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script>

        /*==================================================================
        [ Isotope ]*/
        var $topeContainer = $('.isotope-grid');
        var $filter = $('.filter-tope-group');

        function updateNoItemsMessage(container) {
            var $container = $(container);
            var iso = $container.data('isotope');
            if (!iso) {
                return;
            }

            var filteredCount = (iso.filteredItems || []).length;
            var $message = $container.find('.no-items-available');
            if (!$message.length) {
                return;
            }

            if (filteredCount === 0) {
                $message.show();
            } else {
                $message.hide();
            }
        }

        // filter items on button click
        $filter.each(function () {
            $filter.on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $topeContainer.isotope({filter: filterValue});
            });

        });

        // init Isotope
        $(window).on('load', function () {
            var $grid = $topeContainer.each(function () {
                $(this).isotope({
                    itemSelector: '.isotope-item',
                    layoutMode: 'fitRows',
                    percentPosition: true,
                    animationEngine : 'best-available',
                    masonry: {
                        columnWidth: '.isotope-item'
                    }
                });

                $(this).on('arrangeComplete', function () {
                    updateNoItemsMessage(this);
                });

                // initial state
                updateNoItemsMessage(this);
            });
        });

        var isotopeButton = $('.filter-tope-group button');

        $(isotopeButton).each(function(){
            $(this).on('click', function(){
                for(var i=0; i<isotopeButton.length; i++) {
                    $(isotopeButton[i]).removeClass('how-active1');
                }

                $(this).addClass('how-active1');
            });
        });
    </script>
    <script>
         function cancelFullScreen(el) {
            var requestMethod = el.cancelFullScreen||el.webkitCancelFullScreen||el.mozCancelFullScreen||el.exitFullscreen;
            if (requestMethod) { // cancel full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
        }

        function requestFullScreen(el) {
            // Supports most browsers and their versions.
            var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;

            if (requestMethod) { // Native full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
            return false
        }
    </script>

@endpush
