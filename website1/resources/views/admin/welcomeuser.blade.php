


@extends('layouts.front.app')

@section('title','User Darshboard')


@section('content')
@php $banner = App\Banner::where('page','User')->first() @endphp
@php $content = App\Content::where('page','Register')->first() @endphp

<section class="breadcrumb-area" style="background-image: url({{asset($banner->image)}});">
        <div class="container">
            <div class="breadcrumb-text">
             
                <h2 class="page-title">{{$banner->title}}</h2>
                <ul class="breadcrumb-nav">
                    <li><a href="{{route('webIndexPage')}}">Home</a></li>
                    <li class="active">{{$banner->title}}</li>
                </ul>
            </div>
        </div>
    </section>


<section class="account-sec pt-120 pb-120">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="account-tabs">
              <ul class="nav flex-column nav-tabs border-0" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#" role="tab">Dashboard</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('user/order/index')}}" role="tab">Orders</a>
                </li>
              
             
                <li class="nav-item">
                <a href="{{route('admin.userprofile')}}" class="{{(\Request::route()->getName() == 'admin.userprofile')? 'active': ''}} nav-link"
                 > <i class="si si-user"></i><span class="sidebar-mini-hide">User Account Setting</span></a>

                </li>
                <li class="nav-item">
                  <a href="{{ route('logout') }}" class="nav-link logout" onclick="{document.getElementById('logout').submit();}">
                   <i class="fal fa-power-off"></i>
                  Logout</a>
                </li>
              </ul>
            </div>
          </div>
          
          <div class="col-lg-8">
            <div class="tab-content">
              <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                <div class="dashboard-content">
                  <p class="text-white mb-30">Hello <b> {{auth()->user()->name()}}</b>
                   </b>?
                    <a href="{{ route('logout') }}">Log Out</a>
                  </p>
                  <p class="text-white">From Your Account Dashboard You can View Your <a href="{{url('user/order/index')}}">Recent Orders</a></p>
                </div>
              </div>
              <div class="tab-pane fade" id="orders" role="tabpanel">
                <div class="content-heading mb-50">
                  <h3>My Orders</h3>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                </div>
                <div class="order-table">
                  <table class="table cw-cart-table mb-0">
                    <thead>
                      <tr>
                        <th></th>
                        <th scope="col" class="product-name">My Order</th>
                        <th scope="col" class="product-qty">Order ID</th>
                        <th scope="col" class="product-price">Order Date</th>
                        <th scope="col" class="product-price">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="product-remove text-center cw-align">
                          <a href="my-account.html#"><i class="fas fa-times"></i></a>
                        </td>
                        <td data-title="Product" class="has-title">
                          <div class="product-thumbnail">
                            <img src="assets/img/shop/cart-1.png" alt="product_thumbnail">
                          </div>
                          <a href="shop-detail.html">Product1</a>
                        </td>
                        <td class="product-price text-white cw-align has-title" data-title="Order ID">#b123jhk4h</td>
                        <td class="product-price text-white cw-align has-title" data-title="Order Date">12-Sep-2022</td>
                        <td data-title="Actions" class="has-title">
                          <a href="my-account.html#" class="main-btn btn-filled">Order Now</a>
                        </td>
                      </tr>
                      <tr>
                        <td class="product-remove text-center cw-align">
                          <a href="my-account.html#"><i class="fas fa-times"></i></a>
                        </td>
                        <td data-title="Product" class="has-title">
                          <div class="product-thumbnail">
                            <img src="assets/img/shop/cart-2.png" alt="product_thumbnail">
                          </div>
                          <a href="shop-detail.html">Product2</a>
                        </td>
                        <td class="product-price text-white cw-align has-title" data-title="Order ID">#b673juyk4h</td>
                        <td class="product-price text-white cw-align has-title" data-title="Order Date">14-Sep-2022</td>
                        <td data-title="Actions" class="has-title">
                          <a href="my-account.html#" class="main-btn btn-filled">Order Now</a>
                        </td>
                      </tr>
                      <tr>
                        <td class="product-remove text-center cw-align">
                          <a href="my-account.html#"><i class="fas fa-times"></i></a>
                        </td>
                        <td data-title="Product" class="has-title">
                          <div class="product-thumbnail">
                            <img src="assets/img/shop/cart-3.png" alt="product_thumbnail">
                          </div>
                          <a href="shop-detail.html">Product3</a>
                        </td>
                        <td class="product-price text-white cw-align has-title" data-title="Order ID">#Q123jh4h</td>
                        <td class="product-price text-white cw-align has-title" data-title="Order Date">12-Sep-2022</td>
                        <td data-title="Actions" class="has-title">
                          <a href="my-account.html#" class="main-btn btn-filled">Order Now</a>
                        </td>
                      </tr>
                      <tr>
                        <td class="product-remove text-center cw-align">
                          <a href="my-account.html#"><i class="fas fa-times"></i></a>
                        </td>
                        <td data-title="Product" class="has-title">
                          <div class="product-thumbnail">
                            <img src="assets/img/shop/cart-1.png" alt="product_thumbnail">
                          </div>
                          <a href="shop-detail.html">Product4</a>
                        </td>
                        <td class="product-price text-white cw-align has-title" data-title="Order ID">#R444lo98</td>
                        <td class="product-price text-white cw-align has-title" data-title="Order Date">20-Sep-2022</td>
                        <td data-title="Actions" class="has-title">
                          <a href="my-account.html#" class="main-btn btn-filled">Order Now</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="downloads" role="tabpanel">
                  <div class="content-heading download-content">
                      <h3>You Haven't Downloaded Any Product</h3>
                      <p>You still havent saved any products yet, Go back to the products page and check some of your favorite products</p>
                      <a href="shop-left.html" class="main-btn btn-outline mt-20">Browse Products</a>
                  </div>
              </div>
              <div class="tab-pane fade" id="address" role="tabpanel">
                  <div class="address-content">
                      <p class="mb-30">The Following Address will Be Used on Checkout Page by Default</p>
                      <div class="extra-info mb-30">
                          <div class="billing-info">
                              <h3>Billing Address</h3>
                              <p>John Benjamin</p>
                          </div>
                          <a href="my-account.html#" class="btn-link">Edit</a>
                      </div>
                      <div class="extra-info">
                          <div class="shipping-info">
                              <h3>Shipping Address</h3>
                              <p>You have not Setup this Type of Address Yet.</p>
                          </div>
                          <a href="my-account.html#account-detail" class="btn-link">Add</a>
                      </div>
                  </div>
              </div>
              <div class="tab-pane fade" id="account-detail" role="tabpanel">
                  <div class="profile-content">
                         <div class="content-heading mb-50">
                             <h3>Welcome Back</h3>
                             <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                         </div>
                         <form method="post">
                             <div class="row">
                                 <div class="col-lg-6 input-group input-group-two mb-20">
                                    <label>First Name
                                      <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" placeholder="John" name="fname">
                                </div>
                                 <div class="col-lg-6 input-group input-group-two mb-20">
                                    <label>Last Name
                                      <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" placeholder="Benjamin" name="lname">
                                </div>
                                 <div class="col-12 input-group input-group-two mb-20">
                                    <label>Display Name
                                      <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" placeholder="John Benjamin" name="dname">
                                    <p class="mt-2">This is how your Name will be Displayed in the Account Section and Reviews..</p>
                                </div>
                                <div class="col-12 input-group input-group-two mb-20">
                                    <label>Email Address
                                      <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" placeholder="abc@email.com" name="email">
                                </div>
                                <div class="col-12 input-group input-group-two mb-20">
                                    <label>Current Password(Leave Blank to Leave Unchanged)
                                    </label>
                                    <input type="text" placeholder="Current Password" name="c-password">
                                </div>
                                <div class="col-12 input-group input-group-two mb-20">
                                    <label>New Password(Leave Blank to Leave Unchanged)
                                    </label>
                                    <input type="text" placeholder="New Password" name="n-password">
                                </div>
                                <div class="col-12 input-group input-group-two mb-20">
                                    <label>Confirm New Password
                                    </label>
                                    <input type="text" placeholder="Confirm Password" name="c-password">
                                </div>
                             </div>
                             <button type="submit" class="main-btn btn-filled">Save Changes</button>
                         </form>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>


    <a href="#" class="back-to-top" id="backToTop">
    <i class="fal fa-angle-double-up"></i>
  </a>

@endsection


@section('js')

<script src="{{asset('a-asset/js/custom.core.min.js')}}"></script>
<script src="{{asset('a-asset/js/custom.app.min.js')}}"></script>
<script src="{{asset('js/sweetalert.js')}}"></script>
@if(Session::has('error'))
    <script>
        Swal.fire({
            title: 'Error!',
            text: "{{Session::get('error')}}",
            icon: 'error',
            confirmButtonText: 'Okay!'
        });
    </script>
@endif
@if(Session::has('success'))
    <script>
        Swal.fire({
            title: 'Congratulations!',
            text: "{{Session::get('success')}}",
            icon: 'success',
            confirmButtonText: 'Okay!'
        });
    </script>
   
@endif
<script>
           $(function() {
        $('.mark-as-read').click(function() {
            var request = sendRequest($(this).data('id'),$(this).data('type'));
            request.done(() => {
                $(this).parents('.main-cls').remove();
            });
        });
        $('#mark-all').click(function() {
            var request = sendRequest();
            request.done(() => {
                $('.main-cls').remove();
            })
        });
    });

    function sendRequest(id = null,type = null) {
      
        var _token = "{{ csrf_token() }}";
        return $.ajax("{{ route('admin.markAsNotification') }}", {
            method: 'POST',
            data: {_token, id},
            success: function(data){
                if(data.status == '1'){
                    if(type == 'order'){
                    var id = data.id;
                    var path = "{{route('admin.showOrders',':path')}}";
                    window.location.href = path.replace(':path', id);
                    // location.reload();
                    }
                 
                    else if(type == 'application'){
                    var id = data.id;
                    var path = "{{route('admin.displayapplications',':path')}}";
                    window.location.href = path.replace(':path', id);
                }


                }
            }
        });
    }
    </script>
@yield('js')
@endsection


