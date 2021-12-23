@extends('Layouts.app')
@section('content')
	<!-- <script type="text/javascript" src="{{ asset('LTR/assets/js/core/app.js')}}"></script> -->
	<script type="text/javascript" src="{{ asset('LTR/assets/js/pages/dashboard.js')}}"></script>
<!-- Content area -->
<div class="content">

<!-- Main charts -->
<div class="row">
    <div class="col-lg-7">

        <!-- Traffic sources -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Traffic sources</h6>
                <div class="heading-elements">
                    <form class="heading-form" action="#">
                        <div class="form-group">
                            <label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
                                <input type="checkbox" class="switch" checked="checked">
                                Live update:
                            </label>
                        </div>
                    </form>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-plus3"></i></a>
                            </li>
                            <li class="text-left">
                                <div class="text-semibold">Card Orders</div>
                              <div class="text-muted"><span id="card_orders">0</span></div>
                            </li>
                        </ul>

                        <div class="col-lg-10 col-lg-offset-1">
                            <div class="content-group" id="new-visitors"></div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-watch2"></i></a>
                            </li>
                            <li class="text-left">
                                <div class="text-semibold">Cash orders</div>
                               <div class="text-muted"><span id="cash_orders">0</span></div>
                            </li>
                        </ul>

                        <div class="col-lg-10 col-lg-offset-1">
                            <div class="content-group" id="new-sessions"></div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-people"></i></a>
                            </li>
                            <li class="text-left">
                                <div class="text-semibold">Total customers</div>
                                <div class="text-muted"><span class="status-mark border-success position-left"></span> <span id="active_customers">0</span></div>
                            </li>
                        </ul>

                        <div class="col-lg-10 col-lg-offset-1">
                            <div class="content-group" id="total-online"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="position-relative" style="padding-right:5px">

<figure class="highcharts-figure">
    <div id="container"></div>

</figure>
</div>


        </div>
        <!-- /traffic sources -->

    </div>

    <div class="col-lg-5">

        <!-- Sales stats -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Sales statistics</h6>
                <div class="heading-elements">
                    <!--<form class="heading-form" action="#">-->
                    <!--    <div class="form-group">-->
                    <!--        <select class="change-date select-sm" id="select_date">-->
                    <!--            <optgroup label="<i class='icon-watch pull-right'></i> Time period">-->
                    <!--                <option value="val1">June, 29 - July, 5</option>-->
                    <!--                <option value="val2">June, 22 - June 28</option>-->
                    <!--                <option value="val3" selected="selected">June, 15 - June, 21</option>-->
                    <!--                <option value="val4">June, 8 - June, 14</option>-->
                    <!--            </optgroup>-->
                    <!--        </select>-->
                    <!--    </div>-->
                    <!--</form>-->
                </div>
            </div>

            <div class="container-fluid">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="content-group">
                            <h5  class="text-semibold no-margin"><i class="icon-calendar5 position-left text-slate"></i><span id="order_total">$0.00</span></h5>
                            <span class="text-muted text-size-small">today orders total</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-group">
                            <h5 class="text-semibold no-margin"><i class="icon-calendar52 position-left text-slate"></i><span id="orders_count">0</span></h5>
                            <span class="text-muted text-size-small">today orders count</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-group">
                            <h5 class="text-semibold no-margin"><i class="icon-cash3 position-left text-slate"></i> <span id="order_revenue">$0</span></h5>
                            <span class="text-muted text-size-small">monthly revenue</span>
                        </div>
                    </div>
                </div>
            </div>

     
        
 
            
<div class="panel-heading">
                <h6 class="panel-title">Latest Daily sales stats</h6>
                <div class="heading-elements">
                    <!-- <span class="heading-text">Balance: <span class="text-bold text-danger-600 position-right">$4,378</span></span> -->
                   
                     
                </div>
            </div>
            <div class="table-responsive">
            
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Time</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>
                                <div class="media-left media-middle">
                                    @if( $order->status==1)
                                    <a href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
                                        <span class="letter-icon">P</span>
                                    </a>
                                    @elseif($order->status==2)
                                    <a href="#" class="btn bg-danger-400 btn-rounded btn-icon btn-xs">
                                        <span class="letter-icon">O</span>
                                    </a>
                                    @elseif($order->status==10)
                                    <a href="#" class="btn bg-warning-400 btn-rounded btn-icon btn-xs">
                                        <span class="letter-icon">H</span>
                                    </a>
                                    @endif
                                </div>

                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="#" class="letter-icon-title">{{ $order->orderid}}</a>
                                    </div>

                                    <div class="text-muted text-size-small">
                                    @if( $order->status==1)
                                        <i class="icon-checkmark3 text-size-mini position-left"></i> Pending order
                                 @elseif($order->status==2)
                                 <i class="icon-spinner11 text-size-mini position-left"></i> Order placed

                                 @elseif($order->status==10)
                                 <i class="icon-lifebuoy  text-size-mini position-left"></i> Hold Order
                                 @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted text-size-small">{{ $order->created_at}}</span>
                            </td>
                            <td>
                                <h6 class="text-semibold no-margin">${{ $order->total}}</h6>
                            </td>
                        </tr>

                        

                      
                        @endforeach
                    </tbody>
                </table>
            </div>
   
         <!-- /daily sales -->
        </div>
        <!-- /sales stats -->

    </div>
</div>
<!-- /main charts -->


<!-- Dashboard content -->
<div class="row">

    <div class="col-lg-4">

    

         <!-- Daily sales  -->
        


    </div>
</div>
<!-- /dashboard content -->




</div>
<!-- /content area -->
<script>
    $.ajax({
    url: "{{url('/admin/monthlyCollection')}}", //this is your uri
    type: 'get', //this is your method
    success: function (data) {

       var loanWithInt = [];
        var payAmount = [];
        var month = [];
        for (var i = 0; i < data.length; i++) {

            loanWithInt.push(parseFloat(data[i].sums));
        
            month.push(data[i].months);

        }

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Monthly Average'
            },

            xAxis: {
                categories: month,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: '$'
                }
            },
          
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                {
                    name: 'Order Total Amount',
                    data: loanWithInt

                }
                
            ]
        });

    }

});
$.ajax({
    url: "{{url('/admin/todayOrders')}}", //this is your uri
    type: 'get', //this is your method
    success: function (data) {
        var dailyCollection=0;
        for (var i = 0; i < data.length; i++) {
            dailyCollection=parseFloat(data[i].order_total);
        }
       console.log(dailyCollection);
        if(isNaN(dailyCollection)){
            document.getElementById('order_total').innerHTML = "$ "+0;
           
        }else{
            document.getElementById('order_total').innerHTML = "$ "+dailyCollection.toFixed(2);
           
        }
       
    }
});


$.ajax({
    url: "{{url('/admin/todayOrdersCount')}}", //this is your uri
    type: 'get', //this is your method
    success: function (data) {
        var ordecount=0;
        for (var i = 0; i < data.length; i++) {
            ordercount=parseFloat(data[i].orders_count);
        }
       console.log(ordercount);
        if(isNaN(ordercount)){
            document.getElementById('orders_count').innerHTML = ""+0;
           
        }else{
            document.getElementById('orders_count').innerHTML = ""+ordercount;
           
        }
       
    }
});

$.ajax({
    url: "{{url('/admin/monthlyrevenue')}}", //this is your uri
    type: 'get', //this is your method
    success: function (data) {
        var ordecount=0;
        for (var i = 0; i < data.length; i++) {
            ordercount=parseFloat(data[i].order_revenue);
        }
       console.log(ordercount);
        if(isNaN(ordercount)){
            document.getElementById('order_revenue').innerHTML = "$"+0;
           
        }else{
            document.getElementById('order_revenue').innerHTML = "$"+ordercount.toFixed(2);
           
        }
       
    }
});
$.ajax({
    url: "{{url('/admin/total_customers')}}", //this is your uri
    type: 'get', //this is your method
    success: function (data) {
        var ordecount=0;
        for (var i = 0; i < data.length; i++) {
            activecus=parseFloat(data[i].active_customers);
        }
       console.log(activecus);
        if(isNaN(activecus)){
            document.getElementById('active_customers').innerHTML = ""+0;
           
        }else{
            document.getElementById('active_customers').innerHTML = ""+activecus;
           
        }
       
    }
});
$.ajax({
    url: "{{url('/admin/card_orders')}}", //this is your uri
    type: 'get', //this is your method
    success: function (data) {
        var card_orders=0;
        for (var i = 0; i < data.length; i++) {
            card_orders=parseFloat(data[i].card_orders);
        }
       console.log(card_orders);
        if(isNaN(card_orders)){
            document.getElementById('card_orders').innerHTML = ""+0;
           
        }else{
            document.getElementById('card_orders').innerHTML = ""+card_orders;
           
        }
       
    }
});
$.ajax({
    url: "{{url('/admin/cash_orders')}}", //this is your uri
    type: 'get', //this is your method
    success: function (data) {
        var cash_orders=0;
        for (var i = 0; i < data.length; i++) {
            cash_orders=parseFloat(data[i].cash_orders);
        }
       console.log(cash_orders);
        if(isNaN(cash_orders)){
            document.getElementById('cash_orders').innerHTML = ""+0;
           
        }else{
            document.getElementById('cash_orders').innerHTML = ""+cash_orders;
           
        }
       
    }
});
</script>
@endsection