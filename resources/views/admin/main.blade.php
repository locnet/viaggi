@extends('admin_master')
@section('title','Home Page')
@section('inicio','class="active"')

@section('content')
	<div class="row">
        <div class="col-md-12 col-xs-12">
        	<h2 class="text-center lato-300">Andalusiando Viaggi</h2>
        </div>        
        <div class="col-md-6 col-xs-12">
            <div id="bookingchart"></div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div id="agencychart"></div>
        </div>
        <div class="col-md-6 col-xs-12" style="margin-top:60px">
            <h4 class="lato-300">
                Valor reservas de este año: 
                {{ number_format(App\Reservas::yearSales(Carbon\Carbon::now()->year)->sum('precio'), 2)  }} €
            </h4>
            
            <h4 class="lato-300">
                Agencias registradas: {{ $confirmed->count() + $unconfirmed->count() }}
            </h4>
            <h4 class="lato-300">
                Tours activos en este momento: {{ $tours->count() }}
            </h4>
        </div>
        <div class="col-md-6 col-xs-12" style="margin-top:60px">
            <h4 class="lato-300">
                El beneficio en las reservas de hoteles es de {{ $procentajes->agencias }}% en agencias
                y de {{ $procentajes->publico }}% en particulares.
            </h4>
        </div>
    </div>
@stop
@section('customjs')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Task', 'Agencias'],
            ['Confirmadas',     {{ $confirmed->count() }}],
            ['Sin confirmar',  {{ $unconfirmed->count() }}]
            ]);

	        var options = {
	            title: 'Situacion agencias',
	            pieHole: 0.4,
	        };

	        var chart = new google.visualization.PieChart(document.getElementById('agencychart'));
	        chart.draw(data, options);
        }
        // año en curso
        {{ $year = Carbon\Carbon::now()->year }}

        // grafico venta por meses
        google.charts.setOnLoadCallback(drawBookingChart);
        function drawBookingChart() {
          var data = google.visualization.arrayToDataTable([
            ['Task', 'Ventas €'],
            ['Enero',      {{ App\Reservas::monthlySales(1, $year)->sum('precio') }}],
            ['Febrero',    {{ App\Reservas::monthlySales(2, $year)->sum('precio') }}],
            ['Marzo',      {{ App\Reservas::monthlySales(3, $year)->sum('precio') }}],
            ['Abril',      {{ App\Reservas::monthlySales(4, $year)->sum('precio') }}],
            ['Mayo',       {{ App\Reservas::monthlySales(5, $year)->sum('precio') }}],
            ['Junio',      {{ App\Reservas::monthlySales(6, $year)->sum('precio') }}],
            ['Julio',      {{ App\Reservas::monthlySales(7, $year)->sum('precio') }}],
            ['Agosto',     {{ App\Reservas::monthlySales(8, $year)->sum('precio') }}],
            ['Septiembre', {{ App\Reservas::monthlySales(9, $year)->sum('precio') }}],
            ['Octubre',    {{ App\Reservas::monthlySales(10, $year)->sum('precio') }}],
            ['Noviembre',  {{ App\Reservas::monthlySales(11, $year)->sum('precio') }}],
            ['Diciembre',  {{ App\Reservas::monthlySales(12, $year)->sum('precio') }}]
            ]);

            var options = {
                title: 'Resevas hoteles por mes',
                pieHole: 0.4,
            };

            var chart = new google.visualization.BarChart(document.getElementById('bookingchart'));
            chart.draw(data, options);
        }
    </script>
@endsection