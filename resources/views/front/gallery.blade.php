@extends('layouts.front.app')
@section('title','Gallery')

@section('content')
 <!-- banner start -->
 
       <!-- Banner Start -->
       <section class="main_slider inner">
         <div
            id="carouselExampleControls"
            class="carousel slide"
            data-bs-ride="carousel"
            >
            <!-- <div class="carousel-indicators">
               <div
                  data-bs-target="#carouselExampleControls"
                  data-bs-slide-to="0"
                  class="active"
                  aria-current="true"
                  aria-label="Slide 1"
                  >1</div>
               <div
                  data-bs-target="#carouselExampleControls"
                  data-bs-slide-to="1"
                  aria-label="Slide 2"
                  >2</div>
               <div
                  data-bs-target="#carouselExampleControls"
                  data-bs-slide-to="2"
                  aria-label="Slide 3"
                  ></div>
               </div> -->
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <img src="{{asset($banner->image)}}" class="img-fluid" alt="..." />
                  <div class="carousel-caption">
                     <div class="container">
                        <div class="row">
                           <div class="col-lg-12 col-sm-12 col-md-12 align-self-center">
                              <div
                                 class="banner_text wow fadeInRight" data-wow-duration="2s"
                                 >
                                 <h1 class="btn-shine">{{$banner->title}}</h1>
                                 <p>
                                  {{$banner->text}}
                                 </p>
                                 
                              </div>
                           </div>
                           <div class="col-sm-6 col-md-6 align-self-center">
                              <div class="banner_img wow bounceIn" data-wow-duration="2s">
                                 <img src="{{('web-assets/images/dam_4.jpg')}}" class="img-fluid" alt="" />
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--  <button
               class="carousel-control-prev"
               type="button"
               data-bs-target="#carouselExampleControls"
               data-bs-slide="prev"
               >
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Previous</span>
               </button>
               <button
               class="carousel-control-next"
               type="button"
               data-bs-target="#carouselExampleControls"
               data-bs-slide="next"
               >
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Next</span>
               </button> -->
         </div>
         <div class="socail-link wow fadeInLeft" data-wow-duration="2s">
         <ul>
               <li><a href="{{getConfig('twitter')}}"><i class="fab fa-twitter"></i></a></li>
               <li><a href="{{getConfig('facebook')}}"><i class="fab fa-facebook-f"></i></a></li>
               <li><a href="{{getConfig('insta')}}"><i class="fab fa-instagram"></i></a></li>
               <li><a href="{{getConfig('link')}}"><i class="fab fa-linkedin-in"></i></a></li>
            </ul>
         </div>
      </section>
      <!-- Banner End -->

      <!-- <section>
        <div class="gallery-sec">
          <div class="container">
           <div class="gallery-row">
              <div class="row">
              <div class="col-lg-7 col-md-7 col-12">
                <div class="gallery-one">
                   <img src="images/gallery-1.jpg" alt="img">
                   <div class="gallery-one-icon">
                       <a href="images/gallery-1.jpg" data-fancybox="1"><i class="fas fa-plus"></i></a>
                   </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-5 col-12">
                <div class="gallery-two">
                   <img src="images/gallery-2.jpg" alt="img">
                   <div class="gallery-one-icon">
                        <a href="images/gallery-2.jpg" data-fancybox="1"><i class="fas fa-plus"></i></a>
                   </div>
                </div>

                 <div class="gallery-two chg">
                   <img src="images/gallery-3.jpg" alt="img">
                    <div class="gallery-one-icon">
                      <a href="images/gallery-3.jpg" data-fancybox="1"><i class="fas fa-plus"></i></a>
                   </div>
                </div>
              </div>
            </div>
           </div>
             <div class="gallery-row">
              <div class="row">
                <div class="col-lg-5 col-md-5 col-12">
                <div class="gallery-two">
                   <img src="images/gallery-4.jpg" alt="img">
                    <div class="gallery-one-icon">
                     <a href="images/gallery-4.jpg" data-fancybox="1"><i class="fas fa-plus"></i></a>
                   </div>

                </div>

                 <div class="gallery-two chg">
                   <img src="images/gallery-5.jpg" alt="img">
                    <div class="gallery-one-icon">
                       <a href="images/gallery-5.jpg" data-fancybox="1"><i class="fas fa-plus"></i></a>
                   </div>
                </div>
              </div>
              <div class="col-lg-7 col-md-7 col-12">
                <div class="gallery-one">
                   <img src="images/gallery-6.jpg" alt="img">
                     <div class="gallery-one-icon">
                        <a href="images/gallery-6.jpg" data-fancybox="1"><i class="fas fa-plus"></i></a>
                   </div>
                </div>
              </div>
              
            </div>
           </div>
             <div class="gallery-row">
              <div class="row">
              <div class="col-lg-7 col-md-7 col-12">
                <div class="gallery-one">
                   <img src="images/gallery-7.jpg" alt="img">
                     <div class="gallery-one-icon">
                        <a href="images/gallery-7.jpg" data-fancybox="1"><i class="fas fa-plus"></i></a>
                   </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-5 col-12">
                <div class="gallery-two">
                   <img src="images/gallery-8.jpg" alt="img">
                    <div class="gallery-one-icon">
                      <a href="images/gallery-8.jpg" data-fancybox="1"><i class="fas fa-plus"></i></a>
                   </div>
                </div>

                 <div class="gallery-two chg">
                   <img src="images/gallery-9.jpg" alt="img">
                    <div class="gallery-one-icon">
                       <a href="images/gallery-9.jpg" data-fancybox="1"><i class="fas fa-plus"></i></a>
                   </div>
                </div>
              </div>
            </div>
           </div>
           <div class="gallery-row">
              <div class="row">
             
              <div class="col-lg-5 col-md-5 col-12">
                <div class="gallery-two">
                   <img src="images/gallery-10.jpg" alt="img">
                    <div class="gallery-one-icon">
                        <a href="images/gallery-10.jpg" data-fancybox="1"><i class="fas fa-plus"></i></a>
                   </div>
                </div>

                 <div class="gallery-two chg">
                   <img src="images/gallery-11.jpg" alt="img">
                    <div class="gallery-one-icon">
                       <a href="images/gallery-11.jpg" data-fancybox="1"><i class="fas fa-plus"></i></a>
                   </div>
                </div>
              </div>
               <div class="col-lg-7 col-md-7 col-12">
                <div class="gallery-one">
                   <img src="images/gallery-12.jpg" alt="img">
                     <div class="gallery-one-icon">
                       <a href="images/gallery-12.jpg" data-fancybox="1"><i class="fas fa-plus"></i></a>
                   </div>
                </div>
              </div>
            </div>
           </div>
            <div class="gallery-row">
              <div class="row">
              <div class="col-lg-7 col-md-7 col-12">
                <div class="gallery-one">
                   <img src="images/gallery-13.jpg" alt="img">
                     <div class="gallery-one-icon">
                      <a href="images/gallery-13.jpg" data-fancybox="1"><i class="fas fa-plus"></i></a>
                   </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-5 col-12">
                <div class="gallery-two">
                   <img src="images/gallery-14.jpg" alt="img">
                    <div class="gallery-one-icon">
                        <a href="images/gallery-14.jpg" data-fancybox="1"><i class="fas fa-plus"></i></a>
                   </div>
                </div>

                 <div class="gallery-two chg">
                   <img src="images/gallery-15.jpg" alt="img">
                    <div class="gallery-one-icon">
                     <a href="images/gallery-15.jpg" data-fancybox="1"><i class="fas fa-plus"></i></a>
                   </div>
                </div>
              </div>
            </div>
           </div>
         

          </div>
        </div>
      </section> -->
      <section>
    <div class="gallery-sec">
        <div class="container">
        @php
          $imageCount = 0; $rowOpened = false;
        @endphp
        @foreach ($galleryItems->chunk(3) as $chunkIndex => $chunkedItems)
            @if($chunkIndex%2 == 0)
                      <div class="gallery-row">
                        <div class="row">
                          @isset($chunkedItems[($chunkIndex * 3) + 0])
                            <div class="col-lg-7 col-md-7 col-12">
                                <div class="gallery-one">
                                    <img src="{{ asset($chunkedItems[($chunkIndex * 3) + 0]->primary_image) }}" alt="img">
                                    <div class="gallery-one-icon">
                                        <a href="{{ asset($chunkedItems[($chunkIndex * 3) + 0]->primary_image) }}" data-fancybox="gallery-{{ $chunkIndex }}"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div> 
                          @endisset
                            <div class="col-lg-5 col-md-5 col-12">
                            @isset($chunkedItems[($chunkIndex * 3) + 1])
                                <div class="gallery-two">
                                    <img src="{{ asset($chunkedItems[($chunkIndex * 3) + 1]->primary_image) }}" alt="img">
                                    <div class="gallery-one-icon">
                                        <a href="{{ asset($chunkedItems[($chunkIndex * 3) + 1]->primary_image) }}" data-fancybox="gallery-{{ $chunkIndex }}"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                              @endisset
                              @isset($chunkedItems[($chunkIndex * 3) + 2])
                                <div class="gallery-two chg">
                                    <img src="{{ asset($chunkedItems[($chunkIndex * 3) + 2]->primary_image) }}" alt="img">
                                    <div class="gallery-one-icon">
                                        <a href="{{ asset($chunkedItems[($chunkIndex * 3) + 2]->primary_image) }}" data-fancybox="gallery-{{ $chunkIndex }}"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                              @endisset
                            </div>
                        </div>
                    </div>
            @else
                    <div class="gallery-row">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-12">
                            @isset($chunkedItems[($chunkIndex * 3) + 0])
                              <div class="gallery-two">
                                  <img src="{{ asset($chunkedItems[($chunkIndex * 3) + 0]->primary_image) }}" alt="img">
                                  <div class="gallery-one-icon">
                                      <a href="{{ asset($chunkedItems[($chunkIndex * 3) + 0]->primary_image) }}" data-fancybox="gallery-{{ $chunkIndex }}"><i class="fas fa-plus"></i></a>
                                  </div>
                              </div>
                            @endisset
                            @isset($chunkedItems[($chunkIndex * 3) + 1])
                              <div class="gallery-two chg">
                                  <img src="{{ asset($chunkedItems[($chunkIndex * 3) + 1]->primary_image) }}" alt="img">
                                  <div class="gallery-one-icon">
                                      <a href="{{ asset($chunkedItems[($chunkIndex * 3) + 1]->primary_image) }}" data-fancybox="gallery-{{ $chunkIndex }}"><i class="fas fa-plus"></i></a>
                                  </div>
                              </div>
                            @endisset
                            </div>
                            @isset($chunkedItems[($chunkIndex * 3) + 2])
                            <div class="col-lg-7 col-md-7 col-12">
                                <div class="gallery-one">
                                    <img src="{{ asset($chunkedItems[($chunkIndex * 3) + 2]->primary_image) }}" alt="img">
                                    <div class="gallery-one-icon">
                                        <a href="{{ asset($chunkedItems[($chunkIndex * 3) + 2]->primary_image) }}" data-fancybox="gallery-{{ $chunkIndex }}"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endisset
                        </div>
                    </div>
            @endif
            @endforeach
        </div>
    </div>
</section>


@endsection
@section('js')
@endsection