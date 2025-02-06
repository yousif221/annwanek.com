
@extends('layouts.admin.app')
@section('title', 'Graph')
@section('content')
    <div class="content">
        <!-- Hero -->
        <div class="block block-rounded pb-4" >
            <div class="block-content block-content-full bg-pattern" style="background-image: url('assets/media/various/bg-pattern-inverse.png');">
                <div class="py-20 text-center">
                    <h2 class="font-w700 text-black mb-10">
                        Graph Detail 
                    </h2>
                    <h3 class="h5 text-muted mb-0">
                        User Name {{$user->first_name}}!
                    </h3>
                </div>
                <div class="row">
                    <div class="col-2">
                    <select name="era" id="era" class="form-control">
                        <option value="weekly" selected>Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                    </div>
                </div>
            </div>
					<div class="row " style="text-align: center;display: flex;align-items: center;justify-content: center;">
						<div class="col-lg-8 text-center">
							<div id="top_x_div" class="weekly" style="width: 900px; height: 500px;text-align: center;"></div>  
						</div>
					</div>
					<div class="row" >
						<div class="col-lg-12" style="text-align: center;display: flex;align-items: center;justify-content: center;">
						<!-- <div id="top_x_div2" class="monthly d-none" style="width: 900px; height: 500px;text-align: center;"></div>   -->
						<canvas id="myChart" class="monthly d-none" style="width:100%;max-width:700px"></canvas>
						</div>
					</div>
                                <input type="text" value="{{$day30distance}}" name="dist30" hidden>
                                <input type="text" value="{{$day29distance}}" name="dist29" hidden>
                                <input type="text" value="{{$day28distance}}" name="dist28" hidden>
                                <input type="text" value="{{$day27distance}}" name="dist27" hidden>
                                <input type="text" value="{{$day26distance}}" name="dist26" hidden>
                                <input type="text" value="{{$day25distance}}" name="dist25" hidden>
                                <input type="text" value="{{$day24distance}}" name="dist24" hidden>
                                <input type="text" value="{{$day23distance}}" name="dist23" hidden>
                                <input type="text" value="{{$day22distance}}" name="dist22" hidden>
                                <input type="text" value="{{$day21distance}}" name="dist21" hidden>
                                <input type="text" value="{{$day20distance}}" name="dist20" hidden>
                                <input type="text" value="{{$day19distance}}" name="dist19" hidden>
                                <input type="text" value="{{$day18distance}}" name="dist18" hidden>
                                <input type="text" value="{{$day17distance}}" name="dist17" hidden>
                                <input type="text" value="{{$day16distance}}" name="dist16" hidden>
                                <input type="text" value="{{$day15distance}}" name="dist15" hidden>
                                <input type="text" value="{{$day14distance}}" name="dist14" hidden>
                                <input type="text" value="{{$day13distance}}" name="dist13" hidden>
                                <input type="text" value="{{$day12distance}}" name="dist12" hidden>
                                <input type="text" value="{{$day11distance}}" name="dist11" hidden>
                                <input type="text" value="{{$day10distance}}" name="dist10" hidden>
                                <input type="text" value="{{$day9distance}}" name="dist9" hidden>
                                <input type="text" value="{{$day8distance}}" name="dist8" hidden>
                                <input type="text" value="{{$daysevendistance}}" name="sevendist" hidden>
                                <input type="text" value="{{$daysixdistance}}" name="sixdist" hidden>
                                <input type="text" value="{{$dayfivedistance}}" name="fivedist" hidden>
                                <input type="text" value="{{$dayfourdistance}}" name="fourdist" hidden>
                                <input type="text" value="{{$daythreedistance}}" name="threedist" hidden>
                                <input type="text" value="{{$daytwodistance}}" name="twodist" hidden>
                                <input type="text" value="{{$dayonedistance}}" name="onedist" hidden>
                                <input type="text" value="{{$daycurrentdistance}}" name="currentdist" hidden>

								<!-- date -->
                                <input type="text" value="{{$d30}}" name="date30" hidden>
                                <input type="text" value="{{$d29}}" name="date29" hidden>
                                <input type="text" value="{{$d28}}" name="date28" hidden>
                                <input type="text" value="{{$d27}}" name="date27" hidden>
                                <input type="text" value="{{$d26}}" name="date26" hidden>
                                <input type="text" value="{{$d25}}" name="date25" hidden>
                                <input type="text" value="{{$d24}}" name="date24" hidden>
                                <input type="text" value="{{$d23}}" name="date23" hidden>
                                <input type="text" value="{{$d22}}" name="date22" hidden>
                                <input type="text" value="{{$d21}}" name="date21" hidden>
                                <input type="text" value="{{$d20}}" name="date20" hidden>
                                <input type="text" value="{{$d19}}" name="date19" hidden>
                                <input type="text" value="{{$d18}}" name="date18" hidden>
                                <input type="text" value="{{$d17}}" name="date17" hidden>
                                <input type="text" value="{{$d16}}" name="date16" hidden>
                                <input type="text" value="{{$d15}}" name="date15" hidden>
                                <input type="text" value="{{$d14}}" name="date14" hidden>
                                <input type="text" value="{{$d13}}" name="date13" hidden>
                                <input type="text" value="{{$d12}}" name="date12" hidden>
                                <input type="text" value="{{$d11}}" name="date11" hidden>
                                <input type="text" value="{{$d10}}" name="date10" hidden>
                                <input type="text" value="{{$d9}}" name="date9" hidden>
                                <input type="text" value="{{$d8}}" name="date8" hidden>
                                <input type="text" value="{{$seven}}" name="sevendate" hidden>
                                <input type="text" value="{{$six}}" name="sixdate" hidden>
                                <input type="text" value="{{$five}}" name="fivedate" hidden>
                                <input type="text" value="{{$four}}" name="fourdate" hidden>
                                <input type="text" value="{{$three}}" name="threedate" hidden>
                                <input type="text" value="{{$two}}" name="twodate" hidden>
                                <input type="text" value="{{$one}}" name="onedate" hidden>
                                <input type="text" value="{{$current}}" name="currentdate" hidden>
        </div>
    </div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
	var sevendist = $("input[name=sevendist]").val();
	var sixdist = $("input[name=sixdist]").val();
	var fivedist = $("input[name=fivedist]").val();
	var fourdist = $("input[name=fourdist]").val();
	var threedist = $("input[name=threedist]").val();
	var twodist = $("input[name=twodist]").val();
	var onedist = $("input[name=onedist]").val();
	var currentdist = $("input[name=currentdist]").val();

	var currentdate = $("input[name=currentdate]").val();
	var onedate = $("input[name=onedate]").val();
	var twodate = $("input[name=twodate]").val();
	var threedate = $("input[name=threedate]").val();
	var fourdate = $("input[name=fourdate]").val();
	var fivedate = $("input[name=fivedate]").val();
	var sixdate = $("input[name=sixdate]").val();
	var sevendate = $("input[name=sevendate]").val();

	google.charts.load('current', {'packages':['bar']});
	google.charts.setOnLoadCallback(drawStuff);

	function drawStuff() {
		var data = new google.visualization.arrayToDataTable([
			['Date', 'Distance'],
			[sevendate, parseFloat(sevendist)],
			[sixdate, parseFloat(sixdist)],
			[fivedate, parseFloat(fivedist)],
			[fourdate, parseFloat(fourdist)],
			[threedate, parseFloat(threedist)],
			[twodate, parseFloat(twodist)],
			[onedate, parseFloat(onedist)],
			[currentdate, parseFloat(currentdist)],
		]);

		var options = {
			title: 'Distance Covered Graph',
			width: 900,
			legend: { position: 'none' },
			chart: { title: 'Distance Covered Weekly Graph',
		/*subtitle: 'popularity by percentage'*/ },
		bars: 'vertical', // Required for Material Bar Charts.
		axes: {
			x: {
				0: { side: 'bottom', label: 'Date'} // Top x-axis.
			},
			y: {
                0: { side: 'left', label: 'Distance in KM"s'} // Top y-axis.
            }
        },
        bar: { groupWidth: "90%" }
    };

    var chart = new google.charts.Bar(document.getElementById('top_x_div'));
    chart.draw(data, options);
};
</script>
<script>
	//monthly
	var dist30 = $("input[name=dist30]").val();
	var dist29 = $("input[name=dist29]").val();
	var dist28 = $("input[name=dist28]").val();
	var dist27 = $("input[name=dist27]").val();
	var dist26 = $("input[name=dist26]").val();
	var dist25 = $("input[name=dist25]").val();
	var dist24 = $("input[name=dist24]").val();
	var dist23 = $("input[name=dist23]").val();
	var dist22 = $("input[name=dist22]").val();
	var dist21 = $("input[name=dist21]").val();
	var dist20 = $("input[name=dist20]").val();
	var dist19 = $("input[name=dist19]").val();
	var dist18 = $("input[name=dist18]").val();
	var dist17 = $("input[name=dist17]").val();
	var dist16 = $("input[name=dist16]").val();
	var dist15 = $("input[name=dist15]").val();
	var dist14 = $("input[name=dist14]").val();
	var dist13 = $("input[name=dist13]").val();
	var dist12 = $("input[name=dist12]").val();
	var dist11 = $("input[name=dist11]").val();
	var dist10 = $("input[name=dist10]").val();
	var dist9 = $("input[name=dist9]").val();
	var dist8 = $("input[name=dist8]").val();
	var sevendist = $("input[name=sevendist]").val();
	var sixdist = $("input[name=sixdist]").val();
	var fivedist = $("input[name=fivedist]").val();
	var fourdist = $("input[name=fourdist]").val();
	var threedist = $("input[name=threedist]").val();
	var twodist = $("input[name=twodist]").val();
	var onedist = $("input[name=onedist]").val();
	var currentdist = $("input[name=currentdist]").val();



	var currentdate = $("input[name=currentdate]").val();
	var onedate = $("input[name=onedate]").val();
	var twodate = $("input[name=twodate]").val();
	var threedate = $("input[name=threedate]").val();
	var fourdate = $("input[name=fourdate]").val();
	var fivedate = $("input[name=fivedate]").val();
	var sixdate = $("input[name=sixdate]").val();
	var sevendate = $("input[name=sevendate]").val();
	var date8 = $("input[name=date8]").val();
	var date9 = $("input[name=date9]").val();
	var date10 = $("input[name=date10]").val();
	var date11 = $("input[name=date11]").val();
	var date12 = $("input[name=date12]").val();
	var date13 = $("input[name=date13]").val();
	var date14 = $("input[name=date14]").val();
	var date15 = $("input[name=date15]").val();
	var date16 = $("input[name=date16]").val();
	var date17 = $("input[name=date17]").val();
	var date18 = $("input[name=date18]").val();
	var date19 = $("input[name=date19]").val();
	var date20 = $("input[name=date20]").val();
	var date21 = $("input[name=date21]").val();
	var date22 = $("input[name=date22]").val();
	var date23 = $("input[name=date23]").val();
	var date24 = $("input[name=date24]").val();
	var date25 = $("input[name=date25]").val();
	var date26 = $("input[name=date26]").val();
	var date27 = $("input[name=date27]").val();
	var date28 = $("input[name=date28]").val();
	var date29 = $("input[name=date29]").val();
	var date30 = $("input[name=date30]").val();

// var xyValues = [
//   {x:1, y:parseFloat(onedist)},
//   {x:2, y:parseFloat(twodist)},
//   {x:3, y:parseFloat(threedist)},
//   {x:4, y:parseFloat(fourdist)},
//   {x:5, y:parseFloat(fivedist)},
//   {x:6, y:parseFloat(sixdist)},
//   {x:7, y:parseFloat(sevendist)},
//   {x:8, y:parseFloat(dist8)},
//   {x:9, y:parseFloat(dist9)},
//   {x:10, y:parseFloat(dist10)},
//   {x:11, y:parseFloat(dist11)},
//   {x:12, y:parseFloat(dist12)},
//   {x:13, y:parseFloat(dist13)},
//   {x:14, y:parseFloat(dist14)},
//   {x:15, y:parseFloat(dist15)},
//   {x:16, y:parseFloat(dist16)},
//   {x:17, y:parseFloat(dist17)},
//   {x:18, y:parseFloat(dist18)},
//   {x:19, y:parseFloat(dist19)},
//   {x:20, y:parseFloat(dist20)},
//   {x:21, y:parseFloat(dist21)},
//   {x:22, y:parseFloat(dist22)},
//   {x:23, y:parseFloat(dist23)},
//   {x:24, y:parseFloat(dist24)},
//   {x:25, y:parseFloat(dist25)},
//   {x:26, y:parseFloat(dist26)},
//   {x:27, y:parseFloat(dist27)},
//   {x:28, y:parseFloat(dist28)},
//   {x:29, y:parseFloat(dist29)},
//   {x:30, y:parseFloat(dist30)},

// ];

// new Chart("myChart", {
//   type: "scatter",
//   data: {
//     datasets: [{
//       pointRadius: 4,
//       pointBackgroundColor: "rgb(0,0,255)",
//       data: xyValues
//     }]
//   },
//   options: {
//     legend: {display: false},
//     scales: {
//       xAxes: [{ticks: {min: 1, max:30}}],
//       yAxes: [{ticks: {min: 0, max:30}}],
//     }
//   }
// });

var yValues = [parseFloat(dist30),parseFloat(dist29),parseFloat(dist28),parseFloat(dist27),parseFloat(dist26),parseFloat(dist25),parseFloat(dist24),parseFloat(dist23),parseFloat(dist22),parseFloat(dist20),parseFloat(dist21),parseFloat(dist19),parseFloat(dist18),parseFloat(dist17),parseFloat(dist16),parseFloat(dist15),parseFloat(dist14),parseFloat(dist13),parseFloat(dist12),parseFloat(dist11),parseFloat(dist10),parseFloat(dist9),parseFloat(dist8),parseFloat(sevendist),parseFloat(sixdist),parseFloat(fivedist),parseFloat(fourdist),parseFloat(threedist),parseFloat(twodist),parseFloat(onedist)];

var xValues = [date30,date29,date28,date27,date26,date25,date24,date23,date22,date21,date20,date19,date18,date17,date16,date15,date14,date13,date12,date11,date10,date9,date8,sevendate,sixdate,fivedate,fourdate,threedate,twodate,onedate,currentdate];
new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 0, max:30}}],
    }
  }
});
</script>
<script type="text/javascript">
		$('#era').on('change', function() {

			var era =$("#era :selected").val();
			if(era == 'weekly'){
				$('.monthly').addClass('d-none');
				$('.weekly').removeClass('d-none');
			}
			else if(era == 'monthly'){
				$('.weekly').addClass('d-none');
				$('.monthly').removeClass('d-none');
			}
		});

</script>

@endsection
