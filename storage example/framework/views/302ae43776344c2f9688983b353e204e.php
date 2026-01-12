
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
								<a href="index.html"><img src="<?php echo e(asset('backend/img/logo3.png')); ?>" alt="#" style="max-width:120px;height:auto;"></a>
							</div>
							<?php
								$settings=DB::table('settings')->get();
							?>
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
								<li><a href="<?php echo e(route('about-us')); ?>">About Us</a></li>
								<li><a href="#">Faq</a></li>
								<li><a href="#">Terms & Conditions</a></li>
								<li><a href="<?php echo e(route('contact')); ?>">Contact Us</a></li>
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
							<?php
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
							?>
							<!-- Single Widget -->
							<div class="contact">
								<ul>
									<?php if($setting): ?>
										<li><?php echo e(data_get($setting,'address')); ?></li>
										<li><?php echo e(data_get($setting,'email')); ?></li>
										<li><?php echo e(data_get($setting,'phone')); ?></li>
									<?php else: ?>
										<li>Delimach Lanka (Pvt) Ltd, 555/22B, Ranmuthugala, Kadawatha</li>
										<li>eshop@gmail.com</li>
										<li>+94 77 782 0662</li>
									<?php endif; ?>
								</ul>
							</div>

							<div class="mt-2">
								<ul class="social-icon">
									<li>
										<a class="social-link social-facebook" href="<?php echo e($facebookHref); ?>" <?php if($facebook): ?>target="_blank" rel="noopener noreferrer"<?php endif; ?> aria-label="Facebook">
											<i class="fa fa-facebook"></i>
										</a>
									</li>
									<li>
										<a class="social-link social-instagram" href="<?php echo e($instagramHref); ?>" <?php if($instagram): ?>target="_blank" rel="noopener noreferrer"<?php endif; ?> aria-label="Instagram">
											<i class="fa fa-instagram"></i>
										</a>
									</li>
									<li>
										<a class="social-link social-whatsapp" href="<?php echo e($whatsappHref); ?>" <?php if($whatsapp): ?>target="_blank" rel="noopener noreferrer"<?php endif; ?> aria-label="WhatsApp">
											<i class="fa fa-whatsapp"></i>
										</a>
									</li>
									<li>
										<a class="social-link social-youtube" href="<?php echo e($youtubeHref); ?>" <?php if($youtube): ?>target="_blank" rel="noopener noreferrer"<?php endif; ?> aria-label="YouTube">
											<i class="fa fa-youtube"></i>
										</a>
									</li>
									<li>
										<a class="social-link social-twitter" href="<?php echo e($twitterHref); ?>" <?php if($twitter): ?>target="_blank" rel="noopener noreferrer"<?php endif; ?> aria-label="Twitter / X">
											<i class="fa fa-twitter"></i>
										</a>
									</li>
								</ul>
							</div>
							<!-- End Single Widget -->
							
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
								<p>Copyright © <?php echo e(date('Y')); ?> <a href="https://github.com/Prajwal100" target="_blank">Prajwal Rai</a>  -  All Rights Reserved.</p>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="right">
								<img src="<?php echo e(asset('backend/img/payments.png')); ?>" alt="#">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- /End Footer Area -->
 
	<!-- Jquery -->
    <script src="<?php echo e(asset('frontend/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/jquery-migrate-3.0.0.js')); ?>"></script>
	<script src="<?php echo e(asset('frontend/js/jquery-ui.min.js')); ?>"></script>
	<!-- Popper JS -->
	<script src="<?php echo e(asset('frontend/js/popper.min.js')); ?>"></script>
	<!-- Bootstrap JS -->
	<script src="<?php echo e(asset('frontend/js/bootstrap.min.js')); ?>"></script>
	<!-- Color JS -->
	<script src="<?php echo e(asset('frontend/js/colors.js')); ?>"></script>
	<!-- Slicknav JS -->
	<script src="<?php echo e(asset('frontend/js/slicknav.min.js')); ?>"></script>
	<!-- Owl Carousel JS -->
	<script src="<?php echo e(asset('frontend/js/owl-carousel.js')); ?>"></script>
	<!-- Magnific Popup JS -->
	<script src="<?php echo e(asset('frontend/js/magnific-popup.js')); ?>"></script>
	<!-- Waypoints JS -->
	<script src="<?php echo e(asset('frontend/js/waypoints.min.js')); ?>"></script>
	<!-- Countdown JS -->
	<script src="<?php echo e(asset('frontend/js/finalcountdown.min.js')); ?>"></script>
	<!-- Nice Select JS -->
	<script src="<?php echo e(asset('frontend/js/nicesellect.js')); ?>"></script>
	<!-- Flex Slider JS -->
	<script src="<?php echo e(asset('frontend/js/flex-slider.js')); ?>"></script>
	<!-- ScrollUp JS -->
	<script src="<?php echo e(asset('frontend/js/scrollup.js')); ?>"></script>
	<!-- Onepage Nav JS -->
	<script src="<?php echo e(asset('frontend/js/onepage-nav.min.js')); ?>"></script>
	
	<script src="<?php echo e(asset('frontend/js/isotope/isotope.pkgd.min.js')); ?>"></script>
	<!-- Easing JS -->
	<script src="<?php echo e(asset('frontend/js/easing.js')); ?>"></script>

	<!-- Active JS -->
	<script src="<?php echo e(asset('frontend/js/active.js')); ?>"></script>

	
	<?php echo $__env->yieldPushContent('scripts'); ?>
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
	  </script><?php /**PATH D:\Intern-Job\Complete-Ecommerce-in-laravel-10-master\resources\views/frontend/layouts/footer.blade.php ENDPATH**/ ?>