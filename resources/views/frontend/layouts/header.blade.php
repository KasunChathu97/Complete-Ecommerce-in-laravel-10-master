<header class="header shop">
    <style>
                .header.shop.sticky .sticky-menu-area .menu-area {
                    background: #fff !important;
                }
        /* Reduce navbar height in normal (not sticky) view */
        .header-inner, .menu-area, .navbar, .navbar-collapse {
            min-height: 36px !important;
            height: 36px !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            transition: min-height 0.2s, height 0.2s, padding 0.2s;
        }
        .header-inner .main-menu > li > a, .navbar .main-menu > li > a {
            padding-top: 6px !important;
            padding-bottom: 6px !important;
            font-size: 15px !important;
            line-height: 24px !important;
        }
        /* When sticky/scrolled, restore original/taller height */
        body {
            background: #ffffff !important;
        }
    </style>
                        <style>
                            /* Navigation bar white, menu letters black */
                            .header-inner, .menu-area, .navbar, .navbar-collapse {
                                background: #ffffff !important;
                            }
                            .main-menu > li > a, .main-menu > li {
                                color: #000 !important;
                            }
                            /* Remove line between header and nav */
                            .header-inner {
                                border-top: none !important;
                            }
                        </style>
                    <style>
                        /* Navigation bar white, menu letters black */
                        .header-inner, .menu-area, .navbar, .navbar-collapse {
                            background: #232F3F !important;
                        }
                        .main-menu > li > a, .main-menu > li {
                            color: #ffffff !important;
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
                color: rgb(255, 255, 255) !important;
            }
        </style>
    <!-- Topbar -->
    <div class="topbar" style="background:#121921; min-height:50px;">
        <div class="container" style="max-width:100%;padding-left:12px;padding-right:12px;">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12 d-flex align-items-center">
                    <!-- Top Left with Logo -->
                    <div class="top-left d-flex align-items-center" style="gap:16px;">
                        @php
                            $settings=DB::table('settings')->get();
                        @endphp
                        <a href="{{route('home')}}" style="display:flex;align-items:center;width:100%;height:48px;">
                            <img src="@foreach($settings as $data) {{$data->logo}} @endforeach" alt="#" style="max-height:44px;max-width:60px;object-fit:contain;display:block;">
                        </a>
                        <span class="delimach-brand" style="font-size:20px;font-weight:700;letter-spacing:0.5px;margin:0 10px 0 4px;display:flex;align-items:center;">
                            <span style="color:#2F40A7;">D</span><span style="color:#fff;">elimach </span><span style="color:#FF282B;">L</span><span style="color:#fff;">anka</span>
                        </span>
                        <ul class="list-main d-flex align-items-center mb-0" style="gap:18px;">
                            <!-- <li style="margin-bottom:0;"><i class="ti-headphone-alt"></i>@foreach($settings as $data) {{$data->phone}} @endforeach</li>
                            <li style="margin-bottom:0;"><i class="ti-email"></i> @foreach($settings as $data) <a href="mailto:{{$data->email}}">{{$data->email}}</a> @endforeach</li>-->
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12 d-flex justify-content-center align-items-center">
                    <!-- Center Search Bar -->
                        <form method="POST" action="{{route('product.search')}}" class="topbar-search-form" style="width:100%;max-width:420px;margin-left:-60px;display:flex;align-items:center;background:#fff;border-radius:22px;box-shadow:0 2px 8px rgba(0,0,0,0.06);padding:2px 8px;">
                        @csrf
                        <input name="search" placeholder="Search Products Here....." type="search" style="flex:1;border:none;background:transparent;padding:8px 12px;font-size:15px;color:#222;outline:none;">
                        <button class="btnn" type="submit" style="border:none;background:#f7941d;color:#fff;padding:8px 18px;border-radius:18px;font-size:16px;"><i class="ti-search"></i></button>
                    </form>
                </div>
                <div class="col-lg-4 col-md-12 col-12 d-flex justify-content-end align-items-center">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main" style="display:flex;align-items:center;gap:18px;margin-bottom:0;">
                            <li><i class="ti-location-pin"></i> <a href="{{route('order.track')}}">Track Order</a></li>
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
                            <li style="padding:0;margin:0;">
                                <a href="{{route('cart')}}" style="color:#fff;display:flex;align-items:center;height:60px;">
                                    <i class="ti-bag" style="font-size:22px;"></i>
                                    <span style="font-weight:600;margin-left:2px;">Cart</span>
                                    <span class="total-count" style="background:#f08804;color:#232F3E;border-radius:50%;padding:2px 7px;font-size:13px;margin-left:4px;">{{Helper::cartCount()}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <!--<div class="middle-inner" style="background:#ffff">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                     Logo moved to topbar 
                     Search Form 
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                         Search Form 
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Search here..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                         End Search Form 
                    </div>
                     End Search Form 
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
                        Search Form 
                        <div class="sinlge-bar shopping">
                            @php 
                                $total_prod=0;
                                $total_amount=0;
                            @endphp
                        <div class="sinlge-bar shopping">
                            <div class="cart-dropdown-wrapper" style="position:relative;">
                                <a href="{{route('cart')}}" class="single-icon" id="cartDropdownToggle"><i class="ti-bag"></i> <span class="total-count">{{Helper::cartCount()}}</span></a>
                                Shopping Item Dropdown 
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
    </div>-->
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
        <!-- Sticky Menu Area (only visible when sticky) -->
        <div class="sticky-menu-area" style="display:none;"></div>
        <style>
            .header.shop.sticky .sticky-menu-area {
                display: block !important;
                background: #fff !important;
                box-shadow: 0 4px 18px rgba(44,62,80,0.10), 0 1.5px 4px rgba(44,62,80,0.04);
                border-radius: 0 0 16px 16px;
                transition: background 0.3s, box-shadow 0.3s, border-radius 0.3s;
                z-index: 1002;
            }
            .sticky-menu-area {
                width: 100%;
                min-height: 36px;
                position: fixed;
                top: 0;
                left: 0;
            }
            .header.shop:not(.sticky) .sticky-menu-area {
                display: none !important;
            }
        </style>
        <script>
            // Move menu content into sticky-menu-area when sticky
            document.addEventListener('DOMContentLoaded', function() {
                var header = document.querySelector('.header.shop');
                var stickyMenu = document.querySelector('.sticky-menu-area');
                var menuArea = document.querySelector('.menu-area');
                var isCloned = false;
                function updateStickyMenu() {
                    if(header.classList.contains('sticky')) {
                        if(!isCloned && menuArea && stickyMenu) {
                            stickyMenu.innerHTML = menuArea.innerHTML;
                            isCloned = true;
                        }
                    } else {
                        if(stickyMenu) stickyMenu.innerHTML = '';
                        isCloned = false;
                    }
                }
                window.addEventListener('scroll', updateStickyMenu);
                updateStickyMenu();
            });
        </script>
    <!-- Sticky: force white background for .header-inner and .menu-area -->
    <!-- Removed duplicate sticky menu-area background rules. Rely on public/css/electronics-theme.css for sticky menu-area background white. -->
</header>