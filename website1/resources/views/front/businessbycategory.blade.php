@extends('layouts.front.app')

@section('title','Categories')

@section('css')

<style>

    .ban-bot .inp {

    position: relative;

}

.ban-bot  .inp input {

    width: 100%;

    padding: 12px;

    border: unset;

}

.ban-bot form .inp button .fas {

    position: absolute;

    top: 30px;

    color: #000;

}

.searc {
    position: absolute;
    top: 30px;
    color: #000;
    right: 10px;
}

.ban-bot .inp input {

    width: 100%;

    padding: 26px;

    border: unset;

    background: ghostwhite;

}
.ban-bot-txt input {
    width: 100% !important;
    padding: 0 5px;
    height: 35px;
    border: none;
    border-bottom: 1px solid;
    text-transform: capitalize;
}
button, input[type="submit"], input[type="reset"] {

	background: none;

	color: inherit;

	border: none;

	padding: 0;

	font: inherit;

	cursor: pointer;

	outline: inherit;

}

</style>

@endsection

@section('content')

     <!-- Inner Banner Start -->

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

                      <h1>Business</h1>

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

    <a?php

// Get the user's IP address

if (in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {

    // Use a placeholder public IP address for testing on localhost

    $ip_address = '66.249.64.0'; // Example IP

} else {

    $ip_address = $_SERVER['REMOTE_ADDR'];

}



// API URL



$api_url = "http://ip-api.com/json/{$ip_address}";



// Use cURL to call the API

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $api_url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);

curl_close($ch);



// Decode the JSON response

$data = json_decode($response, true);



// Default state to pre-select

$matched_state = null;



if ($data && $data['status'] === 'success') {

    $matched_state = $data['regionName']; // Extract state/region from IP

}

?>

    <!-- banner-bot start -->

   <section class="banner-bot in">

     <div class="container">
     <div class="ban-bot-bx">
     <div class="row">
         <div class="col-md-8 col-lg-8 col-12">
           <div class="row">
             <div class="col-md-4 col-lg-4 col-12">
               <div class="ban-bot-txt">
               <form method="GET" action="{{route('business-filter')}}">
               <p>Location</p>
                 <ul>
                   <li><i class="fas fa-map-marker-alt"></i></li>
                   <li><select name="state">
                     <option disabled selected>Select State</option>
                    @foreach($states as $state)
                     <!-- <option value="{{$state->name}}">{{$state->name}}</option> -->
                     <option value="{{ $state->name }}"
                                                        {{ isset($matched_state) && $matched_state === $state->name ? 'selected' : '' }}>
                                                        {{ $state->name }}
                                                    </option>
                     @endforeach
                    </select></li>
                 </ul>
               </div>
             </div>
             <div class="col-md-4 col-lg-4 col-12">
               <div class="ban-bot-txt">
               <p>City</p>
                 <ul>
                   <!-- <li><i class="fas fa-map-marker-alt"></i></li> -->
                   <li> <input type="text"name="city" placeholder="city"> </li>
                 </ul>
               </div>
             </div>
             <div class="col-md-4 col-lg-4 col-12">
               <div class="ban-bot-txt">
                 <p>Categories</p>
                 <ul>
                   <li><img src="images/cate.png" alt=""></li>
                   <li><select name="category">Restaurants
                   <option disables selected>Select Categories</option>
                    @foreach($categories as $category)
                     <option value="{{$category->slug}}">{{$category->name}}</option>

                     @endforeach
                     </select>
                    </li>
                 </ul>
               </div>
             </div>
           </div>
         </div>
         <div class="col-md-4 col-lg-4 col-12">
           <div class="ban-bot">
            
               <div class="inp">
                 <input type="text" name="search" placeholder="Search">
                 <button type="submit" class="searc"><i class="fas fa-search"> </i></button>
               </div>
             </form>
           </div>
         </div>
       </div>

     </div>

   </div>

   </section>

   <!-- banner-bot end -->

      <!-- Trending start -->

   <section class="trending">

     <div class="container">

       <div class="row">





@forelse($businesses as $business)







         <div class="col-md-4 col-lg-4 col-12">

           <div class="trend-img">

           <a href="{{route('business',$business->slug)}}">             <img src="{{asset($business->business_image)}}" alt="">
</a>
             <h6>{{$business->category->name}}</h6>

             <a href="{{route('business',$business->slug)}}"><i class="fas fa-arrow-right"></i></a>

           </div>

            <div class="trend-bot-txt">

            <a href="{{route('business',$business->slug)}}">      <h5>{{$business->name}}</h5>
</a>
              <p>{{$business->short_description??'-'}}</p>

              <ul>

                <li><i class="fas fa-map-marker-alt"></i></li>

                <li><p>{{$business->address??'-'}}</p></li>

              </ul>

              <ul class="star">

                <li><h5>Reviews ({{ $business->reviews->count() }})</h5></li>



                <!-- Calculate the average of all review fields (food, service, value, atmosphere) -->

                @php

                    $reviews = $business->reviews;

                    $totalReviews = $reviews->count();



                    if ($totalReviews > 0) {

                        $totalFood = $reviews->sum('food');

                        $totalService = $reviews->sum('service');

                        $totalValue = $reviews->sum('value');

                        $totalAtmosphere = $reviews->sum('atmosphere');



                        // Calculate the overall average score

                        $averageScore = ($totalFood + $totalService + $totalValue + $totalAtmosphere) / (4 * $totalReviews);

                        $averageScore = round($averageScore); // Round the average to the nearest whole number

                    } else {

                        $averageScore = 0; // Set to 0 if no reviews

                    }

                @endphp



                <!-- Display stars based on the overall average score -->

                <li>

                    @for ($i = 1; $i <= 5; $i++)

                        @if ($i <= $averageScore)

                            <i class="fas fa-star"></i> <!-- Filled star -->

                        @else

                            <i class="far fa-star"></i> <!-- Empty star -->

                        @endif

                    @endfor

                </li>

            </ul>

            </div>

         </div>

     @empty

     <h3 class="text-center">No business found</h3>

     @endforelse

       </div>

     </div>

   </section>

   <!-- trending end -->

    <!-- Inner Banner End -->









@endsection

@section('js')

@endsection