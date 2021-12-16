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
	
            @if(Session::has('msg'))
            {!! Session::get('msg') !!} 
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Opening Duration 
                            <a style="/* padding: 10px; */height: 22px;display: flex;justify-content: center;align-items: center;font-size: 12px;" href="{{url('admin/editopentime')}}" class="btn btn-primary pull-right">
                                <i class="fa fa-pencil"></i> 
                                &nbsp; Edit
                            </a>
                        </div> 
                        <div class="panel-body">
                            <table class="table table-bordered" >
                                <thead>
                                    <tr>
                                        @foreach($days as $day)
                                        <th style="background-color:{{ $day->status == 1 ? '#2178E9' : 'white' }};color:{{ $day->status == 1 ? 'white' : 'gray' }}">{{$day->day}}</th>
                                        @endforeach
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php $path = 'images/food/'; ?>
                                    <tr>
                                        @foreach($days as $day)
                                        <td style="background-color:{{ $day->status == 1 ? '#2178E9' : 'white' }};color:{{ $day->status == 1 ? 'white' : '#e20d1b' }}">{!! $day->status == 0 ? '' : date('h:i A', strtotime($day->open)) !!}{{$day->status == 0 ?'' : ' -'}}  {!! $day->status == 0 ? 'Closed' : date('h:i A', strtotime($day->close)) !!}</td>
                                        @endforeach 
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Special Closing Dates
                            <a style="/* padding: 10px; */height: 22px;display: flex;justify-content: center;align-items: center;font-size: 12px;" href="{{url('admin/addclose/0')}}" class="btn btn-primary pull-right">
                              <!--<i class="fa fa-pencil"></i> -->
                                Add New
                            </a>
                        </div> 
                        <div class="panel-body">
                            <table class="table table-bordered" >
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Reason</th>
                                        <th>Open</th>
                                        <th>Close</th>
                                        <th>Full closed</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $path = 'images/food/'; ?>

                                    @foreach($close as $cl)
                                    <tr>
                                        <td>{{$cl->date}}</td>
                                        <td>{{$cl->reason}}</td>
                                        <td>{{$cl->open}}</td>
                                        <td>{{$cl->close}}</td>
                                        <td>{{$cl->full == 1?'Closed':''}}</td>
                                        <td>
                                            <a href="{{url('admin/addclose/'.$cl->id)}}" class="btn btn-primary"><i class="fa fa-pencil"></i><a>
                                                    <button onclick="deleteconfirm({{$cl->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
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
                                                        $(document).ready(function(){
                                                        $('.dataTables-example').DataTable({


                                                        });
                                                        });
                                                        function deleteconfirm(id){
                                                        bootbox.confirm({
                                                        title: "Delete",
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
                                                                window.location.href = '{{url("admin/deleteclose")}}' + '/' + id;
                                                                }
                                                                }
                                                        });
                                                        }

                                                    </script>
                                                    @endsection 