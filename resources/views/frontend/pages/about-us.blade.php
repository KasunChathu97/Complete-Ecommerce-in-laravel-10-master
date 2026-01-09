@extends('frontend.layouts.master')

@section('title','DL || About Us')

@section('main-content')
	@php
		$setting = DB::table('settings')->first();
	@endphp

	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="{{route('about-us')}}">About Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- About Us -->
	<section class="about-us section">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6 col-12">
					<div class="about-content">
						<div class="mb-3">
							<h2>Welcome To</h2>
							<h2><span>Delimach Lanka (Pvt) Ltd</span></h2>
						</div>
						<div class="mt-2 about-richtext">
							@if(!empty($setting?->description))
								{!! $setting->description !!}
							@else
								<p>Welcome to <strong>Delimach Lanka (Pvt) Ltd</strong>, Sri Lanka’s specialized online hub for advanced energy solutions, automotive excellence, and smart technology. Based in Kadawatha, we have evolved into a digital-first leader dedicated to delivering innovation directly to your doorstep—no matter how remote your location.</p>
								<p>As an authorized <strong>sub-distributor for Shell Engine Oils</strong>, we combine the reliability of a global brand with our local expertise to serve online customers and our corporate network.</p>
							@endif
						</div>
						<div class="button mt-4">
							{{-- <a href="{{ route('blog') }}" class="btn">Our Blog</a> --}}
							<a href="{{route('contact')}}" class="btn primary">Contact Us</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-12">
					<div class="about-img overlay">
						<img class="img-fluid" src="{{ $setting->photo ?? '' }}" alt="Delimach Lanka (Pvt) Ltd">
					</div>
				</div>
			</div>

			@if(!empty($setting?->vision) || !empty($setting?->mission))
				<div class="row mt-5">
					<div class="col-12">
						<div class="section-title">
							<h2>Our Vision &amp; Mission</h2>
						</div>
					</div>
					@if(!empty($setting?->vision))
						<div class="col-lg-6 col-12 mb-4">
							<div class="about-content border rounded p-4 h-100">
								<h3>Our <span>Vision</span></h3>
								<div class="about-richtext">{!! $setting->vision !!}</div>
							</div>
						</div>
					@endif
					@if(!empty($setting?->mission))
						<div class="col-lg-6 col-12 mb-4">
							<div class="about-content border rounded p-4 h-100">
								<h3>Our <span>Mission</span></h3>
								<div class="about-richtext">{!! $setting->mission !!}</div>
							</div>
						</div>
					@endif
				</div>
			@endif

			
			@if(!empty($setting?->commitment_energy_independence))
				<div class="row">
					<div class="col-12 mb-4">
						<div class="about-content border rounded p-4">
							<div class="section-title text-left">
								<h2>Our Commitment to Energy Independence</h2>
							</div>
							<div class="about-richtext">{!! $setting->commitment_energy_independence !!}</div>
						</div>
					</div>
				</div>
			@endif

			@if(!empty($setting?->specialized_product_range))
				<div class="row">
					<div class="col-12 mb-4">
						<div class="about-content border rounded p-4">
							<div class="section-title text-left">
								<h2>Our Specialized Product Range</h2>
							</div>
							<div class="about-richtext">{!! $setting->specialized_product_range !!}</div>
						</div>
					</div>
				</div>
			@endif

			@if(!empty($setting?->why_choose_delimach_lanka))
				<div class="row">
					<div class="col-12">
						<div class="about-content border rounded p-4">
							<div class="section-title text-left">
								<h2>Why Choose Delimach Lanka?</h2>
							</div>
							<div class="about-richtext">{!! $setting->why_choose_delimach_lanka !!}</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</section>
	<!-- End About Us -->

	{{-- Content sections are rendered inside the main About Us section above. --}}


	<!-- Start Shop Services Area -->
	<section class="shop-services section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Free shiping</h4>
						<p>Orders over {{Helper::formatCurrency(100)}}</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Free Return</h4>
						<p>Within 30 days returns</p>
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
	<!-- End Shop Services Area -->

	@include('frontend.layouts.newsletter')
@endsection

@push('styles')
<style>
	/* reset.css globally removes bullets; restore them only for About page rich text */
	.about-richtext{line-height:1.8;text-align:justify;}
	.about-richtext p{margin:0 0 12px;}
	.about-richtext p:last-child{margin-bottom:0;}
	.about-richtext ul{list-style:disc !important;padding-left:1.5rem;margin:0 0 12px;}
	.about-richtext ol{list-style:decimal !important;padding-left:1.5rem;margin:0 0 12px;}
	.about-richtext li{list-style:inherit !important;margin:0 0 8px;}
</style>
@endpush
