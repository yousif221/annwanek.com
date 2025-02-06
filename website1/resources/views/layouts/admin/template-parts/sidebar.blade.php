
<nav id="sidebar">
    <div class="sidebar-content">
        <div class="content-header content-header-fullrow px-15">
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <div class="content-header-item">
                    <a class="font-w700" href="{{route('admin.panel')}}">
                        <?php $logo = explode('.',getConfig('logo')); ?>
                @if($logo[1] == 'mp4')
                 <video autoplay muted loop src="{{ asset(getConfig('logo')) }}" style="width:100%;"></video>
                @elseif($logo[1] == 'jpg' || $logo[1] == 'jpeg' || $logo[1] == 'png' || $logo[1] == 'gif')
                <img src="{{asset(getConfig('logo'))}}" class="img-fluid" style=" height:34px;   background: #f8af3c;width:100%;">
                @endif 
                    </a>
                </div>
            </div>
        </div>
        @if(!(auth()->user()->hasRole('Administrator')))
        <div class="content-side content-side-full content-side-user px-10 align-parent">
            <div class="sidebar-mini-hidden-b text-center">
                <a class="img-link" href="{{route('admin.profile')}}">
                    <img class="img-avatar" src="{{(auth()->user()->profile_image != null)?asset(auth()->user()->profile_image) :asset('storage/images/profile/placeholder.jpg')}}" alt="{{auth()->user()->username}}">
                </a>
                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase" href="/">{{auth()->user()->accountType()}}</a>
                    </li>
                </ul>
            </div>
        </div>
        @endif
        <form method="POST" id="logout" action="{{ route('logout') }}">
            @csrf
        </form>
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li>
                    <a href="{{route('admin.panel')}}" class="{{(\Request::route()->getName() == 'admin.panel')? 'active': ''}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                </li>
                <li>
                    <a href="{{url('/')}}" target="_blank"><i class="si si-globe-alt"></i><span class="sidebar-mini-hide">Visit Website</span></a>
                </li>
                @if(auth()->user()->hasRole('Administrator'))
                <li>
                    <a href="{{route('admin.showSubscriptions')}}" class="{{(\Request::route()->getName() == 'admin.showSubscriptions')? 'active': ''}}"><i class="si si-envelope-letter"></i><span class="sidebar-mini-hide">Newsletter Subscriptions</span></a>
                </li>
             
            
                <li>
                    <a href="{{route('admin.showInquiries')}}" class="{{(\Request::route()->getName() == 'admin.showInquiries')? 'active': ''}}"><i class="si si-phone"></i><span class="sidebar-mini-hide">Claims Inquiries</span></a>
                </li>
              
                <li class="{{ (\Illuminate\Support\Str::startsWith(\Request::route()->getName(), 'admin.content'))||(\Illuminate\Support\Str::startsWith(\Request::route()->getName(), 'admin.banner'))||(\Illuminate\Support\Str::startsWith(\Request::route()->getName(), 'admin.siteIdentity'))||(\Illuminate\Support\Str::startsWith(\Request::route()->getName(), 'admin.slider.')) ? 'open': ''}}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Website Management</span></a>
                    <ul>
                        <li class="active">
                            <a class="{{ (\Illuminate\Support\Str::startsWith(\Request::route()->getName(), 'admin.content.'))? 'active': ''}}" href="{{route('admin.content')}}">Pages Content</a>
                        </li>
                    
                        <li class="active">
                            <a class="{{ (\Illuminate\Support\Str::startsWith(\Request::route()->getName(), 'admin.banner'))? 'active': ''}}" href="{{route('admin.banner')}}">Pages Banner</a>
                        </li>
                        <li>
                            <a class="{{ (\Illuminate\Support\Str::startsWith(\Request::route()->getName(), 'admin.siteIdentity'))? 'active': ''}}" href="{{route('admin.siteIdentity')}}">Website Settings</a>
                        </li>
 <li>
                            <a href="{{route('admin.slider.index')}}" class="{{ (\Illuminate\Support\Str::startsWith(\Request::route()->getName(), 'admin.slider.'))? 'active': ''}}">Banner Sliders</a>
              </li>
                   
                    </ul>
                </li>
               
             
             
                <!-- <li>
                    <a href="{{route('admin.showOrders')}}" class="{{(\Request::route()->getName() == 'admin.showOrders')? 'active': ''}}"><i class="fa fa-first-order"></i><span class="sidebar-mini-hide"> Orders Mangement </span></a>
                </li> -->
                <li>
                    <a href="{{route('admin.user.index')}}" class="{{(\Request::route()->getName() == 'admin.user.index' || \Request::route()->getName() == 'admin.user.edit' || \Request::route()->getName() == 'admin.user.create')? 'active': ''}}"><i class="si si-speech"></i><span class="sidebar-mini-hide">Users Management</span></a>
                </li>
              
           
              <li>
                    <a href="{{route('admin.blog.index')}}" class="{{(\Request::route()->getName() == 'admin.blog.index' || \Request::route()->getName() == 'admin.blogs.edit' || \Request::route()->getName() == 'admin.blogs.create')? 'active': ''}}"><i class="si si-speech"></i><span class="sidebar-mini-hide">Blogs Management</span></a>
                </li>
              <li>
                    <a href="{{route('admin.state.index')}}" class="{{(\Request::route()->getName() == 'admin.state.index' || \Request::route()->getName() == 'admin.state.edit' || \Request::route()->getName() == 'admin.state.create')? 'active': ''}}"><i class="si si-list" data-toggle="tooltip" title="si-list"></i><span class="sidebar-mini-hide">State Management</span></a>
                </li>
                <li>
                    <a href="{{route('admin.gallery.index')}}" class="{{(\Request::route()->getName() == 'admin.subcategory.index' || \Request::route()->getName() == 'admin.gallery.edit' || \Request::route()->getName() == 'admin.gallery.create')? 'active': ''}}"><i class="si si-list" data-toggle="tooltip" title="si-list"></i><span class="sidebar-mini-hide">Gallery Management</span></a>
                </li> 
           
                <li class="{{ (\Illuminate\Support\Str::startsWith(\Request::route()->getName(), 'admin.category.'))|| (\Illuminate\Support\Str::startsWith(\Request::route()->getName(), 'admin.business.')) || (\Illuminate\Support\Str::startsWith(\Request::route()->getName(), 'admin.state.'))? 'open': ''}}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Business Management </span></a>
                    <ul>
                        <li class="active">
                            <a href="{{route('admin.category.index')}}" class="{{ (\Illuminate\Support\Str::startsWith(\Request::route()->getName(), 'admin.category.'))||(\Illuminate\Support\Str::startsWith(\Request::route()->getName(), 'subadmin.showmedicine'))? 'active': ''}}"><span class="sidebar-mini-hide">Category </span></a>
                        </li>
                         <li class="active">
                            <a href="{{route('admin.business.index')}}" class="{{ (\Illuminate\Support\Str::startsWith(\Request::route()->getName(), 'admin.business.'))? 'active': ''}}"><span class="sidebar-mini-hide">business </span></a>
                        </li> 
                        <li class="active">
                    <a href="{{route('admin.reviews.index')}}" class="{{(\Request::route()->getName() == 'admin.reviews.index' || \Request::route()->getName() == 'admin.reviews.edit' || \Request::route()->getName() == 'admin.reviews.create')? 'active': ''}}"><span class="sidebar-mini-hide">Reviews Management</span></a>
                </li>
                    </ul>
                </li>
                
                <!-- <li>
                    <a href="{{route('admin.reviews.index')}}" class="{{(\Request::route()->getName() == 'admin.reviews.index' || \Request::route()->getName() == 'admin.reviews.edit' || \Request::route()->getName() == 'admin.reviews.create')? 'active': ''}}"><i class="si si-speech"></i><span class="sidebar-mini-hide">Reviews Management</span></a>
                </li>
             
                <li>
                    <a href="{{route('admin.testimonial.index')}}" class="{{(\Request::route()->getName() == 'admin.testimonial.index' || \Request::route()->getName() == 'admin.testimonial.edit' || \Request::route()->getName() == 'admin.testimonial.create')? 'active': ''}}"><i class="si si-speech"></i><span class="sidebar-mini-hide">Testimonial Management</span></a>
                </li> -->
            
                @else
                <!-- <li>
                    <a href="{{url('user/order/index')}}" class="{{(\Request::route()->getName() == 'user.order.index' || \Request::route()->getName() == 'user.order.edit' )? 'active': ''}}"><i class="fa fa-first-order" aria-hidden="true"></i><span class="sidebar-mini-hide">Order Management</span></a>
                </li> -->

                    <li class="active">
                            <a href="{{route('admin.business.index')}}" class="{{ (\Illuminate\Support\Str::startsWith(\Request::route()->getName(), 'admin.business.'))? 'active': ''}}"><span class="sidebar-mini-hide">Business </span></a>
                        </li>
                   
                
                @endif
               
                <li>
                    <a href="{{route('admin.profile')}}" class="{{(\Request::route()->getName() == 'admin.profile')? 'active': ''}}"><i class="si si-user"></i><span class="sidebar-mini-hide">Profile</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
