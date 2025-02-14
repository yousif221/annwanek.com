@extends('layouts.front.app')
@section('title','Account Login')
@section('content')
<!-- inner-banner -->
<section class="inner-banner position-relative">
    <img src="{{ asset('web-assets/images/inner-ban-leaf-left.png') }}" alt="" class="inner-ban-left">
    <img src="{{ asset('web-assets/images/inner-ban-leaf-right.png') }}" alt="" class="inner-ban-right">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner-banner-text">
                    <h1>Accounts</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- inner-banner -->





<!-- move-arrow -->
<a  href="#ft-scroll" class="totop move-down regsc">
    <span><img src="{{ asset('web-assets/images/down-body.png') }}" alt="" /></span>
    <div id="curved2"></div>
</a>
<!-- move-arrow -->


<!-- login-page -->
<section class="ls-fold1 ptb-100 position-relative" id="next-sec">
    <img src="{{ asset('web-assets/images/farm-sale-left-leaf.png') }}" alt="" class="inner-sec-leaf1" />
    <img src="{{ asset('web-assets/images/farm-sale-right-leaf.png') }}" alt="" class="inner-sec-leaf2" />
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form class="login-form" action="{{ route('login') }}" method="POST">
                    @csrf
                    <h2>Login your account</h2>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" >
                    @error('email')
                    <p class="error-message">**{{ $message }}</p>
                    @enderror
                    <input type="password" name="password" value="{{ old('password') }}" placeholder="Password">
                    @error('password')
                    <p class="error-message">**{{ $message }}</p>
                    @enderror
                    <button class="btn-theme bg-green w-100"><span>LOGIN</span></button>
                    <div class="form-btm">
                        <div>
                            <input type="checkbox" name="asd">
                            <span>Remember me</span>
                        </div>
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                        <a href="{{ route('register') }}">Don't have an Account? <span style="color: #02810f;"> <b> Register Yourself!</b></span></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- login-page -->
@endsection