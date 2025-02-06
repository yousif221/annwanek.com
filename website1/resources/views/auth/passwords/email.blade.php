@extends('layouts.front.app')
@section('title','Reset Password')
@section('css')
<style>
    .error-message{
        color:red;
    }
 

</style>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> 

@endsection
@section('content')
<!-- inner-banner -->
@php $banner = App\Banner::where('page','Reset Password')->first() @endphp
@php $content = App\Content::where('page','Reset')->first() @endphp

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
                    <form class="login-form" id="resetForm" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="log-form log-form1 col-6"style="margin-left: 323px;">
                      @if (session('status'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('status') }}
                        </div>
                      @endif
                      <div class="row">
                      <div class="col-md-12">
                      <input type="email" class="wow fadeIn" data-wow-delay=".25s" s  name="email" value="{{ old('email') }}" placeholder="Email">
                    </div>
                    </div>
                    @error('email')
                    <p class="error-message">**{{ $message }}</p>
                    @enderror
                    <div class="row">
                    <div class="col-md-12">
                    <button class="theme2"  type="button"onclick="submitResetForm()"><span class="btn-txt">Send Reset Password Link</span></button>
                    </div>
                    </div>
                </form>
                </div>
             </div>
          </div>
        </div>
    
     
</section>

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
  function submitResetForm() {
    $('.error-message').text('');

    var formData = {
        email: $('input[name="email"]').val(),
        _token: $('input[name="_token"]').val(),
    };

    $.ajax({
        type: 'POST',
        url: $('#resetForm').attr('action'),
        data: formData,
        dataType: 'json',
        success: function (data) {
            // Handle success (e.g., display success message)
            console.log('Reset link sent successfully!');
            toastr.success('Reset link sent successfully!');
        },
        error: function (data) {
            // Log the entire response to the console
            console.log(data);

            if (data && data.responseJSON && data.responseJSON.errors) {
                var errors = data.responseJSON.errors;

                // Loop through errors and display Toastr messages
                $.each(errors, function (key, value) {
                    toastr.error(value[0]);
                });
            } else {
                toastr.error('An unexpected error occurred.');
            }
        }
    });
}
    
</script>
@endsection

