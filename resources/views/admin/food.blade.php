
@extends('Layouts.app')
@section('content')
<div class="page-header" >

    <div class="page-header-content">
        <div class="page-title" style="margin-top:-10px;margin-bottom:-10px">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Customer</span> - View customers</h4>
        </div>
    </div>

    <div class="breadcrumb-line" >
        <ul class="breadcrumb">
            <li><a href="/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/view_user">Customer</a></li>
            <li class="active">View customers</li>
        </ul>
    </div>
</div>

<div class="content  animated fadeInRight">

    <div class="panel panel-flat">
        <div class="panel-body">
            <!--<div class="ibox float-e-margins" >-->
<!--                <div class="ibox-title"style="margin-bottom:10px" >
                    <a style="padding:10px" href="{{url('admin/addfood/0')}}" class="btn btn-primary btn-sm pull-right">Add new</a>
                </div>-->

                <!--<div class="ibox-content">-->
                    @if(Session::has('msg'))
                    {!! Session::get('msg') !!} 
                    @endif


                    <div class="table-responsive">
                        <table class="table table-striped  table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>                       
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th style="width:120px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $path = 'images/food/'; ?>
                                @foreach($food as $foods)
                                <tr>

                                    <td>@if(file_exists(public_path($path.$foods->img)))
                                        <img src="{{asset($path.$foods->img)}}" style="width:52px;height:52px;">
                                        @endif</td>
                                    <td>{{$foods->name}}</td>
                                    <td>{{$foods->subcategory}}</td>
                                    <td>{{money_formate($foods->price)}}</td>
                                    <td>{{$foods->description}}</td>
                                    <td>
                                        <a href="{{url('admin/addfood/'.$foods->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i><a>
                                                <button onclick="deleteconfirm({{$foods->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                                </td>

                                                </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Category</th>                       
                                                        <th>Price</th>
                                                        <th>Description</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </tfoot>
                                                </table>
                                                </div>

                                                </div>
                                                </div>
                                                </div>
<!--                                                </div>
                                                </div>-->
                                                <script src="{{url('/')}}/js/plugins/dataTables/datatables.min.js"></script>
                                                <script src="{{url('/')}}/js/plugins/bootbox/bootbox.min.js"></script>
                                                <script>
                                                                                                    $(document).ready(function(){
                                                                                                    $('.dataTables-example').DataTable({


                                                                                                    });
                                                                                                    });
                                                                                                    function deleteconfirm(id){
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
                                                                                                            if (result){
                                                                                                            window.location.href = '{{url("admin/deletefood")}}' + '/' + id;
                                                                                                            }
                                                                                                            }
                                                                                                    });
                                                                                                    }

                                                </script>
                                                @endsection 