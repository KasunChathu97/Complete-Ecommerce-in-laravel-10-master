<header class="header shop">
                            <style>
                                body {
                                    background: #ffffff !important;
                                }
                            </style>
                        <style>
                            /* Navigation bar white, menu letters black */
                            .header-inner, .menu-area, .navbar, .navbar-collapse {
                                background: #fff !important;
                            }
                            .main-menu > li > a, .main-menu > li {
                                color: #000 !important;
                            }
                            /* Black line between header and nav */
                            .header-inner {
                                border-top: 2.5px solid #bbb;
                            }
                        </style>
                    <style>
                        /* Navigation bar white, menu letters black */
                        .header-inner, .menu-area, .navbar, .navbar-collapse {
                            background: #fff !important;
                        }
                        .main-menu > li > a, .main-menu > li {
                            color: #000 !important;
                        }
                    </style>
                <style>
                    /* Add to Cart and Wishlist icons in header */
                    .right-bar .single-icon i.fa-heart-o,
                    .right-bar .single-icon i.ti-bag {
                        color: #000 !important;
                    }
                    /* Search bar border dark black */
                    .search-bar input[type="search"],
                    .search-form input[type="text"] {
                        border: 2px solid #111 !important;
                    }
                </style>
            <style>
                .topbar i {
                    color: #000 !important;
                }
                .topbar .ti-email + a:hover {
                    color: #afc9f3 !important;
                }
            </style>
        <style>
            .topbar i {
                color: #000 !important;
            }
        </style>
    <!-- Topbar -->
    <div class="topbar" style="background:#f7941d">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            @php
                                $settings=DB::table('settings')->get();
                                
                            @endphp
                            <li><i class="ti-headphone-alt"></i>@foreach($settings as $data) {{$data->phone}} @endforeach</li>
                            <li><i class="ti-email"></i> @foreach($settings as $data) <a href="mailto:{{$data->email}}">{{$data->email}}</a> @endforeach</li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                        <li><i class="ti-location-pin"></i> <a href="{{route('order.track')}}">Track Order</a></li>
                            {{-- <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li> --}}
                            @auth 
                                @if(Auth::user()->role=='admin')
                                    <li><i class="ti-user"></i> <a href="{{route('user')}}"  target="_blank">Dashboard</a></li>
                                @else 
                                    <li><i class="ti-user"></i> <a href="{{route('user')}}"  target="_blank">Dashboard</a></li>
                                @endif
                                <li><i class="ti-power-off"></i> <a href="{{route('user.logout')}}">Logout</a></li>

                            @else
                                <li><i class="ti-power-off"></i><a href="{{route('login.form')}}">Login /</a> <a href="{{route('register.form')}}">Register</a></li>
                            @endauth
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div class="middle-inner" style="background:#ffff">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        @php
                            $settings=DB::table('settings')->get();
                        @endphp                    
                        <a href="{{route('home')}}"><img src="@foreach($settings as $data) {{$data->logo}} @endforeach" alt="#" style="max-width:60px;height:auto;"></a>
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Search here..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <form method="POST" action="{{route('product.search')}}" style="width:100%;display:flex;">
                                @csrf
                                <input name="search" placeholder="Search Products Here....." type="search" style="flex:1;">
                                <button class="btnn" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Search Form -->
                        <div class="sinlge-bar shopping">
                            @php 
                                $total_prod=0;
                                $total_amount=0;
                            @endphp
                           @if(session('wishlist'))
                                @foreach(session('wishlist') as $wishlist_items)
                                    @php
                                        $total_prod+=$wishlist_items['quantity'];
                                        $total_amount+=$wishlist_items['amount'];
                                    @endphp
                                @endforeach
                           @endif
                            <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart-o"></i> <span class="total-count">{{Helper::wishlistCount()}}</span></a>
                            <!-- Shopping Item -->
                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{count(Helper::getAllProductFromWishlist())}} Items</span>
                                        <a href="{{route('wishlist')}}">View Wishlist</a>
                                    </div>
                                    <ul class="shopping-list">
                                        {{-- {{Helper::getAllProductFromCart()}} --}}
                                            @foreach(Helper::getAllProductFromWishlist() as $data)
                                                    @php
                                                        $photo=explode(',',$data->product['photo']);
                                                    @endphp
                                                    <li>
                                                        <a href="{{route('wishlist-delete',$data->id)}}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                        <a class="cart-img" href="{{route('product-detail',$data->product['slug'])}}"><img src="{{$photo[0]}}" alt="{{$data->product['title']}}"></a>
                                                        <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                                        <p class="quantity">{{$data->quantity}} x - <span class="amount">{{Helper::formatCurrency($data->price)}}</span></p>
                                                    </li>
                                            @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">{{Helper::formatCurrency(Helper::totalWishlistPrice())}}</span>
                                        </div>
                                        <a href="{{route('cart')}}" class="btn animate cta-cart">Cart</a>
                                    </div>
                                </div>
                            @endauth
                            <!--/ End Shopping Item -->
                        </div>
                        {{-- <div class="sinlge-bar">
                            <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </div> --}}
                        <div class="sinlge-bar shopping">
                            <div class="cart-dropdown-wrapper" style="position:relative;">
                                <a href="{{route('cart')}}" class="single-icon" id="cartDropdownToggle"><i class="ti-bag"></i> <span class="total-count">{{Helper::cartCount()}}</span></a>
                                <!-- Shopping Item Dropdown -->
                                @auth
                                <div class="shopping-item" id="cartDropdownMenu" style="display:none; position:absolute; right:0; top:100%; background:#fff; min-width:260px; box-shadow:0 8px 24px rgba(0,0,0,0.12); z-index:1000; border-radius:8px; padding:12px 0;">
                                    <div class="dropdown-cart-header" style="padding:0 18px 8px 18px;">
                                        <span>{{count(Helper::getAllProductFromCart())}} Items</span>
                                        <a href="{{route('cart')}}">View Cart</a>
                                    </div>
                                    <ul class="shopping-list" style="max-height:220px; overflow-y:auto;">
                                        @foreach(Helper::getAllProductFromCart() as $data)
                                            <li style="display:flex;align-items:center;padding:6px 18px;gap:10px;">
                                                @php $photo=explode(',',$data->product['photo']); @endphp
                                                <a class="cart-img" href="{{route('product-detail',$data->product['slug'])}}"><img src="{{$photo[0]}}" alt="{{$data->product['title']}}" style="width:38px;height:38px;object-fit:cover;border-radius:4px;"></a>
                                                <div style="flex:1;">
                                                    <div style="font-size:15px;font-weight:500;color:#222;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                                        {{$data->product['title']}}
                                                    </div>
                                                    <div style="font-size:13px;color:#888;">{{$data->quantity}} x {{Helper::formatCurrency($data->price)}}</div>
                                                </div>
                                                <a href="{{route('cart-delete',$data->id)}}" class="remove" title="Remove this item" style="color:#e74c3c;"><i class="fa fa-remove"></i></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom" style="padding:8px 18px 0 18px;">
                                        <div class="total" style="display:flex;justify-content:space-between;align-items:center;">
                                            <span>Total</span>
                                            <span class="total-amount">{{Helper::formatCurrency(Helper::totalCartPrice())}}</span>
                                        </div>
                                        <a href="{{route('checkout')}}" class="btn animate cta-checkout" style="width:100%;margin-top:10px;">Checkout</a>
                                    </div>
                                </div>
                                @endauth
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var toggle = document.getElementById('cartDropdownToggle');
                                    var menu = document.getElementById('cartDropdownMenu');
                                    if(toggle && menu) {
                                        toggle.addEventListener('mouseenter', function() {
                                            menu.style.display = 'block';
                                        });
                                        toggle.addEventListener('mouseleave', function() {
                                            setTimeout(function(){ menu.style.display = 'none'; }, 200);
                                        });
                                        menu.addEventListener('mouseenter', function() {
                                            menu.style.display = 'block';
                                        });
                                        menu.addEventListener('mouseleave', function() {
                                            menu.style.display = 'none';
                                        });
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">	
                                    <div class="nav-inner">	
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="{{Request::path()=='home' ? 'active' : ''}}"><a href="{{route('home')}}">Home</a></li>
                                            <li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{route('about-us')}}">About Us</a></li>
                                            <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}">Products</a></li>												
                                                {{Helper::getHeaderCategory()}}
                                            {{-- <li class="{{Request::path()=='blog' ? 'active' : ''}}"><a href="{{route('blog')}}">Blog</a></li> --}}									
                                               
                                            <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contact')}}">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>