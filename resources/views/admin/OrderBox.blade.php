
@extends('Layouts.app')

@section('content')
<div class="page-header" >

    <div class="page-header-content">
        <div class="page-title" style="margin-top:-10px;margin-bottom:-10px">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Orders</span> - View Box Orders</h4>
        </div>
    </div>

    <div class="breadcrumb-line" >
        <ul class="breadcrumb">
            <li><a href="/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/view_user">Orders</a></li>
            <li class="active">View box orders</li>
        </ul>
    </div>
</div>




<div class="content  animated fadeInRight">
<div class="panel panel-flat" style="background-color:#e0e0e0" >
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


            @if(Session::has('msg'))
            {!! Session::get('msg') !!}
            @endif


            <div class="table-responsive">
            <table class="table table-striped table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>Order id</th>
                                    <th>Total</th>
                                    <th>Customer</th>
                                    <th>Mobile No</th>
                                    <th>Date</th>
                                      <th>Category</th>
                                    <th>Payment type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $path = 'images/food/';?>


                                @foreach($order_bxes as $order_bxe)
                                <tr>
                                    <td>{{$order_bxe->orderid}}</td>
                                    <td>{{$order_bxe->total}}</td>
                                    <td>{{$order_bxe->name}}</td>
                                    <td>{{$order_bxe->mobile_no}}</td>
                                    <td>{{$order_bxe->created_at}}</td>
                                     @if($order_bxe->category==1)
                                        <td>Residential Boxes</td>
                                    @elseif($order_bxe->category==2)
                                        <td>Commercial Boxes</td>
                                    @elseif($order_bxe->category==3)
                                        <td>Home Appliance Boxes</td>
                                    @endif
                                    
                                    @if($order_bxe->payment_method=="Cash")
                                        <td><span class="badge badge-danger">{{$order_bxe->payment_method}}</span></td>
                                      @elseif($order_bxe->payment_method=="Card")
                                        <td><span class="badge badge-primary">{{$order_bxe->payment_method}}</span></td>
                                    @endif
                                    <!--<td>{{$order_bxe->status}}</td>-->
                                    @if($order_bxe->status==0)
                                    <td><span class="badge badge-danger">Order Cancelled</span> </td>

                                    @elseif($order_bxe->status==1)
                                    <td><span class="badge badge-warning">Pending Order</span> </td>
                                    @elseif($order_bxe->status==2)
                                    <td><span class="badge badge-info">Order Placed</span> </td>

                                    @elseif($order_bxe->status==3)
                                    <td><span class="badge badge-success">Free coffee Given</span> </td>

                                    @endif
                                    <td>
                                        <a href="{{url('admin/viewBoxItems/'.$order_bxe->id)}}" class="btn btn-primary"><i
                                                class="fa fa-pencil"></i><a>

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th>Order id</th>
                                    <th>Total</th>
                                    <th>Customer</th>
                                    <th>Mobile No</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </tfoot> -->
                        </table>
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