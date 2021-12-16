@extends('Layouts.app')
@section('content')
<div class="page-header" >

    <div class="page-header-content">
        <div class="page-title" style="margin-top:-10px;margin-bottom:-10px">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User</span> - View users</h4>
        </div>
    </div>

    <div class="breadcrumb-line" >
        <ul class="breadcrumb">
            <li><a href="/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/view_user">User</a></li>
            <li class="active">View users</li>
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
                <table class="table table-striped  table-hover dataTables-example" >
                    <thead>
                        <tr>

                            <th>id</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Nic number</th>
                            <th>Date of birth</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->suser_fname}}</td>
                            <td>{{$user->suser_flname}}</td>
                            <td>{{$user->suser_nic}}</td>
                            <td>{{$user->suser_dob}}</td>
                            <td>{{$user->role_name}}</td>

                            <td>
                                <a href="{{url('admin/update/'.$user->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i><a>
                                        <button onclick="deleteconfirm({{$user->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
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
                                                                                            title: "delete user",
                                                                                                    message: "Are you sure you want to delete this user?",
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
                                                                                                    window.location.href = '{{url("admin/deleteuser")}}' + '/' + id;
                                                                                                    }
                                                                                                    }
                                                                                            });
                                                                                            }
                                        </script>
                                        @endsection
