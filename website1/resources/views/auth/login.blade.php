@extends('layouts.front.app')
@section('title','Account Login')
@section('css')
<style>
  ::placeholder {
  color: black;
  opacity: 4.5;
}
::placeholder {
    color: #000;
    font-weight: 500;}

    .invalid-feedback {
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545 !important;
}
.alert.alert-danger {
    color: red!important;
}
</style>
@endsection
@section('content')
@php $banner = App\Banner::where('page','Register')->first() @endphp
@php $content = App\Content::where('page','Login')->first() @endphp


   
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
  

      












   <!-- login-page -->
   <section class="ls-fold1 ptb-100 position-relative" id="next-sec">
        <img src="{{asset('web-assets/images/farm-sale-left-leaf.png')}}" alt="" class="inner-sec-leaf1" />
        <img src="{{asset('web-assets/images/farm-sale-right-leaf.png')}}" alt="" class="inner-sec-leaf2" />
        <div class="container">
            <div class="row">
              
                <div class="col-md-6">
                    <form class="login-form" id="registrationForm" action="{{ route('register') }}" method="POST"> 
                @csrf
                    <h2>CREATE ACCOUNT</h2>
                        <div class="row">
                            <div class="col-md-12">
                              <label>First Name</label>
                              <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="">
                            </div>
                            <div class="col-md-12">
                              <label>Last Name</label>
                              <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="">
                            </div>
                        </div>
                        <label>Email</label>
                        <input type="text" name="email"  value="{{ old('email') }}" placeholder="">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="">
                        <label>Retype Password</label>
                        <input type="password"name="password_confirmation" >

                        <div class="reg-frombtm">
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    <a href="#" style="margin-left: 10px">Term &amp; Condition</a></span>
                        </div>
                        <button type="button" onclick="submitForm()"  class="btn-theme bg-green w-100"><span>Register</span></button>
                    </form>
                </div>
                  <div class="col-md-6">
                    <form class="login-form" action="{{ route('login') }}" method="POST">
                    @csrf
                    <h2>LOGIN</h2>
                        @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                      {{ $errors->first() }}
                    </div>
                    @endif
                        <label>Username</label>
                        <input type="email" type="email" name="email"id="email" placeholder="">
                        <label>Password</label> 
                        <input type="password"name="password" placeholder="">
                         <div class="form-btm">
                            <div>
                                <input type="checkbox" value="lsRememberMe" id="rememberMe">
                                <span>Remember me</span><br>
                                <a href="{{ route('password.request') }}">Forget Password?</a>
                            </div>
                           
                        </div>
                        <button type="submit" class="btn-theme bg-green w-100"onclick="lsRememberMe()"><span>Sign in</span></button>
                       
                    </form>
                </div>
            </div>
        </div>
    </section>




       @endsection
       @section('js')
   
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
  const rmCheck = document.getElementById("rememberMe"),
    emailInput = document.getElementById("email");

if (localStorage.checkbox && localStorage.checkbox !== "") {
  rmCheck.setAttribute("checked", "checked");
  emailInput.value = localStorage.username;
} else {
  rmCheck.removeAttribute("checked");
  emailInput.value = "";
}

function lsRememberMe() {
  if (rmCheck.checked && emailInput.value !== "") {
    localStorage.username = emailInput.value;
    localStorage.checkbox = rmCheck.value;
  } else {
    localStorage.username = "";
    localStorage.checkbox = "";
  }
}

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
function submitForm() {
    $('.error-message').text(''); // Clear any previous error messages

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
            toastr.success('You have registered successfully. You can now log in.');
            $('#registrationForm')[0].reset(); // Reset the form
            // Optionally reload the page or redirect
            // window.location.reload();
        },
        error: function (xhr) {
            console.log(xhr);

            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                // Loop through validation errors and display them
                $.each(xhr.responseJSON.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            } else if (xhr.status === 500) {
                toastr.error('Internal Server Error. Please try again later.');
            } else {
                toastr.error('An unexpected error occurred.');
            }
        }
    });
}
function submitLoginForm() {
    $('.error-message').text('');

    // Get the values of email and password fields
    var email = $('#email').val();
    var password = $('#password').val();

    // Perform client-side form validation
    if (!email || !password) {
        toastr.error('Please fill in both email and password fields.');
        return; // Stop further execution if validation fails
    }

    var formData = {
        email: email,
        password: password,
        _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
    };

    $.ajax({
        type: 'POST',
        url: $('#loginForm').attr('action'),
        data: formData,
        dataType: 'json',
        success: function (data) {
            // Handle success (e.g., redirect, display success message)
            toastr.success('Login Successfully.');
            // Optionally redirect to another page after successful login
            window.location.reload();
        },
        error: function (xhr, status, error) {
            // Log the entire response to the console
            console.log(xhr);

            if (xhr.status === 401 && xhr.responseJSON && xhr.responseJSON.error === 'Your account is not approved yet.') {
                // If the error is due to an inactive account, display a toastr message
                toastr.error('Your account is not approved yet. Please contact the administrator.');
                setTimeout(function () {
                    window.location.reload();
                }, 2000); // Reload the page after 2 seconds
            } else if (xhr.status === 422) {
                // If the error is due to incorrect email or password, display a toastr message
                toastr.error('Incorrect email or password.');
            } else {
                // Display a generic error message for unexpected errors
                toastr.error('An unexpected error occurred.');
            }
        }
    });
}
</script>
<script type="text/javascript">
      var cleave = new Cleave('.Phone', {

numericOnly: true,

delimiters: ['-', '-', ' '],

blocks: [3, 3, 4]

});
</script>
@endsection