    <!-- footer start -->
    <footer>
     <div class="fot-top">
     <div class="container"> 
         <div class="row">
           <div class="col-lg-12 col-md-12 col-12">
             <div class="fot-txt wow fadeInLeft" data-wow-duration="2s">
               <img src="{{asset(getConfig('logo'))}}" alt="">
               <p>{{getConfig('tag_line')}}</p>
               <div class="follow">
                 <h5>Follow us on</h5>
                 <ul>
                   <li><a href="{{getConfig('facebook')}}"><i class="fab fa-facebook-f"></i></a></li>
                   <li><a href="{{getConfig('insta')}}"><i class="fab fa-instagram"></i></a></li>
                 </ul>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="fot-bot wow fadeInRight" data-wow-duration="2s">
       <div class="container">
         <div class="row">
           <div class="col-md-12 col-lg-12 col-12">
             <p>{{getConfig('copy_right')}}.</p>
           </div>
         </div>
       </div>
     </div>
   </footer>

        @include('layouts.front.includes.scripts')