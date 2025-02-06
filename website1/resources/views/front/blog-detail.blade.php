@extends('layouts.front.app')
@section('title','Blogs')


@section('css')
<style>


.error {
    color: red;
    font-size: 14px;
    margin-top: -2px;
}
.con_sid-wrp form input, select.form-select, .con_sid-wrp form textarea {
}
</style>

@endsection

@section('content')
  <!-- header strat -->
    <!-- banner start -->
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
    <!-- banner end -->
  <!-- blog-det start -->
  <section class="blog-det">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
         <div class="blog-det-img text-center">
           <img src="{{asset($blogs->inner_image)}}"style="width:896px;height:518px;" alt="">
         </div>
         <div class="blog-det-txt">
           <ul>
             <li><p>Posted by {{$blogs->username}}</p></li>
             <li><p>{{ $blogs->created_at->format('jS F Y') }}</p></li>
           </ul>
           <h5>{{$blogs->title}}</h5>
        {!!$blogs->additionalinfo!!}
           <ul class="social-icon">
             <li><h6>Share</h6></li>
             <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
             <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
             <li><a href="#"><i class="fab fa-instagram"></i></a></li>
             <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
           </ul>
         </div> 
        </div>
      </div>
    </div>
  </section>
  <!-- blog-det end -->
   <!-- footer start -->
    <!-- Blog Sec Ends -->
@endsection
@section('js')

@endsection