      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            直方图
            <small>Optional description</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
              <!-- BAR CHART -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">红球</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="barChartRed" style="height:230px"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">蓝球</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="barChartBlue" style="height:230px"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    <script>
      $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */
        var areaChartDataRed = {
          labels: [{labelsRed}],
          datasets: [
            {
              label: "Electronics",
              fillColor: "rgba(210, 0, 0, 1)",
              strokeColor: "rgba(210, 0, 0, 1)",
              pointColor: "rgba(210, 0, 0, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [{countersRed}]
            }
          ]
        };
        var areaChartDataBlue = {
          labels: [{labelsBlue}],
          datasets: [
            {
              label: "Electronics",
              fillColor: "rgba(0, 0, 210, 1)",
              strokeColor: "rgba(0, 0, 210, 1)",
              pointColor: "rgba(0, 0, 210, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [{countersBlue}]
            }
          ]
        };
        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvasRed = $("#barChartRed").get(0).getContext("2d");
        var barChartCanvasBlue = $("#barChartBlue").get(0).getContext("2d");
        var barChartRed = new Chart(barChartCanvasRed);
        var barChartBlue = new Chart(barChartCanvasBlue);
        var barChartDataRed = areaChartDataRed;
        var barChartDataBlue = areaChartDataBlue;
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
        barChartRed.Bar(barChartDataRed, barChartOptions);
        barChartBlue.Bar(barChartDataBlue, barChartOptions);
      });
    </script>