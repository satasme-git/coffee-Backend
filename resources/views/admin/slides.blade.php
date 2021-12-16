@extends('Layouts.app')
@section('content')
<div class="page-header" >

    <div class="page-header-content">
        <div class="page-title" style="margin-top:-10px;margin-bottom:-10px">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Slide</span> - View slides</h4>
        </div>
    </div>

    <div class="breadcrumb-line" >
        <ul class="breadcrumb">
            <li><a href="/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/view_user">Slide</a></li>
            <li class="active">View slides</li>
        </ul>
    </div>
</div>
<div class="content  animated fadeInRight">

    <div class="panel panel-flat">
        <div class="panel-body">	
            <div class="ibox-content" style="margin-top:1%">
                @if(Session::has('msg'))
                {!! Session::get('msg') !!} 
                @endif


                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTables-example" >
                        <thead>
                            <tr>
                                <th>Thumb</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $path = '/work/public/images/slides/'; ?>
                            @foreach($records as $row)
                            <tr>

                                <td style="width:155px">
                                    <img src="{{asset($path.$row->thumb)}}" style="width:150px;">
                                </td>
                                <td>
                                    {{$row->description}}
                                </td>
                                <td style="width:100px">
                                    <a href="{{url('admin/addslides/'.$row->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i><a>
                                            <button onclick="deleteconfirm({{$row->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Thumb</th>
                                                    <th>Description</th>
                                                    <th>Action</th>

                                                </tr>
                                            </tfoot>
                                            </table>
                                            </div>

                                            </div>
                                            </div>
                                            </div>
                                            </div>

     <!-- <script src="{{url('/')}}/js/plugins/dataTables/datatables.min.js"></script> -->
                                            <script src="{{url('/')}}/js/plugins/bootbox/bootbox.min.js"></script>
                                            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
                                            <script>
                                                                                                $(document).ready(function(){
                                                                                                $('.dataTables-example').DataTable();
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
                                                                                                        window.location.href = '{{url("admin/deleteslides")}}' + '/' + id;
                                                                                                        }
                                                                                                        }
                                                                                                });
                                                                                                }

                                            </script>
                                            @endsection 