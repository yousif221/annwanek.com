@extends('layouts.front.app')
@section('title','Blogs')


@section('css')
<style>
.blog-card-txt {
    width: 100% !important;
}

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

<section class="blog in">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-md-10 col-12">
        <div class="blog-txt wow fadeInUp" data-wow-duration="2s">
          <div class="ratio-bt">
            <form>
              @forelse($states as $state)
              <input type="radio" id="florida" name="state_id" value="{{$state->id}}" onclick="filterBlogs({{$state->id}})">
              <label for="florida">{{$state->name}}</label><br>
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
    <!-- Blog Sec Ends -->
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