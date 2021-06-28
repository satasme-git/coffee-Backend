

@extends('Layout.app2')

@section('body')
 <div class="row" style="padding: 16px 16px 0px 16px">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-green" style="border-radius: 3px">
                            <span class="info-box-icon"><i class="glyphicon glyphicon-usd"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Daily Collection</span>
                                <span class="info-box-number" id="totFC">45000</span>

                                <div class="progress">
                                    <div id="FC" class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    <spam  id="spfc" style="font-size: 11px" ></spam>% Increase in month
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-yellow" style="border-radius: 3px">
                            <span class="info-box-icon"><i class="glyphicon glyphicon-paperclip"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Past Due</span>
                                <span class="info-box-number" id="totCash">45000</span>

                                <div class="progress">
                                    <div id="CASH" class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    <spam  id="spcash" tyle="font-size: 11px"></spam>% Increase in month
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-red" style="border-radius: 3px">
                            <span class="info-box-icon"><i class="glyphicon glyphicon-pushpin"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Expenses</span>
                                <span class="info-box-number" id="totPay">45000</span>

                                <div class="progress">
                                    <div id="PAY" class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    <spam  id="sppay" tyle="font-size: 11px"></spam>% Increase in month
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-aqua" style="border-radius: 3px">
                            <span class="info-box-icon"><i class="glyphicon glyphicon-repeat"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">sample</span>
                                <span class="info-box-number" id="totPD">45000</span>

                                <div class="progress">
                                    <div id="PD" class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    <spam  id="sppd" tyle="font-size: 11px"></spam>% Increase in month
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
           
                <section class="col-lg-8 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs pull-right">
                            <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>

                            <li class="pull-left header"><i class="fa fa-inbox"></i> Active and Closed Applications</li>
                        </ul>
                        <div class="tab-content no-padding">
                            <!-- Morris chart - Sales -->

                            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 390px">
                                <!-- <div id="chartdiv" style="width:100%; height:380px;;margin-bottom:  20px">
                                
                                </div> -->
                                <figure class="highcharts-figure">
  <div id="container"></div>
  <p class="highcharts-description">
    Chart showing use of rotated axis labels and data labels. This can be a
    way to include more labels in the chart, but note that more labels can
    sometimes make charts harder to read.
  </p>
</figure>
                            </div>

                        </div>
                    </div>
                </section>
                <section class="col-lg-4 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs pull-right">
                            <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>

                            <li class="pull-left header" style="font-size: 18px"><i class="fa fa-inbox"></i>Income and Expenses</li>
                        </ul>
                        <div class="tab-content no-padding">
                            <!-- Morris chart - Sales -->

                            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 390px">
                                <div style="width:100%; height:390px;">
                                
                                <figure class="highcharts-figure">
 

</figure>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
                <!-- Main content -->

                <section class="content" style="height: 500px">

                </section>

            </div>
            </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
            <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
            <script>
 Highcharts.chart('container', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Monthly Average Rainfall'
  },
  subtitle: {
    text: 'Source: WorldClimate.com'
  },
  xAxis: {
    categories: [
      'Jan',
      'Feb',
      'Mar',
      'Apr',
      'May',
      'Jun',
      'Jul',
      'Aug',
      'Sep',
      'Oct',
      'Nov',
      'Dec'
    ],
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Rainfall (mm)'
    }
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0
    }
  },
  series: [{
    name: 'Tokyo',
    data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

  }, {
    name: 'New York',
    data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

  }, {
    name: 'London',
    data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

  }, {
    name: 'Berlin',
    data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

  }]
});
            </script>

            <script>
            // Build the chart
Highcharts.chart('container1', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Browser market shares in January, 2018'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: false
      },
      showInLegend: true
    }
  },
  series: [{
    name: 'Brands',
    colorByPoint: true,
    data: [{
      name: 'Chrome',
      y: 61.41,
      sliced: true,
      selected: true
    }, {
      name: 'Internet Explorer',
      y: 11.84
    }, {
      name: 'Firefox',
      y: 10.85
    }, {
      name: 'Edge',
      y: 4.67
    }, {
      name: 'Safari',
      y: 4.18
    }, {
      name: 'Other',
      y: 7.05
    }]
  }]
});
            </script>
            @endsection