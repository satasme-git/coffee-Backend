@extends('admin.layouts.home')

@section('content')
<link href="{{url('/')}}/css/plugins/dataTables/datatables.css">

<div class="wrapper wrapper-content animated fadeInRight">
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
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $path='images/food/'; ?>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->orderid}}</td>
                                    <td>{{money_formate($order->total)}}</td>
                                    <td>{{$order->users->name}}</td>
                                    <td>{{$order->users->mobile_no}}</td>
                                    <td>{{$order->created_at}}</td>
                                    @if($order->status==0)
                                    <td>Order Cancelled</td>
                                    @elseif($order->status==1)
                                    <td>Pending Order</td>
                                    @elseif($order->status==2)
                                    <td>Order Placed</td>
                                    @elseif($order->status==3)
                                    <td>Free coffee Given</td>
                                    @endif
                                    <td>
                                        <a href="{{url('admin/viewfoods/'.$order->id)}}" class="btn btn-primary"><i
                                                class="fa fa-pencil"></i><a>
                                                
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Order id</th>
                                    <th>Total</th>
                                    <th>Customer</th>
                                    <th>Mobile No</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{url('/')}}/js/plugins/dataTables/datatables.min.js"></script>
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