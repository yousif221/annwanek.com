    <!-- Bootstrap CSS -->
    <link href="{{asset('web-assets/css/animate.css')}}" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{asset('web-assets/slick/slick-theme.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{asset('web-assets/slick/slick.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{asset('web-assets/css/slicknav.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('web-assets/css/fancybox.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('web-assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('web-assets/css/custom.css')}}" rel="stylesheet" >



    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> 
   
    <style>
  #toast-container > div {
  width: 350px !important; /* Adjust the width as needed */
}
    </style>
    <style>
  

  #search-icon {
    font-size: 20px;
    cursor: pointer;
    margin-right: 8px;
    color: white;
}
#search-box {
    margin-top: 40px;
    display: none;
    position: absolute;
    top: 30px;
    right: 379px;
    z-index: 1000;
    background-color: white;
    margin-right: 51px;
    border: 1px solid #ccc;
    padding: 5px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 214px;
}
#search-box input {
    width: 200px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

#search-box button {
    padding: 5px 10px;
    border: none;
    background-color: #ff7f00;
    color: white;
    border-radius: 3px;
    cursor: pointer;
}
    </style>
@yield('css')