
@extends('Layouts.app')

@section('content')
<div class="page-header" >

    <div class="page-header-content" style="margin-top:-10px;margin-bottom:-10px">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Orders</span> - View food orders</h4>
        </div>

        <div class="heading-elements">

        </div>
    </div>

    <div class="breadcrumb-line" >
        <ul class="breadcrumb">
            <li><a href="/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/view_user">Orders</a></li>
            <li class="active">View food orders</li>
        </ul>

        <ul class="breadcrumb-elements">

        </ul>
    </div>
</div>




<div class="content  animated fadeInRight">
    <div class="panel panel-flat">
    <div class="panel-body">
        <form  method="post"  action="{{url('admin/search_order_by_mobilenumber')}}">
            {{ csrf_field() }}
            <div  class="col-lg-3" style="margin-left:-10px">
                <input id="myinputbox" type="text"  autocomplete="off" name="id" id="id"  class="form-control"/>
            </div>
            <div  class="col-lg-6" style="margin-top:8px">Scan QR code here (enter customer mobile number)</div>
        </form>
    </div>
</div>
    <div class="panel panel-flat">
        <div class="panel-body">

            <div class="ibox-content">
                @if(Session::has('msg'))
                {!! Session::get('msg') !!}
                @endif


                <div class="table-responsive">
                    <table class="table table-striped  table-hover dataTables-example">
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
                                <td><span class="badge badge-danger">{{$order->payment_method}}</span></td>
                                @elseif($order->payment_method=="Card")
                                <td><span class="badge badge-primary">{{$order->payment_method}}</span></td>
                                @endif
                                @if($order->status==0)
                                <td><span class="badge badge-success">Order Cancelled</span> </td>

                                @elseif($order->status==1)
                                <td><span class="badge badge-warning">Pending Order</span> </td>
                                @elseif($order->status==2)
                                <td><span class="badge badge-danger">Order Placed</span> </td>

                                @elseif($order->status==3)
                                <td><span class="badge badge-info">Free coffee Given</span> </td>

                                @endif
                                <td>
                                    <a href="{{url('admin/viewfoods/'.$order->id)}}" class="btn btn-primary"><i
                                            class="fa fa-pencil"></i><a>

                                            </td>

                                            </tr>
                                            @endforeach
                                            </tbody>

                                            </table>
                                            </div>

                                            </div>
                                            </div>
                                            </div>
                                            </div>

                                            <script src="{{url('/')}}/js/plugins/dataTables/datatables.min.js"></script>
                                            <script src="{{url('/')}}/js/plugins/bootbox/bootbox.min.js"></script>
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