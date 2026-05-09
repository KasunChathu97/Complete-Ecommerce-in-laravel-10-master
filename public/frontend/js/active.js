/* =====================================
Template Name: Eshop
Author Name: Naimur Rahman
Author URI: http://www.wpthemesgrid.com/
Description: Eshop - eCommerce HTML5 Template.
Version:1.0
========================================*/
/*=======================================
[Start Activation Code]
=========================================
	01. Mobile Menu JS
	02. Sticky Header JS
	03. Search JS
	04. Slider Range JS
	05. Home Slider JS
	06. Popular Slider JS
	07. Quick View Slider JS
	08. Home Slider 4 JS
	09. CountDown
	10. Flex Slider JS
	11. Cart Plus Minus Button
	12. Checkbox JS
	13. Extra Scroll JS
	14. Product page Quantity Counter
	15. Video Popup JS
	16. Scroll UP JS
	17. Nice Select JS
	18. Others JS
	19. Preloader JS
=========================================
[End Activation Code]
=========================================*/ 

// Service worker disabled (Laravel site; avoids stale cache + unexpected behavior)
(function($) {
    "use strict";
	function initOwl($el, options) {
		if (!$el || $el.length === 0) {
			return;
		}
		if (typeof $.fn.owlCarousel !== 'function') {
			return;
		}

		// This OwlCarousel build crashes with loop=true when there is only 1 item.
		// Disable looping when there are fewer than 2 direct child elements.
		var itemCount = $el.children().length;
		if (itemCount < 2) {
			options = $.extend({}, options, { loop: false });
		}

		try {
			$el.owlCarousel(options);
		} catch (error) {
			// Fallback: prevent carousel init failures from breaking all remaining scripts.
			// This is especially important on auth pages where JS errors can block form flow.
			try {
				$el.owlCarousel($.extend({}, options, { loop: false, items: 1 }));
			} catch (retryError) {
				if (window.console && typeof window.console.warn === 'function') {
					window.console.warn('Owl init skipped for element due to invalid state', retryError);
				}
			}
		}
	}
     $(document).on('ready', function() {	
		
		/*====================================
			Mobile Menu
		======================================*/ 	
		$('.menu').slicknav({
			prependTo:".mobile-nav",
			duration:300,
			animateIn: 'fadeIn',
			animateOut: 'fadeOut',
			closeOnClick:true,
		});
		
		/*====================================
		03. Sticky Header JS
		======================================*/ 
		jQuery(window).on('scroll', function() {
			if ($(this).scrollTop() > 200) {
				$('.header').addClass("sticky");
			} else {
				$('.header').removeClass("sticky");
			}
		});
		
		/*=======================
		  Search JS JS
		=========================*/ 
		$('.top-search a').on( "click", function(){
			$('.search-top').toggleClass('active');
		});
		
		/*=======================
		  Slider Range JS
		=========================*/ 
		// $( function() {
		// 	$( "#slider-range" ).slider({
		// 	  range: true,
		// 	  min: 0,
		// 	  max: 1000,
		// 	  values: [ 120, 250 ],
		// 	  slide: function( event, ui ) {
		// 		$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		// 	  }
		// 	});
		// 	$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
		// 	  " - $" + $( "#slider-range" ).slider( "values", 1 ) );
		// } );
		
		/*=======================
		  Home Slider JS
		=========================*/ 
		initOwl($('.home-slider'), {
			items:1,
			autoplay:true,
			autoplayTimeout:5000,
			smartSpeed: 400,
			animateIn: 'fadeIn',
			animateOut: 'fadeOut',
			autoplayHoverPause:true,
			loop:true,
			nav:true,
			merge:true,
			dots:false,
			navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
			responsive:{
				0: {
					items:1,
				},
				300: {
					items:1,
				},
				480: {
					items:2,
				},
				768: {
					items:3,
				},
				1170: {
					items:4,
				},
			}
		});
		
		/*=======================
		  Popular Slider JS
		=========================*/ 
		initOwl($('.popular-slider'), {
			items:1,
			autoplay:true,
			autoplayTimeout:5000,
			smartSpeed: 400,
			animateIn: 'fadeIn',
			animateOut: 'fadeOut',
			autoplayHoverPause:true,
			loop:true,
			nav:true,
			merge:true,
			dots:false,
			navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
			responsive:{
				0: {
					items:1,
				},
				300: {
					items:1,
				},
				480: {
					items:2,
				},
				768: {
					items:3,
				},
				1170: {
					items:4,
				},
			}
		});
		
		/*===========================
		  Quick View Slider JS
		=============================*/ 
		initOwl($('.quickview-slider-active'), {
			items:1,
			autoplay:true,
			autoplayTimeout:5000,
			smartSpeed: 400,
			autoplayHoverPause:true,
			nav:true,
			loop:true,
			merge:true,
			dots:false,
			navText: ['<i class=" ti-arrow-left"></i>', '<i class=" ti-arrow-right"></i>'],
		});
		
		/*===========================
		  Home Slider 4 JS
		=============================*/ 
		initOwl($('.home-slider-4'), {
			items:1,
			autoplay:true,
			autoplayTimeout:5000,
			smartSpeed: 400,
			autoplayHoverPause:true,
			nav:true,
			loop:true,
			merge:true,
			dots:false,
			navText: ['<i class=" ti-arrow-left"></i>', '<i class=" ti-arrow-right"></i>'],
		});
		
		/*====================================
		14. CountDown
		======================================*/ 
		$('[data-countdown]').each(function() {
			var $this = $(this),
				finalDate = $(this).data('countdown');
			$this.countdown(finalDate, function(event) {
				$this.html(event.strftime(
					'<div class="cdown"><span class="days"><strong>%-D</strong><p>Days.</p></span></div><div class="cdown"><span class="hour"><strong> %-H</strong><p>Hours.</p></span></div> <div class="cdown"><span class="minutes"><strong>%M</strong> <p>MINUTES.</p></span></div><div class="cdown"><span class="second"><strong> %S</strong><p>SECONDS.</p></span></div>'
				));
			});
		});
		
		/*====================================
		16. Flex Slider JS
		======================================*/
		(function($) {
			'use strict';	
				$('.flexslider-thumbnails').flexslider({
					animation: "slide",
					controlNav: "thumbnails",
				});
		})(jQuery);
		
		/*====================================
		  Cart Plus Minus Button
		======================================*/
		var CartPlusMinus = $('.cart-plus-minus');
		CartPlusMinus.prepend('<div class="dec qtybutton">-</div>');
		CartPlusMinus.append('<div class="inc qtybutton">+</div>');
		$(".qtybutton").on("click", function() {
			var $button = $(this);
			var oldValue = $button.parent().find("input").val();
			if ($button.text() === "+") {
				var newVal = parseFloat(oldValue) + 1;
			} else {
				// Don't allow decrementing below zero
				if (oldValue > 0) {
					var newVal = parseFloat(oldValue) - 1;
				} else {
					newVal = 1;
				}
			}
			$button.parent().find("input").val(newVal);
		});

		/*====================================
		  Cart page Quantity Counter (.btn-number)
		======================================*/
		function clampNumber(val, min, max) {
			if (isNaN(val)) return min;
			if (!isNaN(min) && val < min) return min;
			if (!isNaN(max) && val > max) return max;
			return val;
		}

		function refreshCartQtyButtons($group) {
			var $input = $group.find('input.input-number').first();
			if ($input.length === 0) return;

			var min = parseInt($input.attr('data-min'), 10);
			var max = parseInt($input.attr('data-max'), 10);
			var value = parseInt($input.val(), 10);
			if (isNaN(value)) value = min || 1;

			var $minus = $group.find(".btn-number[data-type='minus']");
			var $plus = $group.find(".btn-number[data-type='plus']");

			if ($minus.length) {
				$minus.prop('disabled', (!isNaN(min) ? value <= min : value <= 1));
			}
			if ($plus.length && !isNaN(max)) {
				$plus.prop('disabled', value >= max);
			}
		}

		$(document).on('click', '.btn-number', function (e) {
			e.preventDefault();

			var $btn = $(this);
			var type = $btn.attr('data-type');
			var field = $btn.attr('data-field');
			var $group = $btn.closest('.input-group');
			var $input = $group.find("input[name='" + field + "']");
			if ($input.length === 0) {
				$input = $group.find('input.input-number').first();
			}
			if ($input.length === 0) return;

			var min = parseInt($input.attr('data-min'), 10);
			var max = parseInt($input.attr('data-max'), 10);
			var oldValue = parseInt($input.val(), 10);
			if (isNaN(oldValue)) {
				oldValue = !isNaN(min) ? min : 1;
			}

			var newValue = oldValue;
			if (type === 'plus') {
				newValue = oldValue + 1;
			} else if (type === 'minus') {
				newValue = oldValue - 1;
			}

			newValue = clampNumber(newValue, min || 1, max);
			$input.val(newValue).trigger('change');
			refreshCartQtyButtons($group);
		});

		$(document).on('change', 'input.input-number', function () {
			var $input = $(this);
			var $group = $input.closest('.input-group');
			var min = parseInt($input.attr('data-min'), 10);
			var max = parseInt($input.attr('data-max'), 10);
			var value = parseInt($input.val(), 10);
			value = clampNumber(value, min || 1, max);
			$input.val(value);
			refreshCartQtyButtons($group);

			// Live price update (Cart page only)
			try {
				if ($input.closest('.shopping-cart').length === 0) return;
				var cartId = $input.attr('data-cart-id');
				if (!cartId) return;
				if (!window.cartLineUpdateUrl) return;

				window.__cartLineUpdateTimers = window.__cartLineUpdateTimers || {};
				if (window.__cartLineUpdateTimers[cartId]) {
					clearTimeout(window.__cartLineUpdateTimers[cartId]);
				}

				window.__cartLineUpdateTimers[cartId] = setTimeout(function () {
					var csrf = $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').first().val();
					if (!csrf) return;

					fetch(window.cartLineUpdateUrl, {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
							'Accept': 'application/json',
							'X-CSRF-TOKEN': csrf,
						},
						body: JSON.stringify({
							_token: csrf,
							cart_id: cartId,
							quantity: parseInt($input.val(), 10) || 1,
						}),
					})
						.then(function (r) { return r.json(); })
						.then(function (data) {
							if (!data || data.ok !== true) {
								if (data && data.message) {
									alert(data.message);
								}
								return;
							}

							if (data.quantity && parseInt($input.val(), 10) !== parseInt(data.quantity, 10)) {
								$input.val(parseInt(data.quantity, 10));
								refreshCartQtyButtons($group);
							}

							var $row = $input.closest('tr');
							$row.find('.cart_single_price .money').text(data.line_subtotal_formatted || '');

							$('.order_subtotal span').text(data.cart_subtotal_formatted || '');
							$('.order_subtotal').attr('data-price', data.cart_subtotal);
							$('.order_subtotal').data('price', data.cart_subtotal);

							$('.shipping span').text(data.cart_shipping_formatted || '');

							$('#order_total_price span').text(data.you_pay_formatted || '');
						})
						.catch(function () {
							// Silent fail; totals will still be correct on full update/refresh
						});
				}, 150);
			} catch (e) {}
		});

		$('.shopping-cart .input-group').each(function () {
			refreshCartQtyButtons($(this));
		});
		
		/*=======================
		  Extra Scroll JS
		=========================*/
		$('.scroll').on("click", function (e) {
			var anchor = $(this);
				$('html, body').stop().animate({
					scrollTop: $(anchor.attr('href')).offset().top - 0
				}, 900);
			e.preventDefault();
		});
		
		/*===============================
		10. Checkbox JS
		=================================*/  
		$('input[type="checkbox"]').change(function(){
			if($(this).is(':checked')){
				$(this).parent("label").addClass("checked");
			} else {
				$(this).parent("label").removeClass("checked");
			}
		});
		
		/*==================================
		 12. Product page Quantity Counter
		 ===================================*/
		$('.qty-box .quantity-right-plus').on('click', function () {
			var $qty = $('.qty-box .input-number');
			var currentVal = parseInt($qty.val(), 10);
			if (!isNaN(currentVal)) {
				$qty.val(currentVal + 1);
			}
		});
		$('.qty-box .quantity-left-minus').on('click', function () {
			var $qty = $('.qty-box .input-number');
			var currentVal = parseInt($qty.val(), 10);
			if (!isNaN(currentVal) && currentVal > 1) {
				$qty.val(currentVal - 1);
			}
		});
		
		/*=====================================
		15.  Video Popup JS
		======================================*/ 
		$('.video-popup').magnificPopup({
			type: 'iframe',
			removalDelay: 300,
			mainClass: 'mfp-fade'
		});
		
		/*====================================
			Scroll Up JS
		======================================*/
		$.scrollUp({
			scrollText: '<span><i class="fa fa-angle-up"></i></span>',
			easingType: 'easeInOutExpo',
			scrollSpeed: 900,
			animation: 'fade'
		});  
		
	});
	
	/*====================================
	18. Nice Select JS
	======================================*/	
	// Nice Select conflicts with Select2 and can create duplicate dropdown UIs.
	// Only apply it to selects that are not handled by Select2.
	$('select').not('.select2').niceSelect();
		
	/*=====================================
	 Others JS
	======================================*/ 	
	// $( function() {
	// 	$( "#slider-range" ).slider({
	// 		range: true,
	// 		min: 0,
	// 		max: 1000,
	// 		values: [ 0, 1000 ],
	// 		slide: function( event, ui ) {
	// 			$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
	// 		}
	// 	});
	// 	$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
	// 	  " - $" + $( "#slider-range" ).slider( "values", 1 ) );
	// } );
	
	/*=====================================
	  Preloader JS
	======================================*/ 	
	//After 2s preloader is fadeOut
	$('.preloader').delay(2000).fadeOut('slow');
	setTimeout(function() {
	//After 2s, the no-scroll class of the body will be removed
	$('body').removeClass('no-scroll');
	}, 2000); //Here you can change preloader time
	 
})(jQuery);
