@extends('layouts.admin.app')
@section('title', 'Graph')
@section('css')
<style>
</style>
@endsection
@section('content')
<div class="content">

  <h2 class="content-heading">Graph</h2>

  <div class="row" style="text-align: center;display: flex;align-items: center;justify-content: center;">
    <div id="top_x_div" style="width: 900px; height: 500px;text-align: center;"></div>  
  </div>
  <input type="text" value="{{$daysevendistance}}" name="sevendist" hidden>
  <input type="text" value="{{$daysixdistance}}" name="sixdist" hidden>
  <input type="text" value="{{$dayfivedistance}}" name="fivedist" hidden>
  <input type="text" value="{{$dayfourdistance}}" name="fourdist" hidden>
  <input type="text" value="{{$daythreedistance}}" name="threedist" hidden>
  <input type="text" value="{{$daytwodistance}}" name="twodist" hidden>
  <input type="text" value="{{$dayonedistance}}" name="onedist" hidden>
  <input type="text" value="{{$daycurrentdistance}}" name="currentdist" hidden>
  <input type="text" value="{{$seven}}" name="sevendate" hidden>
  <input type="text" value="{{$six}}" name="sixdate" hidden>
  <input type="text" value="{{$five}}" name="fivedate" hidden>
  <input type="text" value="{{$four}}" name="fourdate" hidden>
  <input type="text" value="{{$three}}" name="threedate" hidden>
  <input type="text" value="{{$two}}" name="twodate" hidden>
  <input type="text" value="{{$one}}" name="onedate" hidden>
  <input type="text" value="{{$current}}" name="currentdate" hidden>
</div>

@endsection
@section('js')
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

	console.log(sevendist);
	console.log(sixdist);
	console.log(fivedist);
	console.log(fourdist);
	console.log(threedist);
	console.log(twodist);
	console.log(onedist);
	console.log(currentdist);

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
			chart: { title: 'Distance Covered Graph',
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

@endsection

