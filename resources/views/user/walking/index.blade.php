@extends('layouts.admin.app')
@section('title', 'Walking')
@section('css')
<style>
  .start{
    background: #fff ;
    box-shadow: 0 0 10PX 0 #000;
    border-radius: 50% ;
    padding: 100px 90px;
    font-size: 50px;
    font-weight: 800;
    color: #3f9ce8 !important;
    cursor: pointer;
  }
  .start:hover{
    background: #fff ;
    box-shadow: 0 0 10PX 0 rgb(112, 144, 180);
    border-radius: 50% ;
    padding: 105px 95px;
    font-size: 50px;
    font-weight: 800;
  }
  #output{
    font-size:40px;
    width: 90%;
    height: auto;
    background-color: white;
    border: 3px solid black;
    padding: 0 -222px;
    display: flex;
    position: relative;
    align-items: center;
    justify-content: center;
  }
</style>
@endsection
@section('content')
<div class="content">
  <h2 class="content-heading">Walking</h2>
  <div class="row" style="margin-top: 250px; margin-bottom:10px">
    <div class="offset-1 col-md-4" id="pc">
      @php $status = \App\Userdistance::orderBy('id','desc')->where('user_id',auth()->user()->id)->first();
      @endphp

      @if($status == null)
      <a class="start" id="show" onclick="getLocation()">Start</a>
      @else
      @if($status->status != '1')
      <a class="start" id="show" onclick="getLocation()">Start</a>
      @else
      <a class="start" id="show" onclick="updateLocation()">End</a>
      @endif
      @endif
    </div>
  </div>
</div>

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="route" id="route" value="walking">
<input type="hidden" name="routeend" id="routeend" value="walkingend">
<input type="hidden" name="routedupdate" id="routedupdate" value="distanceupdate">

@php $status  =  \App\Userdistance::orderBy('id', 'desc')->where('user_id',auth()->user()->id)->first();

if($status != null){
if($status->status == '1'){
$first  =  \App\Distance::where('user_distance_id',$status->id)->first();
$last  =  \App\Distance::orderBy('id', 'desc')->where('user_distance_id',$status->id)->first();
}
}
@endphp

@if($status != null)
@if($status->status == '1')
<input type="hidden" value="{{$status->status}}"  name="starts">
<input type="hidden" value="{{$first->latitude}}"  name="first-lat">
<input type="hidden" value="{{$first->longitude}}" name="first-lon">
<input type="hidden" value="{{$last->latitude}}"   name="last-lat">
<input type="hidden" value="{{$last->longitude}}"  name="last-lon">
@endif
@endif
@endsection
@section('js')
<script>
if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
    // document.getElementById("show").innerHTML = "Start";
//Start
function getLocation() {

if (navigator.geolocation) {

  navigator.geolocation.getCurrentPosition(showPosition);

  document.getElementById("show").innerHTML = "End";



} else { 

  x.innerHTML = "Geolocation is not supported by this browser.";

}

}



//End

  function updateLocation() {

if (navigator.geolocation) {

  navigator.geolocation.getCurrentPosition(endPosition);

  document.getElementById("show").innerHTML = "Start";



} else { 

  x.innerHTML = "Geolocation is not supported by this browser.";

}

}

//update











//startpost

function showPosition(position) {

  let route = $("input[name=route]").val();

$.ajax({

url: route,

type:"POST",

data:{latitude: position.coords.latitude , longitude: position.coords.longitude, "_token": $('#token').val()},

success:function(response){

  console.log(response);

  // aftercheck();

  if(response) {

      location.reload();

    // $('.success').text(response.success);

    // $("#ajaxform")[0].reset();

    

  }

},

error: function(error) {

 console.log(error);

}

});
startPause();
}

//endstartpost



//End post

function endPosition(position) {

let lat1 = $("input[name=first-lat]").val();

    let lon1 = $("input[name=first-lon]").val();

    let lat2 = $("input[name=last-lat]").val();

    let lon2 = $("input[name=last-lon]").val();

    lon1 =  lon1 * Math.PI / 180;

    lon2 = lon2 * Math.PI / 180;

    lat1 = lat1 * Math.PI / 180;

    lat2 = lat2 * Math.PI / 180;


    // Haversine formula

    let dlon = lon2 - lon1;

    let dlat = lat2 - lat1;

    let a = Math.pow(Math.sin(dlat / 2), 2)

             + Math.cos(lat1) * Math.cos(lat2)

             * Math.pow(Math.sin(dlon / 2),2);

           

    let c = 2 * Math.asin(Math.sqrt(a));



    // Radius of earth in kilometers. Use 3956

    // for miles

    let r = 6371;
//let r = 3956;



    // calculate the result

    let routeupload = $("input[name=routedupdate]").val();

    //console.log(routeupload);



    let data = c*r;




  let route = $("input[name=routeend]").val();



$.ajax({

url: route,

type:"POST",

data:{data:data,latitude: position.coords.latitude , longitude: position.coords.longitude, "_token": $('#token').val()},

success:function(response){

  console.log(response);

  // aftercheck();

  if(response) {

      location.reload();

    // $('.success').text(response.success);

    // $("#ajaxform")[0].reset();

    

  }

},

error: function(error) {

 console.log(error);

}

});
// reset();
}



//End end







      

      

const start =  $("input[name=starts]").val();

if(start != null){





setInterval(function() {

if (navigator.geolocation) {

  navigator.geolocation.getCurrentPosition(positions);

} else { 

  x.innerHTML = "Geolocation is not supported by this browser.";

}
let lat1 = $("input[name=first-lat]").val();

      let lon1 = $("input[name=first-lon]").val();

      let lat2 = $("input[name=last-lat]").val();

      let lon2 = $("input[name=last-lon]").val();

function positions(position){

      lon1 =  lon1 * Math.PI / 180;

      lon2 = lon2 * Math.PI / 180;

      lat1 = lat1 * Math.PI / 180;

      lat2 = lat2 * Math.PI / 180;


      // Haversine formula

      let dlon = lon2 - lon1;

      let dlat = lat2 - lat1;

      let a = Math.pow(Math.sin(dlat / 2), 2)

               + Math.cos(lat1) * Math.cos(lat2)

               * Math.pow(Math.sin(dlon / 2),2);

             

      let c = 2 * Math.asin(Math.sqrt(a));

 

      // Radius of earth in kilometers. Use 3956

      // for miles

      let r = 6371;
//let r = 3956;

 

      // calculate the result

      let routeupload = $("input[name=routedupdate]").val();

      //console.log(routeupload);



      let data = c*r;

      //console.log(data);

      $.ajax({

          url: routeupload,

          type:"POST",

          data:{data: data , latitude: position.coords.latitude , longitude: position.coords.longitude , "_token": $('#token').val()},

          success:function(response){

            console.log(response);

            // aftercheck();

            if(response) {

                // location.reload();

              // $('.success').text(response.success);

              // $("#ajaxform")[0].reset();

              

            }

          },

          error: function(error) {

          console.log(error);

          }

        });

      return(c * r);

      }

}, 20000);

}



// var time = 0;
// var running = 0;

//   function startPause() {
//     running = 1;
//     increment();

//   }


// function reset(){
//     running = 0;
//     time = 0;
//     document.getElementById("output").innerHTML = "00:00:00";}
// }

// function increment() {
//     if (running == 1) {
//         setTimeout(function() {
//             time++;
//             var mins = Math.floor(time/10/60);
//             var secs = Math.floor(time/10 % 60);
//             var tenths = time % 10;
//             if (mins < 10) {
//               mins = "0" + mins;
//             } 
//             if (secs < 10) {
//               secs = "0" + secs;
//             }
//             document.getElementById("output").innerHTML = mins + ":" + secs + ":" + "0" + tenths;
//             increment();
//         },100);
//     }

}
else{

    document.getElementById("pc").innerHTML = "<h4>Please Login Through Your Mobile</h4> <br> <a class='btn btn-primary' style='color:#fff !important' onclick='logout()'>Logout</a> ";

  
 }
















function logout(){

    document.getElementById('logout').submit();

}

</script>

@endsection

