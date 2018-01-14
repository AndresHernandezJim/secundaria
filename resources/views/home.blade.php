@extends('layouts.plantilla')

@section('contenido')

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col md-3">
				<div  id="uno"></div>
			</div>
		</div>
	</div>
</div>
 
@endsection

@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

      // Load Charts and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Draw the pie chart for Sarah's pizza when Charts is loaded.
      google.charts.setOnLoadCallback(uno);

   
      // Callback that draws the pie chart for Sarah's pizza.
      function uno() {

	        // Create the data table for Sarah's pizza.
	        var data = new google.visualization.DataTable();
	        data.addColumn('string', 'Topping');
	        data.addColumn('number', 'Slices');
	        data.addRows([
	          @foreach( $uno as $item )
	          ['{{$item->motivo}}', {{$item->cantidad}}],
	          @endforeach
	        ]);

	        // Set options for Sarah's pie chart.
	        var options = {title:'Grafica general motivos de reportes',
	                       width:400,
	                       height:300};

	        // Instantiate and draw the chart for Sarah's pizza.
	        var chart = new google.visualization.PieChart(document.getElementById('uno'));
	        chart.draw(data, options);
	    }

      
</script>
@endsection