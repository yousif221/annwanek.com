@extends('layouts.front.app')
@section('title','Account Registration')
@section('css')
<style>
        .myAccountSec.inner-gallery-sec.pt-8.pb-8 {
    height: 500px;
}
.col-md-7.wow.fadeInRightBig {
    margin-left: 236px;
}
</style>
@endsection
@section('content')
@php $banner = App\Banner::where('page','Register')->first() @endphp
@php $content = App\Content::where('page','Register')->first() @endphp

<!-- banner start -->
<section class="main_slider inner-ban">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset($banner->image)}}" class="img-fluid" alt="...">
                <div class="carousel-caption">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-8 align-self-center">
                                <div class="banner_text wow fadeInLeft" data-wow-duration="2s">
                                    <h1>{{$banner->title}}</h1>
                                </div>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-live">
                    <h6>live chat</h6>
                    <a href="#"> <i class="fas fa-comment-alt-lines"></i></a>
                </div>
            </div>
        </div>
        <div class="follow-banner">
            <h3>Follow us</h3>
            <div class="follow-links">
                <a href="{{getConfig('inta')}}"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                <a href="{{getConfig('facebook')}}"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                <a href="mailto:{{getConfig('primary_email')}}"><i class="fas fa-envelope"></i></a>
            </div>
        </div>
    </section>
    <!-- banner end -->
    <!-- Inner Banner End -->

    <section class="contact_pg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main_contact_wrp">
                        <div class="contact_form">
                            <div class="row">
                                <div class="col-md-10 bk_wht">
                                    <div class="con_sid-wrp">
                                        <h3>Register Your Account</h3>
                         
                    <form id="registrationForm" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="row">
                            <div class="col-md-12">
                        <input type="text"name="first_name" placeholder="First Name" style="text-transform:none"class="wow fadeIn"
                            data-wow-delay=".25s">
                    </div>
                    </div>
                    <div class="row">
                                                <div class="col-md-12">
                        <input type="text" placeholder="Last Name"name="last_name"style="text-transform:none" class="wow fadeIn" data-wow-delay=".45s">
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                <input type="email" placeholder="Email Address"name="email"style="text-transform:none" class="wow fadeIn" data-wow-delay=".65s">
                </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                <input type="password" name="password" placeholder="Password" class="wow fadeIn" data-wow-delay=".85s">
                </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                <input type="password"name="password_confirmation" placeholder="Retype Password" class="wow fadeIn" data-wow-delay="1s">
                </div>
                </div>
                
                <div class="col-md-12">
                <button type="button"onclick="submitForm()" class="theme_btn"> CREATE ACCOUNT
                        </button>
                      
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
<script type="text/javascript">
      var cleave = new Cleave('.Phone', {

numericOnly: true,

delimiters: ['-', '-', ' '],

blocks: [3, 3, 4]

});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
function submitForm() {
    $('.error-message').text('');

    var formData = $('#registrationForm').serialize();  // Use serialize() to collect form data

    $.ajax({
        type: 'POST',
        url: $('#registrationForm').attr('action'),
        data: formData,
        dataType: 'json',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        success: function (data) {
          toastr.success('You have Registered Successfully.');
          setTimeout(function(){
            window.location.href = '{{ route('login') }}';// Reload the page
}, 3000); // Reload the page after successful submission
            // Handle success (e.g., redirect, display success message)
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