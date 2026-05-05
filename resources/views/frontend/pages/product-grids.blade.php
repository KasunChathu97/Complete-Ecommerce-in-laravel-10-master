@extends('frontend.layouts.master')

@section('title','DL || PRODUCT PAGE')

@section('main-content')
	<!-- Breadcrumbs 
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="blog-single.html">Shop Grid</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
 End Breadcrumbs -->

    <!-- Product Style -->
    <form action="{{route('shop.filter')}}" method="POST">
        @csrf
        <input type="hidden" name="view" value="grid">
        <section class="product-area shop-sidebar shop section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="shop-sidebar">
                                <!-- Single Widget -->
                                <div class="single-widget category">
                                    <h3 class="title">Categories</h3>
                                    <ul class="categor-list">
										@php
											$menu=App\Models\Category::getAllParentWithChild();
										@endphp
										@if($menu)
										<li>
											@foreach($menu as $cat_info)
													@if($cat_info->child_cat->count()>0)
														<li><a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a>
															<ul>
																@foreach($cat_info->child_cat as $sub_menu)
																	<li><a href="{{route('product-sub-cat',[$cat_info->slug,$sub_menu->slug])}}">{{$sub_menu->title}}</a></li>
																@endforeach
															</ul>
														</li>
													@else
														<li><a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a></li>
													@endif
											@endforeach
										</li>
										@endif
                                    </ul>
                                </div>
                                <!--/ End Single Widget -->
                                <!-- Availability Filter -->
                                <div class="single-widget availability">
                                    <h3 class="title">Availability</h3>
                                    <ul class="categor-list">
                                        <li>
                                            <label><input type="checkbox" name="availability[]" value="in_stock" @if(!empty(request('availability')) && in_array('in_stock', (array)request('availability'))) checked @endif> In Stock</label>
                                        </li>
                                        <li>
                                            <label><input type="checkbox" name="availability[]" value="out_of_stock" @if(!empty(request('availability')) && in_array('out_of_stock', (array)request('availability'))) checked @endif> Out of Stock</label>
                                        </li>
                                        <li style="margin-top: 10px;">
                                            <button type="submit" class="filter_button">Filter</button>
                                        </li>
                                    </ul>
                                </div>
                                <!--/ End Availability Filter -->
                                <!-- Free Shipping Filter -->
                                <div class="single-widget free-shipping">
                                    <h3 class="title">Shipping</h3>
                                    <ul class="categor-list">
                                        <li>
                                            <label>
                                                <input type="checkbox" name="free_shipping" value="1" @if(request('free_shipping')) checked @endif>
                                                Free Shipping
                                            </label>
                                        </li>
                                        <li style="margin-top: 10px;">
                                            <button type="submit" class="filter_button">Filter</button>
                                        </li>
                                    </ul>
                                </div>
                                <!--/ End Free Shipping Filter -->
                                <!-- Shop By Price -->
                                    <div class="single-widget range">
                                        <h3 class="title">Shop by Price</h3>
                                        <div class="price-filter">
                                            <div class="price-filter-inner">
                                                @php
                                                    $max=DB::table('products')->max('price');
                                                @endphp
                                                <div id="slider-range" data-min="0" data-max="{{$max}}"></div>
                                                <div class="product_filter">
                                                <button type="submit" class="filter_button">Filter</button>
                                                <div class="label-input">
                                                    <span>Range:</span>
                                                    <input style="" type="text" id="amount" readonly/>
                                                    <input type="hidden" name="price_range" id="price_range" value="@if(!empty($_GET['price'])){{$_GET['price']}}@endif"/>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Shop By Price -->
                                <!-- Single Widget -->
                                <div class="single-widget recent-post">
                                    <h3 class="title">Recent post</h3>
                                    @foreach($recent_products as $product)
                                        <!-- Single Post -->
                                        @php
                                            $photo=explode(',',$product->photo);
                                            $after_discount = $product->price - ($product->price * $product->discount / 100);
                                        @endphp
                                        <div class="single-post first">
                                            <div class="image">
                                                <img src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                            </div>
                                            <div class="content">
                                                <h5><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h5>
                                                @if($product->discount)
                                                    <div class="discount-below-image" style="margin-top:4px;text-align:left;">
                                                        <span class="badge badge-warning" style="font-size:0.95rem;padding:4px 12px;background:#F7941D;color:#fff;">{{$product->discount}}% Off</span>
                                                    </div>
                                                    <p class="price mb-0"><span style="color:#e74c3c;font-weight:600;">{{ Helper::formatCurrency($after_discount, 2) }}</span> <del class="text-muted" style="padding-left:4%">{{ Helper::formatCurrency($product->price, 2) }}</del></p>
                                                @else
                                                    <p class="price mb-0"><span style="color:#222;font-weight:600;">{{ Helper::formatCurrency($product->price, 2) }}</span></p>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- End Single Post -->
                                    @endforeach
                                </div>
                                <!--/ End Single Widget -->
                                <!-- Single Widget -->
                                <div class="single-widget category">
                                    <h3 class="title">Brands</h3>
                                    <ul class="categor-list">
                                        @php
                                            $brands=DB::table('brands')->orderBy('title','ASC')->where('status','active')->get();
                                        @endphp
                                        @foreach($brands as $brand)
                                            <li><a href="{{route('product-brand',$brand->slug)}}">{{$brand->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!--/ End Single Widget -->
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="row">
                            <div class="col-12">
                                <!-- Shop Top -->
                                <div class="shop-top">
                                    <div class="shop-shorter">
                                        <div class="single-shorter">
                                            <label>Show :</label>
                                            <select class="show" name="show" onchange="this.form.submit();">
                                                <option value="">Default</option>
                                                <option value="9" @if(!empty($_GET['show']) && $_GET['show']=='9') selected @endif>09</option>
                                                <option value="15" @if(!empty($_GET['show']) && $_GET['show']=='15') selected @endif>15</option>
                                                <option value="21" @if(!empty($_GET['show']) && $_GET['show']=='21') selected @endif>21</option>
                                                <option value="30" @if(!empty($_GET['show']) && $_GET['show']=='30') selected @endif>30</option>
                                            </select>
                                        </div>
                                        <div class="single-shorter">
                                            <label>Sort By :</label>
                                            <select class='sortBy' name='sortBy' onchange="this.form.submit();">
                                                <option value="">Default</option>
                                                <option value="title" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='title') selected @endif>Name</option>
                                                <option value="price" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='price') selected @endif>Price</option>
                                                <option value="category" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='category') selected @endif>Category</option>
                                                <option value="brand" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='brand') selected @endif>Brand</option>
                                            </select>
                                        </div>
                                    </div>
                                    <ul class="view-mode">
                                        <li class="active"><a href="javascript:void(0)"><i class="fa fa-th-large"></i></a></li>
                                        <li><a href="{{route('product-lists')}}"><i class="fa fa-th-list"></i></a></li>
                                    </ul>
                                </div>
                                <!--/ End Shop Top -->
                            </div>
                        </div>
                        <div class="row">
                            @if(count($products)>0)
                                @foreach($products as $product)
                                    <div class="col-lg-4 col-md-6 col-12">
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
                                                    @endphp
                                                    @if($product->discount)
                                                        <span class="current-price">{{ Helper::formatCurrency($after_discount, 2) }}</span>
                                                        <span class="old-price">{{ Helper::formatCurrency($product->price, 2) }}</span>
                                                    @else
                                                        <span class="current-price">{{ Helper::formatCurrency($product->price, 2) }}</span>
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

                                                    @if(!empty($product->free_shipping) || !empty($product->free_shipping_enabled))
                                                        <span class="free-shipping-text">Free Shipping</span>
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
                            @else
                                <div class="col-12 text-center py-5">
                                    <div class="no-products">
                                        <i class="ti-package" style="font-size: 60px; color: #ddd;"></i>
                                        <h4 class="text-muted mt-3">No products found</h4>
                                        <p class="text-muted">Try adjusting your search or filter to find what you're looking for.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-12 justify-content-center d-flex">
                                {{$products->appends($_GET)->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <!--/ End Product Style 1  -->

    <!-- Modal -->
    @if($products)
        @foreach($products as $key=>$product)
            <div class="modal fade" id="{{$product->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Quick View: {{$product->title}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row no-gutters">
                                <!-- Product Images -->
                                <div class="col-lg-6 col-md-12">
                                    <div class="product-gallery">
                                        <div class="quickview-slider-active">
                                            @php
                                                $photo=explode(',',$product->photo);
                                            @endphp
                                            @foreach($photo as $data)
                                                <div class="single-slider">
                                                    <img src="{{$data}}" alt="{{$data}}" class="img-fluid">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Product Details -->
                                <div class="col-lg-6 col-md-12">
                                    <div class="quickview-content">
                                        <!-- Product Header -->
                                        <div class="product-header">
                                            <h2 class="product-title">{{$product->title}}</h2>
                                            <div class="product-meta">
                                                <span class="product-category">
                                                    <i class="ti-tag"></i>
                                                    {{$product->cat_info->title ?? ''}}
                                                </span>
                                                @if($product->brand)
                                                    <span class="product-brand">
                                                        <i class="ti-flag-alt"></i>
                                                        {{$product->brand->title ?? ''}}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- Rating & Stock -->
                                        <div class="quickview-ratting-review mb-3">
                                            @php
                                                $rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
                                                $rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
                                            @endphp
                                            <div class="quickview-ratting">
                                                <div class="stars">
                                                    @if($rate > 0)
                                                        @for($i=1; $i<=5; $i++)
                                                            @if($rate>=$i)
                                                                <i class="fas fa-star"></i>
                                                            @elseif($rate > ($i - 0.5))
                                                                <i class="fas fa-star-half-alt"></i>
                                                            @else
                                                                <i class="far fa-star"></i>
                                                            @endif
                                                        @endfor
                                                    @else
                                                        @for($i=1; $i<=5; $i++)
                                                            <i class="far fa-star"></i>
                                                        @endfor
                                                    @endif
                                                </div>
                                                @if($rate_count > 0)
                                                    <span class="rating-count">({{$rate_count}} reviews)</span>
                                                @else
                                                    <span class="rating-count">No reviews yet</span>
                                                @endif
                                            </div>
                                            <div class="quickview-stock">
                                                @if($product->stock >0)
                                                    <span class="stock-status in-stock">
                                                        <i class="fas fa-check-circle"></i>
                                                        In Stock ({{$product->stock}} available)
                                                    </span>
                                                @else
                                                    <span class="stock-status out-of-stock">
                                                        <i class="fas fa-times-circle"></i>
                                                        Out of Stock
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- Price -->
                                        @php
                                            $after_discount=($product->price-($product->price*$product->discount)/100);
                                        @endphp
                                        <div class="product-price mb-4">
                                            @if($product->discount)
                                                <span class="current-price h3">{{ Helper::formatCurrency($after_discount, 2) }}</span>
                                                <span class="old-price text-muted">{{ Helper::formatCurrency($product->price, 2) }}</span>
                                                <span class="discount-badge">Save {{$product->discount}}%</span>
                                            @else
                                                <span class="current-price h3">{{ Helper::formatCurrency($product->price, 2) }}</span>
                                            @endif
                                        </div>
                                        
                                        <!-- Summary -->
                                        <div class="quickview-peragraph mb-4">
                                            <p>{!! html_entity_decode($product->summary) !!}</p>
                                        </div>
                                        
                                        <!-- Size Selection -->
                                        @if($product->size)
                                            <div class="size-selection mb-4">
                                                <h6>Size:</h6>
                                                <div class="size-options">
                                                    @php
                                                        $sizes=explode(',',$product->size);
                                                    @endphp
                                                    @foreach($sizes as $size)
                                                        <label class="size-option">
                                                            <input type="radio" name="size" value="{{$size}}">
                                                            <span>{{$size}}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <!-- Add to Cart Form -->
                                        <form action="{{route('single-add-to-cart')}}" method="POST" class="add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="slug" value="{{$product->slug}}">
                                            
                                            <!-- Quantity -->
                                            <div class="quantity-section mb-4">
                                                <h6>Quantity:</h6>
                                                <div class="quantity-input-group">
                                                    <button type="button" class="qty-btn qty-minus" onclick="decreaseQty()">
                                                        <i class="ti-minus"></i>
                                                    </button>
                                                    <input type="number" name="quant[1]" class="qty-input" value="1" min="1" max="{{$product->stock}}">
                                                    <button type="button" class="qty-btn qty-plus" onclick="increaseQty()">
                                                        <i class="ti-plus"></i>
                                                    </button>
                                                </div>
                                                <span class="available-stock text-muted">
                                                    {{$product->stock}} items available
                                                </span>
                                            </div>
                                            
                                            <!-- Action Buttons -->
                                            <div class="action-buttons">
                                                <button type="submit" class="btn btn-add-to-cart-modal">
                                                    Add to Cart
                                                </button>
                                                <button type="button" class="btn btn-buy-now">
                                                    Buy Now
                                                </button>
                                            </div>
                                        </form>
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
        border-color: #F7941D;
    }
    
    .product-img {
        position: relative;
        overflow: hidden;
    }
    
    .product-img img {
        width: 100%;
        height: 250px;
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

    /* Free Shipping (text next to stock) */
    .free-shipping-text {
        margin-left: auto;
        color: #007bff;
        font-weight: 600;
        font-size: 13px;
        line-height: 1;
        white-space: nowrap;
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
        margin-bottom: 10px;
        line-height: 1.4;
        min-height: 44px;
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
        margin-bottom: 10px;
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
        gap: 8px;
        margin-bottom: 10px;
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
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .stock-status .in-stock,
    .stock-status .out-of-stock {
        display: inline-flex;
        align-items: center;
        gap: 6px;
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
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        text-align: center;
    }
    
    /* Add to Cart Button - Normal State */
    .btn-add-to-cart {
        background: #F7941D;
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
        background: #F7941D;
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
    // Quantity controls for modal
    function increaseQty() {
        const input = document.querySelector('.qty-input');
        let value = parseInt(input.value);
        const max = parseInt(input.max);
        if (value < max) {
            input.value = value + 1;
        }
    }
    
    function decreaseQty() {
        const input = document.querySelector('.qty-input');
        let value = parseInt(input.value);
        const min = parseInt(input.min);
        if (value > min) {
            input.value = value - 1;
        }
    }
    
    // Price range slider
    $(document).ready(function(){
        if ($("#slider-range").length > 0) {
            const max_value = parseInt($("#slider-range").data('max')) || 500;
            const min_value = parseInt($("#slider-range").data('min')) || 0;
            const currency = $("#slider-range").data('currency') || '';
            let price_range = min_value+'-'+max_value;
            
            if($("#price_range").length > 0 && $("#price_range").val()){
                price_range = $("#price_range").val().trim();
            }
            
            let price = price_range.split('-');
            $("#slider-range").slider({
                range: true,
                min: min_value,
                max: max_value,
                values: price,
                slide: function (event, ui) {
                    $("#amount").val(currency + ui.values[0] + " - " + currency + ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
        }
        
        if ($("#amount").length > 0) {
            const m_currency = $("#slider-range").data('currency') || '';
            $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
                "  -  " + m_currency + $("#slider-range").slider("values", 1));
        }
    });
    
    // Add to cart animation
    document.addEventListener('DOMContentLoaded', function() {
        const cartButtons = document.querySelectorAll('.btn-add-to-cart, .btn-add-to-cart-modal');
        cartButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Only animate if it's not a modal button with form submission
                if (this.tagName === 'A' && this.href) {
                    e.preventDefault();
                    const originalHTML = this.innerHTML;
                    const originalBg = this.style.background;
                    
                    // Show loading/added state
                    this.innerHTML = 'Adding...';
                    this.style.background = '#000000';
                    this.style.cursor = 'wait';
                    
                    // Simulate API call or redirect
                    setTimeout(() => {
                        window.location.href = this.href;
                    }, 800);
                }
            });
        });
    });
</script>
@endpush