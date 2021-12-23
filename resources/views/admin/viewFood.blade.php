
@extends('Layouts.app')

@section('content')
<div class="page-header" >

    <div class="page-header-content">
        <div class="page-title" style="margin-top:-10px;margin-bottom:-10px">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Orders</span> - View order details</h4>
        </div>
    </div>

    <div class="breadcrumb-line" >
        <ul class="breadcrumb">
            <li><a href="/admin/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/orders">Orders</a></li>
            <li class="active">View order details</li>
        </ul>
    </div>
</div>
<div class="content  animated fadeInRight">
    <div class="panel panel-flat">
        <div class="panel-body">

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
                            <div class="col-md-12" style="margin-top:2%"><b>Customer: {{$order->name}}</b>
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




                    <table class="table table-striped  table-hover dataTables-example"
                           style="margin-top:2%">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Food</th>
                                <th>Quantity</th>
                                <th>Size</th>
                                <th>Topins</th>
                                <th>price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $path = '/images/food/'; ?>
                            <?php $path2 = '/images/Box/'; ?>

 
                            <!-- subcategory_id -->

                            @foreach($items as $item)
                            <tr>

                                <td>
                                    @if($item->subcategory_id==9)
                                    <img src="{{asset($path2.$item->img)}}" style="width:52px;height:52px;">
                                    @else
                                    <img src="{{asset($path.$item->img)}}" style="width:52px;height:52px;">
                                    @endif
                                   
                                </td>


                                <td>{{$item->name}}</td>
                                <td>{{$item->qty}}</td>
                                <td>{{$item->pSize}}</td>
                                <td>
                                    @if($item->pFcream!="0")
                                    {{$item->pFcream}} ,

                                    @endif
                                    @if($item->pSkim!="0")
                                    {{$item->pSkim}} ,

                                    @endif
                                    @if($item->pSoy!="0")
                                    {{$item->pSoy}} ,

                                    @endif
                                    @if($item->pAlmond!="0")
                                    {{$item->pAlmond}} ,

                                    @endif
                                    @if($item->pOat!="0")
                                    {{$item->pOat}}

                                    @endif

                                </td>
                                <td>{{money_formate($item->price)}}</td>
                            </tr>
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

                </div>
            </div>

            <!-- </form> -->
        </div>

    </div>


</div>







@endsection