<!-- Meta Tag -->
@yield('meta')
<!-- Title Tag  -->
<title>@yield('title')</title>
<!-- Favicon -->
<link rel="icon" type="image/png" href="images/favicon.png">
<!-- Web Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Montserrat:wght@300;400;500;600;700;800;900&family=Roboto:wght@300;400;500;700;900&family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<!-- StyleSheet -->
<link rel="manifest" href="/manifest.json">
<!-- Bootstrap -->
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}">
<!-- Magnific Popup -->
<link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('frontend/css/font-awesome.css')}}">
<!-- Fancybox -->
<link rel="stylesheet" href="{{asset('frontend/css/jquery.fancybox.min.css')}}">
<!-- Themify Icons -->
<link rel="stylesheet" href="{{asset('frontend/css/themify-icons.css')}}">
<!-- Nice Select CSS -->
<link rel="stylesheet" href="{{asset('frontend/css/niceselect.css')}}">
<!-- Animate CSS -->
<link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
<!-- Flex Slider CSS -->
<link rel="stylesheet" href="{{asset('frontend/css/flex-slider.min.css')}}">
<!-- Owl Carousel -->
<link rel="stylesheet" href="{{asset('frontend/css/owl-carousel.css')}}">
<!-- Slicknav -->
<link rel="stylesheet" href="{{asset('frontend/css/slicknav.min.css')}}">
<!-- Jquery Ui -->
<link rel="stylesheet" href="{{asset('frontend/css/jquery-ui.css')}}">

<!-- Eshop StyleSheet -->
<link rel="stylesheet" href="{{asset('frontend/css/reset.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
<link rel="stylesheet" href="{{asset('css/electronics-fonts.css')}}">
<link rel="stylesheet" href="{{asset('css/electronics-theme.css')}}">
{{-- Removed external ShareThis script to prevent third-party click hijacking --}}

<script>
    // Click-guard: ensure product image clicks always go to product details.
    // Uses capture on window to beat late/injected handlers.
    (function () {
        function findProductUrlFromTarget(target) {
            if (!target || !target.closest) return null;

            var card = target.closest('[data-product-url]');
            if (card && card.getAttribute) {
                var url = card.getAttribute('data-product-url');
                if (url) return url;
            }

            // Fallback: look for internal product detail link in the nearest product image area.
            var productImg = target.closest('.product-img');
            if (productImg) {
                var link = productImg.querySelector('a[href*="/product-detail/"]');
                if (link && link.href) return link.href;
            }

            return null;
        }

        function shouldHandleProductImageClick(target) {
            if (!target || !target.closest) return false;

            // Avoid interfering with action buttons (wishlist/quick view/add to cart).
            if (target.closest('.button-head') || target.closest('.product-action') || target.closest('.product-action-2')) return false;

            // Handle clicks that originate from product images/containers.
            if (target.closest('.product-img') || target.closest('.list-image')) return true;
            if (target.tagName && target.tagName.toUpperCase() === 'IMG') return true;

            return false;
        }

        function forceInternalNavigation(event) {
            try {
                if (!event || !event.target) return;
                var target = event.target;

                if (!shouldHandleProductImageClick(target)) return;

                var url = findProductUrlFromTarget(target);
                if (!url) return;

                // If the click is on an external Alibaba link (injected overlay), override it.
                var a = target.closest('a');
                if (a && a.href && /(^|\.)alibaba\.com\b/i.test(a.href)) {
                    // proceed with override
                }

                event.preventDefault();
                event.stopPropagation();
                if (event.stopImmediatePropagation) event.stopImmediatePropagation();

                window.location.assign(url);
            } catch (e) {
                // ignore
            }
        }

        // Capture early on window to beat most injected handlers.
        window.addEventListener('pointerdown', forceInternalNavigation, true);
        window.addEventListener('click', forceInternalNavigation, true);
        window.addEventListener('auxclick', forceInternalNavigation, true);
        window.addEventListener('touchstart', forceInternalNavigation, true);
        window.addEventListener('mousedown', forceInternalNavigation, true);
    })();
</script>
<style>
    /* Multilevel dropdown */
    .dropdown-submenu {
    position: relative;
    }

    .dropdown-submenu>a:after {
    content: "\f0da";
    float: right;
    border: none;
    font-family: 'FontAwesome';
    }

    .dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: 0px;
    margin-left: 0px;
    }
</style>
@stack('styles')
