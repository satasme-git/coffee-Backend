@extends('admin.layouts.app2')

@section('content')
<link href="{{ asset('css/plugins/dataTables/datatables.css')}}">
<link href="{{URL::asset('')}}css/admin/animate.css" rel="stylesheet">
<section class="content-header">
    <h1>
        Orders
        <small>View orders</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('admin/addboxes/0')}}">add box</a></li>
        <li class="active">View boxes</li>
    </ol>
</section>
<section class="content  animated fadeInRight">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">

                <div class="box-body">


                    <form  method="post"  action="{{url('admin/search_order_by_mobilenumber')}}">
                        {{ csrf_field() }}
                        <div  class="col-lg-3" style="margin-left:-10px;";>
                            <input id="myinputbox" type="text"  autocomplete="off" name="id" id="id"  class="form-control"/>
                        </div>
                        <div  class="col-lg-6" style="margin-top:8px">Scan QR code here (enter customer mobile number)</div>
                    </form>

                </div>
            </div>

        </div>
        <div class="col-md-12">

            <!-- <div class="ibox-title"style="margin-bottom:10px;background-color:#b0bec5;padding-top:15px;padding-bottom:15px;height:65px;padding-left:10px" > -->

            <!-- </div> -->
            <div class="box box-primary">

                <div style="padding:5px">
                    @if(Session::has('msg'))
                    {!! Session::get('msg') !!} 
                    @endif


                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>Order id</th>
                                    <th>Total</th>
                                    <th>Customer</th>
                                    <th>Mobile No</th>
                                    <th>Date</th>
                                    <th>Payment Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $path = 'images/food/'; ?>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->orderid}}</td>
                                    <td>{{money_formate($order->total)}}</td>
                                    <td>{{$order->name}}</td>

                                    <td>{{$order->mobile_no}}</td>
                                    <td>{{$order->created_at}}</td>
                                    @if($order->payment_method=="Cash")
                                    <td><span class="badge badge-danger" style="background-color:#ff8a65">{{$order->payment_method}}</span></td>
                                    @elseif($order->payment_method=="Card")
                                    <td><span class="badge badge-primary" style="background-color:#29b6f6">{{$order->payment_method}}</span></td>
                                    @endif
                                    @if($order->status==0)
                                    <td><span class="badge badge-success" style="background-color:#26a69a">Order Cancelled</span> </td>

                                    @elseif($order->status==1)
                                    <td><span class="badge badge-warning" style="background-color:#fb8c00">Pending Order</span> </td>
                                    @elseif($order->status==2)
                                    <td><span class="badge badge-danger" style="background-color:#ff8a65">Order Placed</span> </td>
                                    #7b1fa2
                                    @elseif($order->status==3)
                                    <td><span class="badge badge-info" style="background-color:#7b1fa2">Free coffee Given</span> </td>

                                    @endif
                                    <td>
                                        <a href="{{url('admin/viewfoods/'.$order->id)}}" class="btn btn-default"><i
                                                class="fa fa-file"></i></a>
                                        <button onclick="deleteconfirm()" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>

            </div><!-- /.card-body -->
        </div>
    </div>
</section>
<script src="{{ asset('AdminLTE2/bower_components//jquery/dist/jquery.min.js')}}"></script>

<!-- <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>   -->
<script>
                                            $(document).ready(function () {
                                                $('.dataTables-example').DataTable({
                                                    "order": [[4, "desc"]]
                                                });

                                            });
                                            window.onload = function () {
                                                var input = document.getElementById("myinputbox").focus();
                                            }

                                            function deleteconfirm(id) {
                                                bootbox.confirm({
                                                    title: "Delete Record",
                                                    message: "Are you sure you want to delete?",
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
                                                    callback: function (result) {
                                                        if (result) {
                                                            window.location.href = '{{url("admin/deletefood")}}' + '/' + id;
                                                        }
                                                    }
                                                });
                                            }
</script>

@endsection
