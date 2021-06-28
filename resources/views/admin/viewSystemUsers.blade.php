@extends('admin.layouts.app2')

@section('content')
<link href="{{ asset('css/plugins/dataTables/datatables.css')}}">
<link href="{{URL::asset('')}}css/admin/animate.css" rel="stylesheet">
<section class="content-header">
    <h1>
        User
        <small>View Users</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('admin/user')}}">add user</a></li>
        <li class="active">View users</li>
    </ol>
</section>
<section class="content animated fadeInRight">

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
                                        <a href="{{url('admin/update/'.$user->id)}}" class="btn btn-warning">   <i class="glyphicon glyphicon-edit"></i></a>
                                        <button onclick="deleteconfirm({{$user->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>

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
                                            $('.alert-msg').fadeIn().delay(1000).fadeOut();
                                            });</script>

<script src="{{ asset('js/jquery.1.12.4.min.js')}}"></script>

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
