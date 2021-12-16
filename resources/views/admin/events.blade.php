
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


            @if(Session::has('msg'))
            {!! Session::get('msg') !!} 
            @endif


            <div class="table-responsive">
                <table class="table table-striped table-hover dataTables-example" >
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>                       
                            <th>Date</th>                       
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $path = 'images/Events/'; ?>
                        @foreach($events as $event)
                        <tr>

                            <td>
                                <img src="{{asset($path.$event->event_image)}}" style="width:150px;">
                            </td>
                            <td>{{$event->title}}</td>
                            <td>{{$event->description}}</td>
                            <td>{{$event->created_at}}</td>
                            @if($event->status == '1')
                            <td> <span class="badge badge-info"> Active</span></td>

                            @else
                            <td></td>
                            @endif

                            <td style="width:100px">
                                <a href="{{url('admin/addevents/'.$event->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i><a>
                                        <button onclick="deleteconfirm({{$event->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                        </td>

                                        </tr>
                                        @endforeach

                                        </tbody>

                                        </table>
                                        </div>

                                        </div>
                                        </div>
                                        </div>

                                        <script src="{{url('/')}}/js/plugins/dataTables/datatables.min.js"></script>
                                        <script src="{{url('/')}}/js/plugins/bootbox/bootbox.min.js"></script>
                                        <script>
                                            $(document).ready(function(){
                                            $('.dataTables-example').DataTable({


                                            });
                                            });
                                            function deleteconfirm(id){
                                            bootbox.confirm({
                                            title: "Delete Event",
                                                    message: "Are you sure you want to delete this event?",
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
                                                    window.location.href = '{{url("admin/deleteevents")}}' + '/' + id;
                                                    }
                                                    }
                                            });
                                            }

                                        </script>
                                        @endsection 