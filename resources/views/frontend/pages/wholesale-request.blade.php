@extends('frontend.layouts.master')

@section('main-content')
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="javascript:void(0);">Wholesale Pricing</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<section class="contact-us section">
		<div class="container">
			<div class="contact-head">
				<div class="row">
					<div class="col-lg-8 col-12">
						<div class="form-main">
							<div class="title">
								<h4>Wholesale</h4>
								<h3>Request wholesale pricing</h3>
								@if($product)
									<p class="mt-2 mb-0">Product: <strong>{{$product->title}}</strong></p>
								@endif
							</div>

							<form class="form-contact form" method="post" action="{{route('wholesale.request.store')}}">
								@csrf
								<input type="hidden" name="product_id" value="{{ old('product_id', optional($product)->id) }}">

								<div class="row">
									<div class="col-lg-6 col-12">
										<div class="form-group">
											<label>Your Name<span>*</span></label>
											<input name="name" type="text" placeholder="Enter your name" value="{{old('name')}}">
											@error('name')<span class="text-danger">{{$message}}</span>@enderror
										</div>
									</div>
									<div class="col-lg-6 col-12">
										<div class="form-group">
											<label>Your Email<span>*</span></label>
											<input name="email" type="email" placeholder="Enter email address" value="{{old('email')}}">
											@error('email')<span class="text-danger">{{$message}}</span>@enderror
										</div>
									</div>

									<div class="col-lg-6 col-12">
										<div class="form-group">
											<label>Your Phone<span>*</span></label>
											<input name="phone" type="text" placeholder="Enter your phone" value="{{old('phone')}}">
											@error('phone')<span class="text-danger">{{$message}}</span>@enderror
										</div>
									</div>
									<div class="col-lg-6 col-12">
										<div class="form-group">
											<label>Company</label>
											<input name="company" type="text" placeholder="Company name (optional)" value="{{old('company')}}">
											@error('company')<span class="text-danger">{{$message}}</span>@enderror
										</div>
									</div>

									<div class="col-12">
										<div class="form-group">
											<label>Quantity</label>
											<input name="quantity" type="number" min="1" placeholder="Requested quantity (optional)" value="{{old('quantity')}}">
											@error('quantity')<span class="text-danger">{{$message}}</span>@enderror
										</div>
									</div>

									<div class="col-12">
										<div class="form-group message">
											<label>Message</label>
											<textarea name="message" cols="30" rows="8" placeholder="Tell us what you need (optional)">{{old('message')}}</textarea>
											@error('message')<span class="text-danger">{{$message}}</span>@enderror
										</div>
									</div>

									<div class="col-12">
										<div class="form-group button">
											<button type="submit" class="btn">Send Request</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>

					<div class="col-lg-4 col-12">
						<div class="single-head">
							<div class="single-info">
								<i class="fa fa-info-circle"></i>
								<h4 class="title">How it works</h4>
								<ul>
									<li>Send your details and required quantity.</li>
									<li>We will contact you with wholesale pricing.</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	@include('frontend.layouts.newsletter')
@endsection
