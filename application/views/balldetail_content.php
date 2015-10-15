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
                    <!-- <canvas id="barChartMonth" style="height:230px"></canvas> -->
                    <div id="chartMonth" style="height:512px"></div>
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
                    <!-- <canvas id="barChartMonth" style="height:230px"></canvas> -->
                    <div id="chartDay" style="height:512px"></div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    <script>
var chartMonth = echarts.init(document.getElementById('chartMonth')); 
var chartDay = echarts.init(document.getElementById('chartDay')); 
optionChartMonth = {
    tooltip: {
        trigger: 'item'
    },
    toolbox: {
        show: true,
        feature: {
            dataView: {show: true, readOnly: false},
            restore: {show: true},
            saveAsImage: {show: true}
        }
    },
    calculable: true,
    grid: {
        borderWidth: 0,
        y: 80,
        y2: 60
    },
    xAxis: [
        {
            type: 'category',
            show: true,
            data: [1,2,3,4,5,6,7,8,9,10,11,12]
        }
    ],
    yAxis: [
        {
            type: 'value',
            show: true
        }
    ],
    series: [
        {
            name: '月份分布',
            type: 'bar',
            itemStyle: {
                normal: {
                    color: function(params) {
                        // build a color map as your need.
                        var colorList = [
                            {colors_1}
                        ];
                        return colorList[params.dataIndex]
                    },
                    label: {
                        show: true,
                        position: 'top',
                        formatter: '{c}'
                    }
                }
            },
            data: [{counters_1}]
        }
    ]
};
optionChartDay = {
    tooltip: {
        trigger: 'item'
    },
    toolbox: {
        show: true,
        feature: {
            dataView: {show: true, readOnly: false},
            restore: {show: true},
            saveAsImage: {show: true}
        }
    },
    calculable: true,
    grid: {
        borderWidth: 0,
        y: 80,
        y2: 60
    },
    xAxis: [
        {
            type: 'category',
            show: true,
            data: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31]
        }
    ],
    yAxis: [
        {
            type: 'value',
            show: true
        },
        {
            type: 'value',
            splitNumber: 5,
            axisLabel : {
                formatter: function (value) {
                    // Function formatter
                    return value + '%'
                }
            },
            show: true
        }
    ],
    series: [
        {
            name: '月份分布',
            type: 'bar',
            itemStyle: {
                normal: {
                    label: {
                        show: true,
                        position: 'top',
                        formatter: '{c}'
                    }
                }
            },
            data: [{counters_2}]
        },
        {
            name: '比例',
            type: 'line',
            yAxisIndex: 1,
            data: [{proportion_2}]
        }
    ]
};
// 为echarts对象加载数据 
chartMonth.setOption(optionChartMonth);
chartDay.setOption(optionChartDay);

    </script>