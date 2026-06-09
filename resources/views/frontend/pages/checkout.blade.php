@extends('frontend.layouts.master')

@section('title','Checkout page')

@section('main-content')

    @php
        $checkoutUser = auth()->user();
        $checkoutFullName = trim((string) optional($checkoutUser)->name);
        $checkoutNameParts = preg_split('/\s+/', $checkoutFullName, -1, PREG_SPLIT_NO_EMPTY) ?: [];

        $checkoutPrefillFirstName = $checkoutNameParts[0] ?? '';
        $checkoutPrefillLastName = count($checkoutNameParts) > 1 ? implode(' ', array_slice($checkoutNameParts, 1)) : '';
        $checkoutPrefillEmail = (string) (optional($checkoutUser)->email ?? '');

        $checkoutPhoneRaw = (string) (optional($checkoutUser)->phone ?? '');
        $checkoutPhoneDigits = preg_replace('/\D+/', '', $checkoutPhoneRaw);
        if (strlen($checkoutPhoneDigits) > 10) {
            $checkoutPhoneDigits = substr($checkoutPhoneDigits, -10);
        }
        
        // Get address fields from user profile
        $checkoutAddress1 = old('address1', optional($checkoutUser)->address1 ?? '');
        $checkoutAddress2 = old('address2', optional($checkoutUser)->address2 ?? '');
        $checkoutAddress3 = old('address3', optional($checkoutUser)->address3 ?? '');
        $checkoutCity = old('city', optional($checkoutUser)->city ?? '');
        $checkoutDistrict = old('district', optional($checkoutUser)->district ?? '');
    @endphp

    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
                <form class="form" method="POST" action="{{route('cart.order')}}">
                    @csrf
                    <div class="row"> 

                        <div class="col-lg-8 col-12">
                            <div class="checkout-form">
                                <h2>Make Your Checkout Here</h2>
                                <p>Please fill in your details to complete your order</p>
                                <!-- Form -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>First Name<span>*</span></label>
                                            <input type="text" name="first_name" placeholder="Enter first name" value="{{ old('first_name', $checkoutPrefillFirstName) }}" required>
                                            @error('first_name')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Last Name<span>*</span></label>
                                            <input type="text" name="last_name" placeholder="Enter last name" value="{{ old('last_name', $checkoutPrefillLastName) }}" required>
                                            @error('last_name')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Email Address<span>*</span></label>
                                            <input type="email" name="email" placeholder="Enter email address" value="{{ old('email', $checkoutPrefillEmail) }}" required>
                                            @error('email')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Phone Number <span>*</span></label>
                                            <input type="text" name="phone" id="phone" maxlength="10" pattern="\d{10}" required value="{{ old('phone', $checkoutPhoneDigits) }}" placeholder="Enter 10 digit phone number" oninput="this.value=this.value.replace(/[^\d]/g,'').slice(0,10)">
                                            <span id="phone-error" class="text-danger" style="display:none;">Phone number must be exactly 10 digits.</span>
                                            @error('phone')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Emergency Contact<span>*</span></label>
                                            <input type="text" name="emergency_contact" id="emergency_contact" maxlength="10" pattern="\d{10}" required value="{{ old('emergency_contact') }}" placeholder="Enter emergency contact number" oninput="this.value=this.value.replace(/[^\d]/g,'').slice(0,10)">
                                            @error('emergency_contact')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Address Line 1<span>*</span></label>
                                            <input type="text" name="address1" placeholder="House/Flat No, Street Name" value="{{ $checkoutAddress1 }}" required>
                                            @error('address1')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Address Line 2<span>*</span></label>
                                            <input type="text" name="address2" placeholder="Area, Locality, Landmark" value="{{ $checkoutAddress2 }}" required>
                                            @error('address2')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Address Line 3<span>*</span></label>
                                            <input type="text" name="address3" placeholder="Additional Address Info" value="{{ $checkoutAddress3 }}" required>
                                            @error('address3')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Town / City<span>*</span></label>
                                            <input type="text" name="city" placeholder="Enter town/city name" value="{{ $checkoutCity }}" required>
                                            @error('city')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>District<span>*</span></label>
                                            @php
                                                $districtOptions = [
                                                    'Ampara',
                                                    'Anuradhapura',
                                                    'Badulla',
                                                    'Batticaloa',
                                                    'Colombo',
                                                    'Galle',
                                                    'Gampaha',
                                                    'Hambantota',
                                                    'Jaffna',
                                                    'Kalutara',
                                                    'Kandy',
                                                    'Kegalle',
                                                    'Kilinochchi',
                                                    'Kurunegala',
                                                    'Mannar',
                                                    'Matale',
                                                    'Matara',
                                                    'Monaragala',
                                                    'Mullaitivu',
                                                    'Nuwara Eliya',
                                                    'Polonnaruwa',
                                                    'Puttalam',
                                                    'Ratnapura',
                                                    'Trincomalee',
                                                    'Vavuniya',
                                                ];
                                            @endphp
                                            <select name="district" class="form-control select2" required>
                                                <option value="">Select District</option>
                                                @foreach ($districtOptions as $district)
                                                    <option value="{{ $district }}" {{ old('district', $checkoutDistrict) === $district ? 'selected' : '' }}>
                                                        {{ $district }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('district')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Form -->
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="order-details">
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <h2>CART TOTALS</h2>
                                    <div class="content">
                                        <ul>
                                            <li class="order_subtotal" data-price="{{Helper::cartSubTotal()}}">Cart Subtotal<span>{{Helper::formatCurrency(Helper::cartSubTotal())}}</span></li>
                                            <li class="shipping">
                                                Shipping Cost
                                                @php
                                                    $cartBaseQuery = \App\Models\Cart::where('user_id', auth()->user()->id)->where('order_id', null);
                                                    $cart_has_items = (clone $cartBaseQuery)->exists();
                                                    $has_non_free_shipping_product = (clone $cartBaseQuery)
                                                        ->whereHas('product', function ($q) {
                                                            $q->where(function ($sub) {
                                                                $sub->where('free_shipping', 0)->where('free_shipping_enabled', 0);
                                                            });
                                                        })
                                                        ->exists();
                                                    $all_free_shipping = $cart_has_items && !$has_non_free_shipping_product;
                                                    $cart_shipping_cost = $all_free_shipping ? 0 : (clone $cartBaseQuery)->sum('shipping_cost');
                                                @endphp
                                                <span>{{ $all_free_shipping ? 'Free' : Helper::formatCurrency($cart_shipping_cost) }}</span>
                                                <br>
                                                <small style="color:#888;">{{ $all_free_shipping ? 'Free shipping applied to all items' : 'Calculated by total weight (unit weight x quantity)' }}</small>
                                            </li>
                                            
                                            @if(session('coupon'))
                                            <li class="coupon_price" data-price="{{session('coupon')['value']}}">You Save<span>{{Helper::formatCurrency(session('coupon')['value'])}}</span></li>
                                            @endif
                                            @php
                                                $cartBaseQuery = \App\Models\Cart::where('user_id', auth()->user()->id)->where('order_id', null);
                                                $cart_has_items = (clone $cartBaseQuery)->exists();
                                                $has_non_free_shipping_product = (clone $cartBaseQuery)
                                                    ->whereHas('product', function ($q) {
                                                        $q->where(function ($sub) {
                                                            $sub->where('free_shipping', 0)->where('free_shipping_enabled', 0);
                                                        });
                                                    })
                                                    ->exists();
                                                $all_free_shipping = $cart_has_items && !$has_non_free_shipping_product;
                                                $cart_shipping_cost = $all_free_shipping ? 0 : (clone $cartBaseQuery)->sum('shipping_cost');
                                                $total_amount=Helper::cartSubTotal() + $cart_shipping_cost;
                                                if(session('coupon')){
                                                    $total_amount=$total_amount-session('coupon')['value'];
                                                }
                                            @endphp
                                            @if(session('coupon'))
                                                <li class="last" id="order_total_price">Total<span>{{Helper::formatCurrency($total_amount)}}</span></li>
                                            @else
                                                <li class="last" id="order_total_price">Total<span>{{Helper::formatCurrency($total_amount)}}</span></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <h2>Payments</h2>
                                    <div class="content">
                                        <div class="checkbox">
                                            <form-group>
                                                <input name="payment_method" type="radio" value="cod" checked> <label> Cash On Delivery</label><br>
                                            </form-group>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                                <!-- Payment Method Widget -->
                                <div class="single-widget payement">
                                    <div class="content">
                                        <img src="{{('backend/img/payment-method.png')}}" alt="#">
                                    </div>
                                </div>
                                <!--/ End Payment Method Widget -->
                                <!-- Button Widget -->
                                <div class="single-widget get-button">
                                    <div class="content">
                                        <div class="button">
                                            <button type="submit" class="btn cta-pay">proceed to checkout</button>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Button Widget -->
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </section>
    <!--/ End Checkout -->
    
    <!-- Start Shop Services Area  -->
    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Free shiping</h4>
                        <p>Orders over {{Helper::formatCurrency(10000)}}</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>Free Return</h4>
                        <p>Within 14 days returns</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Sucure Payment</h4>
                        <p>100% secure payment</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>Best Peice</h4>
                        <p>Guaranteed price</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Services -->
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/js/select2/css/select2.min.css') }}">
	<style>
        /* Keep Select2 (District) aligned with other checkout inputs */
        .select2-container{
            width: 100% !important;
        }
        .select2-container--default .select2-selection--single{
            height: 45px;
            background: #F6F7FB;
            border: 0;
            border-radius: 0;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered{
            line-height: 45px;
            padding-left: 20px;
            padding-right: 20px;
            color: #333;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow{
            height: 45px;
        }

		li.shipping{
			display: inline-flex;
			width: 100%;
			font-size: 14px;
		}
		li.shipping .input-group-icon {
			width: 100%;
			margin-left: 10px;
		}
		.input-group-icon .icon {
			position: absolute;
			left: 20px;
			top: 0;
			line-height: 40px;
			z-index: 3;
		}
		.form-select {
			height: 30px;
			width: 100%;
		}
		.form-select .nice-select {
			border: none;
			border-radius: 0px;
			height: 40px;
			background: #f6f6f6 !important;
			padding-left: 45px;
			padding-right: 40px;
			width: 100%;
		}
		.list li{
			margin-bottom:0 !important;
		}
		.list li:hover{
			background:#F7941D !important;
			color:white !important;
		}
		.form-select .nice-select::after {
			top: 14px;
		}
	</style>
@endpush

@push('scripts')
	<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
	<script>
        $(document).ready(function() {
            $("select.select2").select2({
                width: '100%',
                placeholder: "Select District"
            });
        });
  		$('select.nice-select').niceSelect();
	</script>
	<script>
		function showMe(box){
			var checkbox=document.getElementById('shipping').style.display;
			var vis= 'none';
			if(checkbox=="none"){
				vis='block';
			}
			if(checkbox=="block"){
				vis="none";
			}
			document.getElementById(box).style.display=vis;
		}
	</script>
	<script>
		$(document).ready(function(){
			$('.shipping select[name=shipping]').change(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') ); 
				let coupon = parseFloat( $('.coupon_price').data('price') ) || 0; 
                $('#order_total_price span').text('{{ Helper::currencySymbol() }} '+(subtotal + cost-coupon).toFixed(2));
			});

		});
	</script>
@endpush