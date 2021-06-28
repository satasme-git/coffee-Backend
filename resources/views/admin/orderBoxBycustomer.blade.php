@extends('admin.layouts.home')

@section('content')
<link href="{{url('/')}}/css/plugins/dataTables/datatables.css">

<div class="wrapper wrapper-content animated fadeInRight">
<section class="content-header">
<div class="col-md-3">
        <h2 style="font-weight:bold;margin-top:-5px;margin-left:-15px">
            Orders
            <small> box orders</small>
        </h2>
        </div>
        <div class="col-md-2 pull-right">
        <ol class="breadcrumb" style="background-color:rgb(243,243,244);float:right;">
            <li><a href="#"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
        </div>
    </section>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                  

                <div class="ibox-content">
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
                                    <!-- <td>{{$order_bxe->status}}</td> -->

                                    
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
                            
                        </table>
                      

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- <script src="{{url('/')}}/js/plugins/dataTables/datatables.min.js"></script> -->
<script src="{{url('/')}}/js/plugins/bootbox/bootbox.min.js"></script>
<script>
$(document).ready(function() {
    $('.dataTables-example').DataTable({
        "order": [[ 4, "desc" ]]
    });

});

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
        callback: function(result) {
            if (result) {
                window.location.href = '{{url("admin/deletefood")}}' + '/' + id;
            }
        }
    });
}
</script>
@endsection