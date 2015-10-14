      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            {ball_name}详情
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
              <!-- BAR CHART -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">{chart_name_1}</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="barChartMonth" style="height:230px"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">{chart_name_2}</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="barChartDay" style="height:230px"></canvas>
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
        var areaChartDataMonth = {
          labels: [1,2,3,4,5,6,7,8,9,10,11,12],
          datasets: [
            {
              label: "Electronics",
              fillColor: "rgba(210, 0, 0, 1)",
              strokeColor: "rgba(210, 0, 0, 1)",
              pointColor: "rgba(210, 0, 0, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [{counters_1}]
            }
          ]
        };
        var areaChartDataDay = {
          labels: [{days}],
          datasets: [
            {
              label: "Electronics",
              fillColor: "rgba(210, 0, 0, 1)",
              strokeColor: "rgba(210, 0, 0, 1)",
              pointColor: "rgba(210, 0, 0, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [{counters_2}]
            },
            {
              label: "Digital Goods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [{proportion_2}]
            }
          ]
        };
        //-------------
        //- BAR CHART -
        //-------------
        //月份
        var barChartCanvasMonth = $("#barChartMonth").get(0).getContext("2d");
        var barChartMonth = new Chart(barChartCanvasMonth);
        var barChartDataMonth = areaChartDataMonth;
        //星期
        var barChartCanvasDay = $("#barChartDay").get(0).getContext("2d");
        var barChartDay = new Chart(barChartCanvasDay);
        var barChartDataDay = areaChartDataDay;
        
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
        
        barChartMonth.Bar(barChartDataMonth, barChartOptions);
        barChartDay.Bar(barChartDataDay, barChartOptions);
      });
    </script>