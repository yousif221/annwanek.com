@extends('layouts.front.app')
@section('title','Reset Password')
@section('css')
<style>
    .error-message{
        color:red;
    }
 
</style>
@endsection
@section('content')
@php $banner = App\Banner::where('page','Update Your Password')->first() @endphp
@php $content = App\Content::where('page','Update')->first() @endphp

  <!--login area end-->
  <section class="main_slider inn">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item">
            <img src="{{asset($banner->image)}}" class="img-fluid" alt="...">
             <div class="carousel-caption">
              <div class="container">
                <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-12 align-self-center">
                    <div class="banner_text wow fadeInLeft" data-wow-duration="2s">
                      <h1>{{$banner->title}}</h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>                 
        </div>
      </div>
    </section>
  

    <section class="ls-fold1 ptb-100 position-relative" id="next-sec">
    <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                    <form class="login-form" action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <div class="log-form log-form1 col-6"style="margin-left: 323px;">
                        <h3 >Update Your Password</h3>

                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form_area">
                    <div class="fields_area">
                    <input type="email" class="wow fadeIn" name="email"value="{{ (old('email')) ? old('email') : $email }}"  placeholder="Email"readonly>
                    </div>
  
     
                    <div class="fields_area">
                    <input type="password" class="wow fadeIn"name="password" placeholder="Enter New Password">
                    </div>
       
                    <div class="fields_area">
                    <input type="password"class="wow fadeIn" name="password_confirmation" placeholder="Re-type Your New Password">
                    </div>
                    </div>
                    <div class="btn_wrap">  
                    <button class="theme2"><span class="btn-txt">Update Your Password</span></button>
                </div>  
                </form>
                </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        </div>
        </div>
</section>

@endsection

@section('js')
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "6000",
        "extendedTimeOut": "6000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    @error('email')
        toastr.error("**{{ $message }}");
    @enderror
    @error('password')
        toastr.error("**{{ $message }}");
    @enderror
</script>
@endsection
