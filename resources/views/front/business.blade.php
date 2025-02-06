@extends('layouts.front.app')
@section('title','Business')
@section('css')
<style>
  .toast-error {
    background-color:red !important;
  }
  .toast-success {
    background-color:green !important;
  }
  .reserve-table ul li {
    padding: 0px 7px;
    box-shadow: 0 0 3px #00000073;
    border-radius: 100px;
    width: 650px;
}
  /* Modal styles */
.modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Black w/ opacity */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

.modal-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

.modal-footer {
    text-align: right;
    margin-top: 20px;
}

</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

@endsection
@section('content')

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
    <!-- dish-delights start  -->
    <section class="dish-delights">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-12 col-12">
            <div class="dish-txt">
              <h3>{{$business_detail->name}}</h3>   
              <ul class="img-uplo" style="margin-left: 1078px;"> 
               <li><a href="#" class="uplo" data-bs-toggle="modal" data-bs-target="#claimModal">Claim</a></li>
          
               <!-- <li><a href="#" class="uplo-1">Upload a photo</a></li> -->
               </ul>
              <ul class="star">
                <!-- <li><a href="#"><i class="fas fa-star"></i></a>
                <a href="#"><i class="fas fa-star"></i></a>
                <a href="#"><i class="fas fa-star"></i></a>
                <a href="#"><i class="fas fa-star"></i></a>
              </li> -->
                <li><p>{{ count($business_detail->reviews) }} reviews</p></li>
                <li><p> {{$business_detail->state->name??'-'}}</p></li>
              
                @php
    $menuItems = $business_detail->menuItems->take(3); // Take the first 3 items
@endphp

<li>
    <p>
        {{ $menuItems->pluck('name')->join(', ') }}
    </p>
</li>
@foreach(explode('||', $business_detail->business_tags) as $tag)
        <li>{{ $tag }}</li>
    @endforeach
              </ul>
              <ul class="adress">
                <li><i class="fas fa-map-marker-alt"></i><p>{{$business_detail->address}}</p></li>
                <li><i class="fas fa-phone-alt"></i><a href="telto:{{$business_detail->phone}}">{{$business_detail->phone}}</a></li>
                <li><i class="fas fa-globe-americas"></i><p><a href="{{$business_detail->website}}">Website</a></p></li>
                <li><i class="fas fa-pencil-alt"></i><p>Write a review</p></li>
                <li><i class="fa-regular fa-square-ellipsis"></i><p>Menu</p></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-12">
            <div class="reserve-table">
              <h4>Reserve a Table</h4>
              @php
    $startTime = \Carbon\Carbon::parse($business_detail->start_time);
    $endTime = \Carbon\Carbon::parse($business_detail->end_time);
@endphp

@php
    $counter = 0;  // Initialize a counter variable
@endphp

@for ($time = $startTime; $time <= $endTime; $time->addMinutes(30))
    @if ($counter % 3 == 0)
        <!-- Open a new <ul> after every 3 items -->
        <ul>
    @endif
    
    <li>{{ $time->format('h:i A') }}</li>

    @php
        $counter++;  // Increment the counter after each item
    @endphp

    @if ($counter % 3 == 0 || $time == $endTime)
        <!-- Close the <ul> if it's the 3rd item or if it's the last item -->
        </ul>
    @endif
@endfor

            </div>
          </div>
          <div class="col-md-9 col-lg-9 col-12">
            <div class="row">
              <div class="col-md-8 col-lg-8 col-12">
                <div class="dish-img">
                  <img src="{{asset($business_detail->business_image)}}" alt="">
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-12">
                <div class="dish-img-sm">
                  <img src="{{asset($business_detail->menu_image)}}">
                  <h6>Menu</h6>
                </div>
                <div class="dish-img-sm tw">
                  <img src="{{asset($business_detail->interior_image)}}">
                  <h6>Interior and Food</h6>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-lg-4 col-12">
          @php
    // Calculate average ratings for each category (food, service, value, atmosphere)
    $averageFood = $business_detail->reviews->avg('food');
    $averageService = $business_detail->reviews->avg('service');
    $averageValue = $business_detail->reviews->avg('value');
    $averageAtmosphere = $business_detail->reviews->avg('atmosphere');
@endphp
         @php
    // Calculate average ratings for each category (food, service, value, atmosphere)
    $averageFood = $business_detail->reviews->avg('food');
    $averageService = $business_detail->reviews->avg('service');
    $averageValue = $business_detail->reviews->avg('value');
    $averageAtmosphere = $business_detail->reviews->avg('atmosphere');
@endphp

<div class="rating-review">
    <h5>Ratings and reviews</h5>
    <div class="staar">
        <h6>{{ round($averageFood, 1) }}</h6>
        <ul>
            @foreach(range(1, 5) as $i)
                @if($averageFood >= $i)
                    <li><i class="fas fa-star"></i></li> <!-- Full star -->
                @elseif($averageFood >= $i - 0.5)
                    <li><i class="fas fa-star-half-alt"></i></li> <!-- Half star -->
                @else
                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li> <!-- Empty star -->
                @endif
            @endforeach
        </ul>
        <h6>{{ count($business_detail->reviews) }} reviews</h6>
    </div>
    <p># {{$business_detail->address}}</p>

    <h6>RATINGS</h6>

    <!-- Food Rating -->
    <ul>
        <li>Food</li>
        <li>
            @foreach(range(1, 5) as $i)
                @if($averageFood >= $i)
                    <i class="fas fa-star"></i>
                @elseif($averageFood >= $i - 0.5)
                    <i class="fas fa-star-half-alt"></i>
                @else
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                @endif
            @endforeach
        </li>
    </ul>

    <!-- Service Rating -->
    <ul>
        <li>Service</li>
        <li>
            @foreach(range(1, 5) as $i)
                @if($averageService >= $i)
                    <i class="fas fa-star"></i>
                @elseif($averageService >= $i - 0.5)
                    <i class="fas fa-star-half-alt"></i>
                @else
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                @endif
            @endforeach
        </li>
    </ul>

    <!-- Value Rating -->
    <ul>
        <li>Value</li>
        <li>
            @foreach(range(1, 5) as $i)
                @if($averageValue >= $i)
                    <i class="fas fa-star"></i>
                @elseif($averageValue >= $i - 0.5)
                    <i class="fas fa-star-half-alt"></i>
                @else
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                @endif
            @endforeach
        </li>
    </ul>

    <!-- Atmosphere Rating -->
    <ul>
        <li>Atmosphere</li>
        <li>
            @foreach(range(1, 5) as $i)
                @if($averageAtmosphere >= $i)
                    <i class="fas fa-star"></i>
                @elseif($averageAtmosphere >= $i - 0.5)
                    <i class="fas fa-star-half-alt"></i>
                @else
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                @endif
            @endforeach
        </li>
    </ul>
</div>

          </div>
           <div class="col-md-4 col-lg-4 col-12">
            <div class="rating-review tw">
              <h5>Details</h5>
              @php
    $menuItems = $business_detail->menuItems; // Get all menu items
    $minPrice = $menuItems->min('price'); // Find the lowest price
    $maxPrice = $menuItems->max('price'); // Find the highest price
@endphp
              <p>Price Range <span>$ {{number_format($minPrice, 2)}} - ${{number_format($maxPrice, 2)}}</span></p>
       @php
              $menuItems = $business_detail->menuItems->take(3); // Take the first 3 items
@endphp


              <p>Cusines <span>{{ $menuItems->pluck('name')->join(', ') }}</span></p>
              <!-- <p>Special Diets <span>Chinese. Italian</span></p> -->
              <p class="bot">
{{$business_detail->short_description??'-'}}
            </p>
            </div>
          </div>
           <div class="col-md-4 col-lg-4 col-12">
            <div class="rating-review tw">
              <h5>Location and Contact</h5>
              @if (filter_var($business_detail->map, FILTER_VALIDATE_URL) && strpos($business_detail->map, 'google.com/maps') !== false)
    <!-- If the URL is valid and contains 'google.com/maps', display the iframe -->
    <iframe 
        src="{{ strpos($business_detail->map, 'embed?') !== false ? $business_detail->map : 'https://www.google.com/maps/embed?pb=' . urlencode($business_detail->map) }}" 
        width="350" 
        height="200" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
@else
    <!-- If the URL is invalid, show a message -->
    <p>URL is incorrect or invalid. Please provide a valid Google Maps link.</p>
@endif
   <ul class="cont-info"> 
               <li><i class="fas fa-map-marker-alt"></i><p>{{$business_detail->address}}</p></li>
               <li><i class="fas fa-phone-alt"></i><a href="telto:+2 144-456-6789">{{$business_detail->phone}}</a></li>
               <li><i class="fas fa-globe-africa"></i><p><a href="{{$business_detail->website}}">Website</a></p></li>
             </ul>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <div class="menu-bx">
              <h4>Menu</h4>
              @php
    $menuItems = $business_detail->menuItems;
@endphp

@php
    $menuItems = $business_detail->menuItems;
@endphp

@foreach ($menuItems->chunk(2) as $chunk)  <!-- Split menu items into chunks of 2 -->
    <ul>
        @foreach ($chunk as $item)
            <li>
                <h5>{{ $item->name }}</h5>
                <p>{{ $item->description }}</p>
            </li>
            <li>
                <h5>${{ number_format($item->price, 2) }}</h5>
            </li>
        @endforeach
    </ul>
@endforeach

            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <div class="menu-bx tw">
              <h4>Contribute</h4>
               <ul class="img-uplo"> 
               <li><a href="#" class="uplo" data-bs-toggle="modal" data-bs-target="#reviewModal">Write a review</a></li>
          
               <!-- <li><a href="#" class="uplo-1">Upload a photo</a></li> -->
               </ul>
            </div>
          </div>
      <!-- Modal -->
<!-- Modal Structure -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="reviewModalLabel">Write a Review</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
    <form id="reviewForm" action="{{ route('reviews') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="business" value="{{$business_detail->id}}">

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input name="name" type="text" id="name" class="form-control" placeholder="Write your name..." required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" id="email" class="form-control" placeholder="Write your email..." required>
        </div>

        <div class="mb-3">
            <label for="food" class="form-label">Food</label>
            <select name="food" id="food" class="form-select" required>
                <option value="" disabled selected>Select Rating</option>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="service" class="form-label">Service</label>
            <select name="service" id="service" class="form-select" required>
                <option value="" disabled selected>Select Rating</option>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="value" class="form-label">Value</label>
            <select name="value" id="value" class="form-select" required>
                <option value="" disabled selected>Select Rating</option>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="attmosphare" class="form-label">Atmosphere</label>
            <select name="atmosphere" id="attmosphare" class="form-select" required>
                <option value="" disabled selected>Select Rating</option>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="primaryImage" class="form-label">Image</label>
            <input name="primaryImage" type="file" id="primaryImage" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="review" class="form-label">Review</label>
            <textarea name="reviews" id="review" class="form-control" rows="4" placeholder="Write your review..." required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
</div>




    </div>
  </div>
</div>




<!-- Claim Structure -->
<div class="modal fade" id="claimModal" tabindex="-1" aria-labelledby="claimModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="claimModalLabel">You have to signup for claim</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
    <form id="claimform" action="{{ route('claim') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="business" value="{{$business_detail->id}}">

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input name="name" type="text" id="name" class="form-control" placeholder="Write your name..." required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" id="email" class="form-control" placeholder="Write your email..." required>
        </div>

       


        <div class="mb-3">
            <label for="file" class="form-label">file</label>
            <input name="file" except="pdf,word" type="file" id="file" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Write your description..." required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
</div>




    </div>
  </div>
</div>

        </div>
        <div class="row">
        @php
    $reviews = $business_detail->reviews;
    $totalReviews = $reviews->count();

    // Initialize counts
    $excellentCount = 0;
    $goodCount = 0;
    $averageCount = 0;
    $poorCount = 0;

    if ($totalReviews > 0) {
        foreach ($reviews as $review) {
            $overallRating = ($review->food + $review->service + $review->value + $review->atmosphere) / 4;

            if ($overallRating >= 4.5) {
                $excellentCount++;
            } elseif ($overallRating >= 3.5) {
                $goodCount++;
            } elseif ($overallRating >= 2.5) {
                $averageCount++;
            } else {
                $poorCount++;
            }
        }

        // Calculate percentages
        $excellentPercentage = ($excellentCount / $totalReviews) * 100;
        $goodPercentage = ($goodCount / $totalReviews) * 100;
        $averagePercentage = ($averageCount / $totalReviews) * 100;
        $poorPercentage = ($poorCount / $totalReviews) * 100;

        // Overall average score
        $overallAverageRating = round(
            ($reviews->sum('food') + $reviews->sum('service') + $reviews->sum('value') + $reviews->sum('atmosphere')) 
            / (4 * $totalReviews), 
            1
        );
    } else {
        $overallAverageRating = 0;
        $excellentPercentage = $goodPercentage = $averagePercentage = $poorPercentage = 0;
    }
@endphp
    <div class="col-md-4 review-summary">
    <h5>Reviews</h5>
    <div class="d-flex align-items-center">
        <div class="rating">
            {{ $overallAverageRating }}
            <i class="fas fa-star"></i>
        </div>
        <div class="rating-count ms-2">
            {{ $totalReviews }} reviews
        </div>
    </div>
    <div class="mt-3">
        <div class="d-flex justify-content-between">
            <div>Excellent</div>
            <div>{{ $excellentCount }}</div>
        </div>
        <div class="rating-bar">
            <div class="rating-fill" style="width: {{ $excellentPercentage }}%;"></div>
        </div>
        <div class="d-flex justify-content-between">
            <div>Good</div>
            <div>{{ $goodCount }}</div>
        </div>
        <div class="rating-bar">
            <div class="rating-fill" style="width: {{ $goodPercentage }}%;"></div>
        </div>
        <div class="d-flex justify-content-between">
            <div>Average</div>
            <div>{{ $averageCount }}</div>
        </div>
        <div class="rating-bar">
            <div class="rating-fill" style="width: {{ $averagePercentage }}%;"></div>
        </div>
        <div class="d-flex justify-content-between">
            <div>Poor</div>
            <div>{{ $poorCount }}</div>
        </div>
        <div class="rating-bar">
            <div class="rating-fill" style="width: {{ $poorPercentage }}%;"></div>
        </div>
    </div>
</div>
    <div class="col-md-8 popular-mentions">
     <h5>
      <!-- Popular Mentions -->
     </h5>
     <div>
      <!-- <span class="badge">
       chinese
      </span>
      <span class="badge">
       pasta
      </span>
      <span class="badge">
       mac and cheese
      </span>
      <span class="badge">
       chinese
      </span>
      <span class="badge">
       pasta
      </span>
      <span class="badge">
       mac and cheese
      </span>
      <span class="badge">
       chinese
      </span>
      <span class="badge">
       pasta
      </span>
      <span class="badge">
       mac and cheese
      </span>
     </div>
      <div>
      <span class="badge">
       chinese
      </span>
      <span class="badge">
       pasta
      </span>
      <span class="badge">
       mac and cheese
      </span>
      <span class="badge">
       chinese
      </span>
      <span class="badge">
       pasta
      </span>
      <span class="badge">
       mac and cheese
      </span>
      <span class="badge">
       chinese
      </span>
      <span class="badge">
       pasta
      </span>
      <span class="badge">
       mac and cheese
      </span> -->
     </div>

     @if($reviews)
     @forelse($reviews as $index => $review)
     <div id="review-container">
   <div class="review-item"style="{{ $index >= 4 ? 'display: none;' : '' }}">
    <div class="d-flex align-items-center">
@php
    // Calculate the average of the 4 ratings
    $averageRating = ($review->food + $review->service + $review->value + $review->atmosphere) / 4;
@endphp


     <img alt="Reviewer profile picture" class="rounded-circle me-3" height="50" src="{{asset($review->image)}}" width="50"/>
     <div>
      <div class="reviewer">
       Elena J.
       <span class="rating">

       @foreach(range(1, 5) as $i)
            @if($averageRating >= $i)
            <i class="fas fa-star">
            </i>
                        @elseif($averageRating >= $i - 0.5)
                <i class="fas fa-star-half-alt"></i> <!-- Half Star -->
            @else
                <i class="fa fa-star-o" aria-hidden="true"></i> <!-- Empty Star -->
            @endif
        @endforeach
     
       </span>
      </div>
      <div class="review-date">
       Written on 15th June 2021
      </div>
     </div>
    </div>
    <div class="mt-3">
     <h6>
      Lively with quality cuts and a great wine list
     </h6>
     <p>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
     </p>
    </div>
  
  </div>
  @empty
  <h3 class="text-center">No Review Found</h3>
   @endforelse
@else
<p>No Review Found</p>

   @endif
   </div>
 </div>
</div>
   <div class="view-more">
   @if(count($reviews) > 4)

    <button style="background: none;
	color: inherit;
	border: none;
	padding: 0;
	font: inherit;
	cursor: pointer;
	outline: inherit;" id="read-more">
     View More
     <i class="fas fa-chevron-right">
     </i>
    </button>
    <button id="show-less" class="btn btn-secondary" style="display: none;">Show Less</button>

    @endif

   </div>
      </div>
    </section>
    <!-- dish-delights end -->
     <!-- Trending start -->
   <section class="trending">
     <div class="container">
       <div class="row align-items-end">
           <div class="col-md-9 col-lg-9 col-12">
           <div class="browse-txt">
            <h4>Places You May Like</h4>
          
           </div>
         </div>
        
       </div>
       <div class="row">
        @forelse($featured as $features )
         <div class="col-md-4 col-lg-4 col-12">
           <div class="trend-img">
        <a href="{{route('business',$features->slug)}}">     <img src="{{asset('web-assets/images/tran-1.png')}}" alt="">
        </a>
             <h6>{{$features->category->name}}</h6>
             <a href="{{route('business',$features->slug)}}">  
             <i class="fas fa-arrow-right"></i>   </a>
           </div>
            <div class="trend-bot-txt">
              <h5>{{$features->name}}</h5>
              <p>{{$features->short_description}}</p>
              <ul>
                <li><i class="fas fa-map-marker-alt"></i></li>
                <li><p>{{$features->address}}</p></li>
              </ul>
              <ul class="star">
                <li><h5>Reviews (45)</h5></li>
                <li><a href="#"><i class="fas fa-star"></i></a>
            <a href="#"><i class="fas fa-star"></i></a>
            <a href="#"><i class="fas fa-star"></i></a>
            <a href="#"><i class="fas fa-star"></i></a>
          </li>
              </ul>
            </div>
         </div>
   @empty
<p>No Featured Business Found</p>
   @endforelse
       </div>
     </div>
   </section>
   <!-- trending end -->

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
  $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>

<script>
    $(document).ready(function() {

      
        // jQuery form validation
        $("#reviewForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                food: {
                    required: true
                },
                service: {
                    required: true
                },
                value: {
                    required: true
                },
                attmosphare: {
                    required: true
                },
                primaryImage: {
                    required: true,
                    extension: "jpg|jpeg|png|gif"
                },
                review: {
                    required: true,
                    minlength: 10
                }
            },
            messages: {
                name: {
                    required: "Please enter your name",
                    minlength: "Your name must be at least 3 characters long"
                },
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                },
                food: {
                    required: "Please select a food rating"
                },
                service: {
                    required: "Please select a service rating"
                },
                value: {
                    required: "Please select a value rating"
                },
                attmosphare: {
                    required: "Please select an atmosphere rating"
                },
                primaryImage: {
                    required: "Please upload an image",
                    extension: "Only image files (jpg, jpeg, png, gif) are allowed"
                },
                review: {
                    required: "Please write your review",
                    minlength: "Your review must be at least 10 characters long"
                }
            },
            errorElement: "div",
            errorClass: "invalid-feedback",
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("is-invalid").addClass("is-valid");
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var reviewItems = document.querySelectorAll('#review-container .review-item');
        var readMoreButton = document.getElementById('read-more');
        var showLessButton = document.getElementById('show-less');
        
        // Show all reviews and hide "Read More", show "Show Less"
        readMoreButton.addEventListener('click', function () {
            reviewItems.forEach(function (item) {
                item.style.display = 'block'; // Show all reviews
            });
            readMoreButton.style.display = 'none'; // Hide "Read More" button
            showLessButton.style.display = 'inline-block'; // Show "Show Less" button
        });

        // Show only the first four reviews and hide "Show Less", show "Read More"
        showLessButton.addEventListener('click', function () {
            reviewItems.forEach(function (item, index) {
                if (index >= 4) {
                    item.style.display = 'none'; // Hide reviews beyond the first four
                }
            });
            showLessButton.style.display = 'none'; // Hide "Show Less" button
            readMoreButton.style.display = 'inline-block'; // Show "Read More" button
        });
    });
</script>
@endsection