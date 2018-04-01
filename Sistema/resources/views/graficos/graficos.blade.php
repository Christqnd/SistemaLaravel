@extends('home')
@section('resumen')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    @if (count($errors)>0)
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif
  </div>
</div>






<div class="row">
  <div class="col-md-4">
    <!-- AREA CHART -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Area Chart</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="areaChart" style="height: 250px; width: 371px;" height="250" width="371"></canvas>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>


  <!-- /.col (LEFT) -->


  <div class="col-md-4">
    <!-- LINE CHART -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Line Chart</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="lineChart" style="height: 250px; width: 371px;" height="250" width="371"></canvas>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>

  <!-- BAR CHART -->
  <div class="col-md-4">

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Bar Chart</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="barChart" style="height: 250px; width: 371px;" height="250" width="371"></canvas>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </div>
  <!-- /.col (RIGHT) -->
</div>


<div class="col-md-6">
  <div class="panel panel-info">
    <div class="panel-heading">Mes con más ventas</div>
    <div class="panel-body">
      <p>Mes

        @if ($tablaReporte[0]->Maximo_Mes === 1)
        Enero
        @elseif ($tablaReporte[0]->Maximo_Mes === 2)
        Febrero
        @elseif ($tablaReporte[0]->Maximo_Mes === 3)
        Marzo
        @elseif ($tablaReporte[0]->Maximo_Mes === 4)
        Abril
        @elseif ($tablaReporte[0]->Maximo_Mes === 5)
        Mayo
        @elseif ($tablaReporte[0]->Maximo_Mes === 6)
        Junio
        @elseif ($tablaReporte[0]->Maximo_Mes === 7)
        Julio
        @elseif ($tablaReporte[0]->Maximo_Mes === 8)
        Agosto
        @elseif ($tablaReporte[0]->Maximo_Mes === 9)
        Septiembre
        @elseif ($tablaReporte[0]->Maximo_Mes === 10)
        Octubre
        @elseif ($tablaReporte[0]->Maximo_Mes === 11)
        Noviembre
        @elseif ($tablaReporte[0]->Maximo_Mes === 12)
        Diciembre
        @endif

        con {{$tablaReporte[0]->Maximo}}
      </p>
    </div>
  </div>
</div>

<div class="col-md-6">
  <div class="panel panel-danger">
    <div class="panel-heading">Mes con menos ventas</div>
    <div class="panel-body">
      <p>Mes

        @if ($tablaReporte[0]->Minimo_Mes === 1)
        Enero
        @elseif ($tablaReporte[0]->Minimo_Mes === 2)
        Febrero
        @elseif ($tablaReporte[0]->Minimo_Mes === 3)
        Marzo
        @elseif ($tablaReporte[0]->Minimo_Mes === 4)
        Abril
        @elseif ($tablaReporte[0]->Minimo_Mes === 5)
        Mayo
        @elseif ($tablaReporte[0]->Minimo_Mes === 6)
        Junio
        @elseif ($tablaReporte[0]->Minimo_Mes === 7)
        Julio
        @elseif ($tablaReporte[0]->Minimo_Mes === 8)
        Agosto
        @elseif ($tablaReporte[0]->Minimo_Mes === 9)
        Septiembre
        @elseif ($tablaReporte[0]->Minimo_Mes === 10)
        Octubre
        @elseif ($tablaReporte[0]->Minimo_Mes === 11)
        Noviembre
        @elseif ($tablaReporte[0]->Minimo_Mes === 12)
        Diciembre
        @endif

        con {{$tablaReporte[0]->Minimo}}
      </p>
    </div>
  </div>
</div>
@push('scripts')

<script type="text/javascript">

  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var areaChart = new Chart(areaChartCanvas);

    var areaChartData = {
      labels: ["Enero",
      "Febrero",
      "Marzo",
      "Abril",
      "Mayo",
      "Junio",
      "Julio",
      "Agosto",
      "Septiembre",
      "Octubre",
      "Noviembre",
      "Diciembre"],
      datasets: [
      {
        label: "Electronics",
        fillColor: "rgba(60,141,188,0.3)",
        strokeColor: "rgba(60,141,188,1)",
        pointColor: "rgba(60,141,188,1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: [{{$tablaReporte[0]->Enero}},
        {{$tablaReporte[0]->Febrero}},
        {{$tablaReporte[0]->Marzo}},
        {{$tablaReporte[0]->Abril}},
        {{$tablaReporte[0]->Mayo}},
        {{$tablaReporte[0]->Junio}},
        {{$tablaReporte[0]->Julio}},
        {{$tablaReporte[0]->Agosto}},
        {{$tablaReporte[0]->Septiembre}},
        {{$tablaReporte[0]->Octubre}},
        {{$tablaReporte[0]->Noviembre}},
        {{$tablaReporte[0]->Diciembre}}]
      }
      ]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions);

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas);
    var lineChartOptions = areaChartOptions;
    lineChartOptions.datasetFill = false;
    lineChart.Line(areaChartData, lineChartOptions);


    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    barChartData.datasets[0].fillColor = "rgba(60,141,188,0.5)";
    barChartData.datasets[0].strokeColor = "rgba(60,141,188,1)";
    barChartData.datasets[0].pointColor = "rgba(60,141,188,1)";
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  });
</script>

@endpush

@endsection

