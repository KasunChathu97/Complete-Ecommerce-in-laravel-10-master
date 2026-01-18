
	<!-- Start Footer Area -->
	<footer class="footer">
		<!-- Footer Top -->
		<div class="footer-top section">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer about">
							<div class="logo">
								<a href="index.html"><img src="{{asset('backend/img/logo3.png')}}" alt="#" style="max-width:120px;height:auto;"></a>
							</div>
							@php
								$settings=DB::table('settings')->get();
							@endphp
							<p class="text">Delimach Lanka (Pvt) Ltd,</p>
							<p class="text">555/22B,</p>
							<p class="text">Ranmuthugala,</p>
							<p class="text">Kadawatha</p>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Information</h4>
							<ul>
								<li><a href="{{route('about-us')}}">About Us</a></li>
								<li><a href="#">Faq</a></li>
								<li><a href="#">Terms & Conditions</a></li>
								<li><a href="{{route('contact')}}">Contact Us</a></li>
								<li><a href="#">Help</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Customer Service</h4>
							<ul>
								<li><a href="#">Payment Methods</a></li>
								<li><a href="#">Money-back</a></li>
								<li><a href="#">Returns</a></li>
								<li><a href="#">Shipping</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer social">
							<h4>Get In Tuch</h4>
							@php
								$setting = DB::table('settings')->first();
								$facebook = trim((string) data_get($setting, 'facebook', ''));
								$instagram = trim((string) data_get($setting, 'instagram', ''));
								$youtube = trim((string) data_get($setting, 'youtube', ''));
								$twitter = trim((string) data_get($setting, 'twitter', ''));
								$whatsapp = trim((string) data_get($setting, 'whatsapp', ''));

								$facebookHref = $facebook !== '' ? $facebook : '#';
								$instagramHref = $instagram !== '' ? $instagram : '#';
								$whatsappHref = $whatsapp !== '' ? $whatsapp : '#';
								$youtubeHref = $youtube !== '' ? $youtube : '#';
								$twitterHref = $twitter !== '' ? $twitter : '#';
							@endphp
							<!-- Single Widget -->
							<div class="contact">
								<ul>
									@if($setting)
										<li>{{data_get($setting,'address')}}</li>
										<li>{{data_get($setting,'email')}}</li>
										<li>{{data_get($setting,'phone')}}</li>
									@else
										<li>Delimach Lanka (Pvt) Ltd, 555/22B, Ranmuthugala, Kadawatha</li>
										<li>eshop@gmail.com</li>
										<li>+94 77 782 0662</li>
									@endif
								</ul>
							</div>

							<div class="mt-2">
								<ul class="social-icon">
									<li>
										<a class="social-link social-facebook" href="{{$facebookHref}}" @if($facebook)target="_blank" rel="noopener noreferrer"@endif aria-label="Facebook">
											<i class="fa fa-facebook"></i>
										</a>
									</li>
									<li>
										<a class="social-link social-instagram" href="{{$instagramHref}}" @if($instagram)target="_blank" rel="noopener noreferrer"@endif aria-label="Instagram">
											<i class="fa fa-instagram"></i>
										</a>
									</li>
									<li>
										<a class="social-link social-whatsapp" href="{{$whatsappHref}}" @if($whatsapp)target="_blank" rel="noopener noreferrer"@endif aria-label="WhatsApp">
											<i class="fa fa-whatsapp"></i>
										</a>
									</li>
									<li>
										<a class="social-link social-youtube" href="{{$youtubeHref}}" @if($youtube)target="_blank" rel="noopener noreferrer"@endif aria-label="YouTube">
											<i class="fa fa-youtube"></i>
										</a>
									</li>
									<li>
										<a class="social-link social-twitter" href="{{$twitterHref}}" @if($twitter)target="_blank" rel="noopener noreferrer"@endif aria-label="Twitter / X">
											<i class="fa fa-twitter"></i>
										</a>
									</li>
								</ul>
							</div>
							<!-- End Single Widget -->
							{{-- Removed ShareThis follow buttons --}}
						</div>
						<!-- End Single Widget -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer Top -->
		<div class="copyright">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="left">
								<p>Copyright © {{date('Y')}} <a href="https://github.com/nmdskandy" target="_blank">nmdskandy</a>  -  All Rights Reserved.</p>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="right">
								<img src="{{asset('backend/img/payments.png')}}" alt="#">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- /End Footer Area -->
 
	<!-- Jquery -->
    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery-migrate-3.0.0.js')}}"></script>
	<script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
	<!-- Popper JS -->
	<script src="{{asset('frontend/js/popper.min.js')}}"></script>
	<!-- Bootstrap JS -->
	<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
	<!-- Color JS -->
	<script src="{{asset('frontend/js/colors.js')}}"></script>
	<!-- Slicknav JS -->
	<script src="{{asset('frontend/js/slicknav.min.js')}}"></script>
	<!-- Owl Carousel JS -->
	<script src="{{asset('frontend/js/owl-carousel.js')}}"></script>
	<!-- Magnific Popup JS -->
	<script src="{{asset('frontend/js/magnific-popup.js')}}"></script>
	<!-- Waypoints JS -->
	<script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
	<!-- Countdown JS -->
	<script src="{{asset('frontend/js/finalcountdown.min.js')}}"></script>
	<!-- Nice Select JS -->
	<script src="{{asset('frontend/js/nicesellect.js')}}"></script>
	<!-- Flex Slider JS -->
	<script src="{{asset('frontend/js/flex-slider.js')}}"></script>
	<!-- ScrollUp JS -->
	<script src="{{asset('frontend/js/scrollup.js')}}"></script>
	<!-- Onepage Nav JS -->
	<script src="{{asset('frontend/js/onepage-nav.min.js')}}"></script>
	{{-- Isotope --}}
	<script src="{{asset('frontend/js/isotope/isotope.pkgd.min.js')}}"></script>
	<!-- Easing JS -->
	<script src="{{asset('frontend/js/easing.js')}}"></script>

	<!-- Active JS -->
	<script src="{{asset('frontend/js/active.js')}}"></script>

	
	@stack('scripts')
	<script>
		setTimeout(function(){
		  $('.alert').slideUp();
		},5000);
		$(function() {
		// ------------------------------------------------------- //
		// Multi Level dropdowns
		// ------------------------------------------------------ //
			$("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
				event.preventDefault();
				event.stopPropagation();

				$(this).siblings().toggleClass("show");


				if (!$(this).next().hasClass('show')) {
				$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
				}
				$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
				$('.dropdown-submenu .show').removeClass("show");
				});

			});
		});
	  </script>