@extends('admin.layouts.app2')

@section('content')
<link href="{{ asset('css/plugins/dataTables/datatables.css')}}">
<link href="{{URL::asset('')}}css/admin/animate.css" rel="stylesheet">
<section class="content-header">
    <h1>
        Food
        <small>View Foods</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('admin/addfood/0')}}">add food</a></li>
        <li class="active">View foods</li>
    </ol>
</section>
<section class="content  animated fadeInRight">

    <div class="row">

        <div class="col-md-12">
            <div class="box box-primary">

                <div style="padding:5px">
                    @if(Session::has('msg'))
                    {!! Session::get('msg') !!} 
                    @endif


                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
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
                                        <img src="{{asset($path.$foods->img)}}" style="width:62px;">
                                        @endif</td>
                                    <td>{{$foods->name}}</td>
                                    <td>{{$foods->subcategory}}</td>
                                    <td>{{money_formate($foods->price)}}</td>
                                    <td>{{$foods->description}}</td>
                                    <td>
                                        <a href="{{url('admin/addfood/'.$foods->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
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

            </div><!-- /.card-body -->
        </div>
    </div>
</section>
<script src="{{ asset('AdminLTE2/bower_components//jquery/dist/jquery.min.js')}}"></script>

<!-- <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>   -->
<script>
                                            $(document).ready(function(){
                                            $('.alert').fadeIn().delay(1000).fadeOut();
                                            });
                                          
</script>

<script src="{{ asset('js/jquery.1.12.4.min.js')}}"></script>

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
