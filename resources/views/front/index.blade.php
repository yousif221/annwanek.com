@extends('layouts.front.app')
@section('title','Home')
@section('css')
<style> 
  .smallimage{
    width: 40px;
    height: 40px;
  }
  .recent_image{
    width: 30px;
    height:  341px;
  }
  .ban-bot .inp {
    position: relative;
}
.ban-bot-txt input {
    width: 100% !important;
    padding: 0 5px;
    height: 35px;
    border: none;
    border-bottom: 1px solid;
    text-transform: capitalize;
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
  

 <!-- banner start -->
 <section class="main_slider">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        @forelse($slider as $index => $sliders)
        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
            <img src="{{asset($banner->image)}}" class="img-fluid" alt="...">
             <div class="carousel-caption">
              <div class="container">
                <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6 align-self-center">
                    <div class="banner_text wow fadeInLeft" data-wow-duration="2s">
                      <h1>{{$sliders->sub_text}}</h1>
                      <p>{{$sliders->text}} </p>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 align-self-center wow fadeInRight" data-wow-duration="2s">
                   <div class="row">
                     <div class="col-md-6 col-lg-6 col-12">
                       <div class="ban-img">
                         <img src="{{asset($sliders->primary_image)}}" alt="">
                           <div class="ban-sm">
                           <img src="{{asset('web-assets/images/ban-sm.png')}}" alt="">
                         </div>
                       </div>
                     </div>
                     <div class="col-md-6 col-lg-6 col-12">
                     <div class="ban-img-2">
                         <img src="{{asset($sliders->background_image)}}" alt="">
                       </div>
                     </div>
                   </div>
                   <a href="{{route('categories')}}" class="btn">Let's Discover <img src="images/btn-arr.png" alt=""></a>
                  </div>
                </div>
              </div>
            </div>
          </div>          
         @empty
         <p>No Slider Found</p>
        @endforelse

        </div>
      </div>
    </section>
    <!-- banner end -->

    <!-- @php
// Get the user's IP address (use $_SERVER['REMOTE_ADDR'] for the user's IP)
if (in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
  // Use a placeholder public IP address for testing on localhost
  $ip_address = '66.249.64.0';
} else {
  // Use the user's real IP address
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

// Check the response and extract details
if ($data && $data['status'] === 'success') {
    $country = $data['country']; // Country
    $state = $data['regionName']; // State/Region
    echo "Country: $country\n";
    echo "State: $state\n";
} else {
  
    echo "Unable to fetch location details.";
}

@endphp -->
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
   <section class="banner-bot wow fadeInDown" data-wow-duration="2s">
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
   <!-- discover start -->
   <section class="discover">
     <div class="container">
       <div class="row">
         <div class="col-md-12 col-lg-12 col-12">
           <div class="dis-txt wow fadeInUp" data-wow-duration="2s">
             <h4>{{$favourite_spot->title}}</h4>
             <p>{{$favourite_spot->subtitle}}</p>
           </div>
         </div>      
         @foreach($fav_cate as $index => $category)
          <div class="col-md-4 col-lg-4 col-12 wow {{ $index % 2 === 0 ? 'fadeInLeft' : 'fadeInRight' }}" data-wow-duration="2s">
              <div class="main-dis-bx">
                  <h5>{{ $category->name }}</h5> <!-- Replace with the category name field -->
                  <ul>
                      <li>
                          <img class="smallimage" src="{{ asset($category->small_image) }}" alt="{{ $category->name }}"> <!-- Small image -->
                          <p>{{ number_format($category->business->count()) }} available</p> <!-- Count of items -->
                      </li>
                      <a href="{{route('businessbycategory',$category->slug)}}">
                      <li><i class="fas fa-arrow-right"></i></li></a>
                  </ul>
                  <img src="{{ asset($category->primary_image) }}" alt="{{ $category->name }}"> <!-- Large image -->
              </div>
          </div>
          @endforeach

        </div>
     </div>
   </section>
   <!-- discover end -->
   <!-- browse start -->
   <section class="browse">
     <div class="container">
       <div class="row">
         <div class="col-md-9 col-lg-9 col-12">
           <div class="browse-txt wow fadeInUp" data-wow-duration="2s">
            <h4>{{$top_cities->title}}</h4>
            <p>{{$top_cities->subtitle}}</p> 
           </div>
         </div>
         <div class="col-md-3 col-lg-3 col-12 text-center wow fadeInDown" data-wow-duration="2s">
           <a href="#" class="btn-3">Visit More Cities <i class="fas fa-arrow-right"></i></a>
         </div>
         <!-- <div class="col-lg-4 col-md-4 col-12 wow fadeInLeft" data-wow-duration="2s">
           <div class="brows-img">
             <img src="images/brows-1.png" alt="">
             <h5>Los Angeles</h5>
           </div>
         </div>
         <div class="col-lg-4 col-md-4 col-12 wow fadeInRight" data-wow-duration="2s">
           <div class="brows-img">
             <img src="images/brows-2.png" alt="">
             <h5>California</h5>
           </div>
         </div>
         <div class="col-lg-4 col-md-4 col-12 wow fadeInLeft" data-wow-duration="2s">
           <div class="brows-img">
             <img src="images/brows-3.png" alt="">
             <h5>Columbia</h5>
           </div>
         </div>
         <div class="col-lg-4 col-md-4 col-12 wow fadeInRight" data-wow-duration="2s">
           <div class="brows-img">
             <img src="images/brows-4.png" alt="">
             <h5>New York</h5>
           </div>
         </div>
         <div class="col-lg-4 col-md-4 col-12 wow fadeInLeft" data-wow-duration="2s">
           <div class="brows-img">
             <img src="images/brows-5.png" alt="">
             <h5>Florida</h5>
           </div>
         </div>
         <div class="col-lg-4 col-md-4 col-12 wow fadeInRight" data-wow-duration="2s">
           <div class="brows-img">
             <img src="images/brows-6.png" alt="">
             <h5>Texas</h5>
           </div>
         </div> -->
         
         <div class="col-lg-4 col-md-4 col-12 wow fadeInRight" data-wow-duration="2s">
            <div class="brows-img">
               <a href="{{route('categories')}}">    
                <img src="{{ asset(  'web-assets/images/brows-1.png') }}" alt="">
               <h5>All</h5>       
                </a>
            </div>
        </div>

         @foreach ($states as $state)
        <div class="col-lg-4 col-md-4 col-12 wow fadeIn{{ $loop->iteration % 2 == 0 ? 'Right' : 'Left' }}" data-wow-duration="2s">
            <div class="brows-img">
            <a href="{{route('business-filter')}}?state={{$state->name}}">    <img src="{{ asset(  $state->primary_image) }}" alt="">
      <h5>{{ $state->name }}</h5>            </a>
            </div>
        </div>
    @endforeach
        </div>
     </div>
   </section>
   <!-- browse end -->
   <!-- Trending start -->
   <section class="trending">
     <div class="container">
       <div class="row align-items-end">
           <div class="col-md-9 col-lg-9 col-12 wow fadeInLeft" data-wow-duration="2s">
           <div class="browse-txt">
            <h4>{{$trending->title}}</h4>
            <p>{{$trending->subtitle}}. </p> 
           </div>
         </div>
         <div class="col-md-3 col-lg-3 col-12 text-center wow fadeInRight" data-wow-duration="2s">
           <a href="{{route('categories')}}" class="btn-3">Visit More Spots <i class="fas fa-arrow-right"></i></a>
         </div>
       </div>
       <div class="row">
         <!-- <div class="col-md-4 col-lg-4 col-12 wow fadeInLeft" data-wow-duration="2s">
           <div class="trend-img">
             <img src="{{asset('web-assets/images/tran-1.png')}}" alt="">
             <h6>Restaurant</h6>
             <i class="fas fa-arrow-right"></i>
           </div>
            <div class="trend-bot-txt">
              <h5>Girl and the Coat</h5>
              <p>Lorem ipsum dolor  amet, consectetur adipiscing elit, sed do eiusm, dolor sit amet, consectetur  sed orem ipsum dolor.</p>
              <ul>
                <li><i class="fas fa-map-marker-alt"></i></li>
                <li><p>6391 Elgin St. Celina, Dlaware 10299</p></li>
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
          <div class="col-md-4 col-lg-4 col-12 wow fadeInRight" data-wow-duration="2s">
           <div class="trend-img">
             <img src="{{asset('web-assets/images/tran-2.png')}}" alt="">
             <h6>Coffee Shop</h6>
             <i class="fas fa-arrow-right"></i>
           </div>
            <div class="trend-bot-txt">
              <h5>Peixoto Coffee Roasters</h5>
              <p>Lorem ipsum dolor  amet, consectetur adipiscing elit, sed do eiusm, dolor sit amet, consectetur  sed orem ipsum dolor.</p>
              <ul>
                <li><i class="fas fa-map-marker-alt"></i></li>
                <li><p>Chandler, AZ, United States</p></li>
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
          <div class="col-md-4 col-lg-4 col-12 wow fadeInLeft" data-wow-duration="2s">
           <div class="trend-img">
             <img src="{{asset('web-assets/images/tran-3.png')}}" alt="">
             <h6>Restaurant</h6>
             <i class="fas fa-arrow-right"></i>
           </div>
            <div class="trend-bot-txt">
              <h5>Slow by Slow Coffee</h5>
              <p>Lorem ipsum dolor  amet, consectetur adipiscing elit, sed do eiusm, dolor sit amet, consectetur  sed orem ipsum dolor.</p>
              <ul>
                <li><i class="fas fa-map-marker-alt"></i></li>
                <li><p>6391 Elgin St. Celina, Dlaware 10299</p></li>
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
         </div> -->
         @forelse($trendings as $busines)
         <div class="col-md-4 col-lg-4 col-12">
           <div class="trend-img">
           <a href="{{route('business',$busines->slug)}}">       <img src="{{asset($busines->business_image)}}" alt="" style="height:262px;width:416px;">
          </a>
           <h6>{{$busines->category->name}}</h6>
             <a href="{{route('business',$busines->slug)}}"><i class="fas fa-arrow-right"></i></a>
           </div>
            <div class="trend-bot-txt">
            <a href="{{route('business',$busines->slug)}}">   <h5>{{$busines->name}}</h5>
            </a>
            <p>{{$busines->short_description}}</p>
              <ul>
                <li><i class="fas fa-map-marker-alt"></i></li>
                <li><p>{{$busines->address}}</p></li>
              </ul>
              <ul class="star">
                <li><h5>Reviews ({{ $busines->reviews->count() }})</h5></li>

                <!-- Calculate the average of all review fields (food, service, value, atmosphere) -->
                @php
                    $reviews = $busines->reviews;
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
   <!-- updates start -->
   <section class="updates">
    <div class="row">
     <div class="update-slid">
      @forelse($galleries as $gallery)
       <div>
         <img src="{{asset($gallery->primary_image)}}">
       </div>
       @empty
       <p>No Gallery Image Found</p>
     @endforelse
     </div>
   </div>
      <div class="row mt-5">
     <div class="update-slid-2" dir="rtl">
     @forelse($galleries as $gallery)
       <div>
         <img src="{{asset($gallery->primary_image)}}">
       </div>
    @empty
<p>No Gallery Image Found</p>
    @endforelse
     </div>
   </div>
   <div class="update-bx wow fadeInUpBig" data-wow-duration="2s">
     <h3>{{$newsletter->title}}</h3>
     <p>{{$newsletter->subtitle}} </p>
     <div class="sign-inp">
      <form id="newsletter_form">
        @csrf
       <input type="email" name="newsletter_email" placeholder="enter email here">
       <button type="submit">Subscribe <i class="fas fa-paper-plane"></i></button>
       </form>
     </div>
   </div>
   </section>
    <!-- updates start -->
     
   <!-- Recent start -->
   <section class="recent">
     <div class="container">
       <div class="row">
         <div class="col-lg-10 col-md-10 col-12">
           <div class="recent-txt wow fadeInDown" data-wow-duration="2s">
             <h4>{{$recently->title}}</h4>
             <p>{{$recently->subtitle}}</p>
           </div>
         </div>
       </div>
       <div class="row">
        @forelse($recently_added as $index => $recently)
         <div class="col-md-3 col-lg-3 col-12 wow {{ $index % 2 === 0 ? 'fadeInLeft' : 'fadeInRight' }}" data-wow-duration="2s">
           <div class="recent-img">
           <a href="{{route('business',$recently->slug)}}">       <img class="recent_image" src="{{asset($recently->business_image)}}" alt="">
        </a>
          </div>
           <div class="recent-txt-bot">
           <a href="{{route('business',$recently->slug)}}">    <h5>{{$recently->name}}</h5>
         </a>
           <ul>
               <li><p>{{$recently->address}} </p></li>
               <li>      <a href="{{route('business',$recently->slug)}}"> <i class="fas fa-arrow-right"></i></a></li>
             </ul>
           </div>
         </div>
         @empty
         <p>No Recently added found</p>
        @endforelse
       </div>
     </div>
   </section>
   <!-- recent end -->
   <!-- blog start -->
   <section class="blog">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-md-10 col-12">
        <div class="blog-txt wow fadeInUp" data-wow-duration="2s">
          <h4>{{ $blogs_content->title }}</h4>
          <p>{{ $blogs_content->subtitle }}</p>
          <div class="ratio-bt">
            <form>
              @forelse($states as $state)
              <input type="radio" id="{{$state->name}}" name="state_id" value="{{$state->id}}" onclick="filterBlogs({{$state->id}})">
              <label for="{{$state->name}}">{{$state->name}}</label><br>
              @empty
              <p>No States Available</p>
           @endforelse
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row" id="blog-list">
      @foreach ($blogs as $blog)
        <div class="col-md-3 col-lg-3 col-12">
          <div class="blog-img">
            <img src="{{ asset( $blog->primary_image) }}" alt="">
          </div>
          <div class="blog-bot-txt">
            <h5>{{ $blog->title }} <span>in USA, {{ $blog->state->name }}</span></h5>
            <ul>
              <li><i class="fas fa-user"></i></li>
              <li><p>Posted by {{ $blog->username }}</p></li>
              <li><p>{{ $blog->created_at->format('jS F Y') }}</p></li>
            </ul>
            <p>{{ \Illuminate\Support\Str::limit($blog->description, 100) }}</p>
            <ul class="ank">
              <li><a href="{{ route('blog-detail', $blog->id) }}" class="btn-4">Read More</a></li>
              <li class="social">
                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-pinterest-p"></i></a>
              </li>
            </ul>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>



   <!-- blog end -->
@endsection

@section('js')

<script>
      const blogDetailRoute = "{{ route('blog-detail', ':id') }}";

  function filterBlogs(stateId) {
    
    fetch(`filter?state_id=${stateId}`)
      .then(response => response.json())
      .then(data => {
        const blogList = document.getElementById('blog-list');
        blogList.innerHTML = '';
        data.blogs.forEach(blog => {
          const blogUrl = blogDetailRoute.replace(':id', blog.id); // Replace :id with blog.id

          blogList.innerHTML += `
            <div class="col-md-3 col-lg-3 col-12">
              <div class="blog-img">
                <img src="${blog.primary_image ? `{{ asset('${blog.primary_image}') }}` : `{{ asset('images/default-blog.png') }}`}" alt="">
              </div>
              <div class="blog-bot-txt">
                <h5>${blog.title} <span>in USA, ${blog.state_name}</span></h5>
                <ul>
                  <li><i class="fas fa-user"></i></li>
                  <li><p>Posted by ${blog.username}</p></li>
                  <li><p>${blog.created_at}</p></li>
                </ul>
                <p>${blog.description.substring(0, 100)}...</p>
                <ul class="ank">
                  <li><a href="${blogUrl}" class="btn-4">Read More</a></li>
                  <li class="social">
                    <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          `;
        });
      })
      .catch(error => console.error('Error fetching blogs:', error));
  }
</script>
@endsection
