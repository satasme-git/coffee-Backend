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
                    <h5>View Box Orders</h5>
                </div>



                <div class="ibox-content">
                    <!-- <form id="addcoffee" method="post" enctype="multipart/form-data" action="{{url('admin/food')}}"> -->
                    {{ csrf_field() }}
                    <!--<div class="row">-->


                        @foreach($orders as $order)

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12"><b>Order No: {{$order->orderid  }}</b></div>
                                <div class="col-md-12" style="margin-top:2%"><b>Customer: {{$order->name}}</b>
                                    <!--<div class="col-md-12" style="margin-top:2%"><b>Customer: {{$order->status}}</b>-->
                                    <!--</div>-->

                                </div>
                            </div>
                            @endforeach


                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   style="margin-top:2%">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Box</th>
                                        <th>Quantity</th>

                                        <th>price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $path = '/images/Box/'; ?>



                                    @foreach($items as $item)
                                    <tr>

                                        <td>
                                            <img src="{{asset($path.$item->box_image)}}" style="width:52px;height:52px;">
                                        </td>

                                        <td>{{$item->box_title}}</td>
                                        <td>{{$item->bQty}}</td>

                                        <td>{{money_formate($item->bPrice)}}</td>
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
                            <form method="GET" action="{{url('admin/purchasebox/'.$order->id)}}">
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
                <!--</div>-->

            </div>


        </div>
    </div>

</div>




@endsection
