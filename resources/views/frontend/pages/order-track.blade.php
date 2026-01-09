@extends('frontend.layouts.master')

@section('title','DL || Order Track Page')

@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Order Track</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
<section class="tracking_box_area section_gap py-5">
    <div class="container">
        <div class="tracking_box_inner">
            <p>To track your order please enter your Order ID in the box below and press the "Track" button. This was given
                to you on your receipt and in the confirmation email you should have received.</p>
            <form class="row tracking_form my-4" action="{{route('product.track.order')}}" method="post" novalidate="novalidate">
              @csrf
                <div class="col-md-8 form-group">
                    <input type="text" class="form-control p-2"  name="order_number" placeholder="Enter your order number">
                </div>
                <div class="col-md-8 form-group">
                    <button type="submit" value="submit" class="btn submit_btn">Track Order</button>
                </div>
            </form>

            @if(isset($order))
                <div class="row">
                    <div class="col-12">
                        <h4>Order Summary</h4>
                        <table class="table table-bordered">
                            <tr>
                                <td>Order Number</td>
                                <td>{{ $order->order_number }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ $order->status }}</td>
                            </tr>
                            <tr>
                                <td>Courier</td>
                                <td>{{ $order->courier_name }}</td>
                            </tr>
                            <tr>
                                <td>Tracking Number</td>
                                <td>{{ $order->tracking_number }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-12">
                        <h4>Courier Tracking</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Location</th>
                                        <th>Description</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(($trackings ?? []) as $tracking)
                                        <tr>
                                            <td>{{ $tracking->status }}</td>
                                            <td>{{ $tracking->location }}</td>
                                            <td>{{ $tracking->description }}</td>
                                            <td>{{ $tracking->event_time ? $tracking->event_time->format('D d M, Y g:i a') : '' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No tracking updates yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection