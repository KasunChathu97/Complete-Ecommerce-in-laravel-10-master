@extends('frontend.layouts.master')

@section('title','DL || Register Page')

@section('main-content')
	<!-- Breadcrumbs 
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Register</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
 End Breadcrumbs -->
            
    <!-- Shop Login -->
    <section class="shop login section">
        <div class="container">
            <div class="row"> 
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="login-form">
                        <h2>Register</h2>
                        <p>Please register in order to checkout more quickly</p>
                        <!-- Form -->
                        <form class="form" method="post" action="{{route('register.submit')}}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Your Name<span>*</span></label>
                                        <input type="text" name="name" placeholder="Enter Name" required="required" value="{{old('name')}}">
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Your Email<span>*</span></label>
                                        <input type="text" name="email" placeholder="Enter Email" required="required" value="{{old('email')}}">
                                        @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Your Password<span>*</span></label>
                                        <input type="password" name="password" placeholder="Enter Password" required="required" value="{{old('password')}}">
                                        @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Confirm Password<span>*</span></label>
                                        <input type="password" name="password_confirmation" placeholder="" required="required" value="{{old('password_confirmation')}}">
                                        @error('password_confirmation')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group login-btn">
                                        <button class="btn btn-register" type="submit">Register</button><br><br>

                                        
                                            <span>Already have an account? </span>
                                            <a href="{{route('login.form')}}" class="login-now-link" style="color:#073088;font-weight:600;text-decoration:underline;cursor:pointer;">Log in Now</a>

                                        <!--OR
                                        <a href="{{route('login.redirect','facebook')}}" class="btn btn-facebook"><i class="ti-facebook"></i></a>
                                        <a href="{{route('login.redirect','github')}}" class="btn btn-github"><i class="ti-github"></i></a>
                                        <a href="{{route('login.redirect','google')}}" class="btn btn-google"><i class="ti-google"></i></a> -->
                                     </div>

                                </div>
                            </div>
                        </form>
                        <!--/ End Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Login -->
@endsection

@push('styles')
<style>
    .shop.login .form .btn {
        margin-right: 10px;
        padding: 12px 32px;
        font-size: 1.1rem;
        border-radius: 25px;
        border: none;
        transition: background 0.3s, color 0.3s, box-shadow 0.3s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        font-weight: 600;
    }
    .shop.login .form .btn-register {
        background: linear-gradient(90deg, #4f8cff 0%, #073088 100%);
        color: #fff;
    }
    .shop.login .form .btn-register:hover {
        background: linear-gradient(90deg, #073088 0%, #4f8cff 100%);
        color: #fff;
        box-shadow: 0 4px 16px rgba(79,140,255,0.15);
    }
    .shop.login .form .btn-login {
        background: #fff;
        color: #073088;
        border: 2px solid #073088;
    }
    .shop.login .form .btn-login:hover {
        background: #073088;
        color: #fff;
        box-shadow: 0 4px 16px rgba(7,48,136,0.15);
    }
    .shop.login .form .form-group label {
        font-weight: 500;
        color: #073088;
        margin-bottom: 6px;
    }
    .shop.login .form .form-group input {
        border-radius: 18px;
        border: 1px solid #d1d5db;
        padding: 10px 18px;
        font-size: 1rem;
        margin-bottom: 4px;
        transition: border 0.2s;
    }
    .shop.login .form .form-group input:focus {
        border-color: #4f8cff;
        outline: none;
    }
    .shop.login .form .form-group {
        margin-bottom: 22px;
    }
    .login-form {
        background: #f8fafc;
        border-radius: 18px;
        padding: 36px 32px 28px 32px;
        box-shadow: 0 2px 16px rgba(79,140,255,0.07);
    }
    .login-form h2 {
        color: #073088;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .login-form p {
        color: #4f8cff;
        margin-bottom: 24px;
    }
    .btn-facebook{
        background:#39579A;
    }
    .btn-facebook:hover{
        background:#073088 !important;
    }
    .btn-github{
        background:#444444;
        color:white;
    }
    .btn-github:hover{
        background:black !important;
    }
    .btn-google{
        background:#ea4335;
        color:white;
    }
    .btn-google:hover{
        background:rgb(243, 26, 26) !important;
    }
</style>
@endpush