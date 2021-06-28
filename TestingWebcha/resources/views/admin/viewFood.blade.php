@extends('admin.layouts.home')

@section('content')
<link href="{{asset('/')}}css/add-coffee.css" rel="stylesheet">
<style>
#productcoffee {
    border-color: #fff;
}
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>View Food Orders</h5>
                </div>

                @if (session('alert'))
                @foreach($orders as $order)
                <div id="fcoffee" onclick="freeCoffee({{$order->id}})">abc </div>
                @endforeach
                <script type="text/javascript">
                function freeCoffee(id) {
                    bootbox.confirm({
                        title: "Free Coffee",
                        message: "Are you sure you want to give free coffee?",
                        buttons: {
                            confirm: {
                                label: 'Yes',
                                className: 'btn-success'
                            },
                            cancel: {
                                label: 'No',
                                className: 'btn-danger'
                            }
                        },
                        callback: function(result) {
                            if (result) {
                                window.location.href = '{{url("admin/acceptfreecoffee")}}' + '/' +
                                    id;
                            } else {
                                window.location.href = '{{url("admin/denyfreecofee")}}' + '/' + id;
                            }
                        }
                    });
                }
                var elem = document.getElementById("fcoffee");
                if (typeof elem.onclick == "function") {
                    elem.onclick.apply(elem);
                }
                </script>
                @endif

                <div class="ibox-content">
                    <!-- <form id="addcoffee" method="post" enctype="multipart/form-data" action="{{url('admin/food')}}"> -->
                    {{ csrf_field() }}
                    <div class="row">
                        @foreach($orders as $order)

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12"><b>Order No: {{$order->orderid}}</b></div>
                                <div class="col-md-12" style="margin-top:2%"><b>Customer: {{$order->users->name}}</b>
                                </div>
                                <div class="col-md-12" style="margin-top:2%">
                                    <b>
                                        Order Status:
                                        @if($order->status==0)
                                        Order Cancelled
                                        @elseif($order->status==1)
                                        Pending Order
                                        @elseif($order->status==2)
                                        Order Placed
                                        @elseif($order->status==3)
                                        Free coffee Given
                                        @endif
                                    </b>
                                </div>
                            </div>
                        </div>
                        @endforeach


                        <table class="table table-striped table-bordered table-hover dataTables-example"
                            style="margin-top:2%">
                            <thead>
                                <tr>
                                    <th>Food</th>
                                    <th>qty</th>
                                    <th>price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $path='images/food/'; ?>
                                @foreach($orders as $order)


                                @foreach($order->orderfoods as $orderfoods)
                                <tr>
                                    <td>{{$orderfoods->foods->name}}</td>
                                    <td>{{$orderfoods->qty}}</td>
                                    <td>{{money_formate($orderfoods->price)}}</td>
                                </tr>
                                @endforeach


                                @endforeach
                            </tbody>
                        </table>
                        @foreach($orders as $order)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3" style="float:left"><b>Total: {{money_formate($order->total)}}</b>
                                </div>
                            </div>
                        </div>
                        @if($order->status==1)
                        <form method="GET" action="{{url('admin/purchasefood/'.$order->id)}}">
                            <div class="row" style="margin-top:2%">
                                <div class="col-md-12">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-3" style="float:left"><button class="btn-danger"
                                            style="margin-left:10%" type="submit">Purchase</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        @endif
                        @endforeach

                        <!-- <div class="">
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <button class="btn btn-sm btn-primary" type="submit">Save</button>
                                    </div>
                                </div>

                            </div> -->

                    </div>
                </div>

                <!-- </form> -->
            </div>

        </div>


    </div>
</div>
</div>





@endsection