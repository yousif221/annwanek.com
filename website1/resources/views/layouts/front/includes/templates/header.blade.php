 <!-- header strat -->
 <header>
      <div class="menuSec">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-6">
              <div class="logo-img">
               <div class="nav-head">
                        <span style="font-size:30px;cursor:pointer" onclick="openNav()"><i class="fa-solid fa-bars"></i></span>
                     <div id="mySidenav" class="sidenav" style="width: 0px;">
                   <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                    <a href="{{route('webIndexPage')}}">HOME</a>
                    <a href="{{route('addbussiness')}}">ADD BUSINESS</a>
                    <a href="{{route('blogs')}}">BLOGS</a>
                    <a href="{{route('categories')}}">CATEGORIES</a>
                    <a href="{{route('login')}}">ACCOUNT</a>
                  </div>
                </div>
                <a href="{{route('webIndexPage')}}" ><img src="{{asset(getConfig('logo'))}}" alt="img"></a>
            </div>
            </div>
            <div class="col-md-8 col-lg-8 col-12">
              <ul class="#menu">
                <li><a href="{{route('login')}}"class="btn"><i class="fas fa-user"></i><p>   @if(auth()->check())  
                                    Dashboard
                                @else
                                    Sign Up
                                @endif
                              </p></a></li>
                <!-- <li><a href="{{route('login')}}" class="btt">Sign Up</a></li> -->
                <!-- <li><a href="#"class="btn"><i class="fas fa-globe-asia"></i><select>EN
                  <option>EN</option> 
                  <option>EN</option> 
                 <option>EN</option>    
                </select> <i class="fas fa-chevron-down"></i></a></li> -->
                <li>
                <a href="#"class="btn"><i class="fas fa-globe-asia"></i>
                <div class="gtranslate_wrapper"></div>
<script>window.gtranslateSettings = {"default_language":"en","languages":["en","ar","fr","es"],"wrapper_selector":".gtranslate_wrapper"}</script>
<script src="https://cdn.gtranslate.net/widgets/latest/dropdown.js" defer></script>
<i class="fas fa-chevron-down"></i></a>   </li>
                <li><a href="{{route('addbussiness')}}" class="btn"><p>Add Business</p></a></li>
              </ul>            
           </div>
          </div>
        </div>
      </div>
    </header>
    <!-- header strat -->