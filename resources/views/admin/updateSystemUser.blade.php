@extends('admin.layouts.app2')

@section('content')
<link href="{{ asset('css/plugins/dataTables/datatables.css')}}">
<link href="{{URL::asset('')}}css/admin/animate.css" rel="stylesheet">
<section class="content-header">
    <h1>
        User
        <small>Update user</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/admin/view_system_users')}}">view users</a></li>
        <li class="active">edit user</li>
    </ol>
</section>

<section class="content  animated fadeInRight">
    <form action="{{url('admin/user')}}" method="POST" >
        {{csrf_field()}}
        <div class="row">
            @if(Session::has('msg'))
            {!! Session::get('msg') !!}
            @endif

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Basic details</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group"  {{ $errors->has('user_fname') ? ' has-error' : '' }}>
                            <label for="pwd">First Name:</label>
                            <input type="hidden" class="form-control" placeholder="Enter first name" value="{{$users->id}}" name="id" id="id">
                            <input type="text" class="form-control" placeholder="Enter first name" value="{{$users->suser_fname}}" name="user_fname" id="user_fname">
                            @if ($errors->has('user_fname'))
                            <span class="help-block">
                                <strong style="color: #ff0000">{{ $errors->first('user_fname') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group" {{ $errors->has('user_lname') ? ' has-error' : '' }}>
                            <label for="pwd">Last Name:</label>
                            <input type="text" class="form-control" placeholder="Enter last name"  value="{{$users->suser_flname}}" name="user_lname" id="user_lname">
                            @if ($errors->has('user_lname'))
                            <span class="help-block">
                                <strong style="color: #ff0000">{{ $errors->first('user_lname') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group" {{ $errors->has('user_nic') ? ' has-error' : '' }}>
                            <label for="pwd"> NIC number:</label>
                            <input type="text" class="form-control" placeholder="Enter nic number" value="{{$users->suser_nic}}" name="user_nic" id="user_nic">
                            @if ($errors->has('user_nic'))
                            <span class="help-block">
                                <strong style="color: #ff0000">{{ $errors->first('user_nic') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group" {{ $errors->has('user_dob') ? ' has-error' : '' }}>
                            <label for="pwd">Date OF Birth:</label>
                            <input type="date" class="form-control" placeholder="Enter date of birth" value="{{$users->suser_dob}}" name="user_dob" id="user_dob">
                        </div>
                        @if ($errors->has('user_dob'))
                        <span class="help-block">
                            <strong style="color: #ff0000">{{ $errors->first('user_dob') }}</strong>
                        </span>
                        @endif

                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Other details</h3>
                    </div>
                    <div class="box-body">


                        <div class="form-group" {{ $errors->has('username') ? ' has-error' : '' }}>
                            <label for="pwd">Email: </label>

                            <input type="text" class="form-control" placeholder="Enter username" value="{{$users->suser_username}}" name="username" id="username"


                                   />
                            @if ($errors->has('username'))
                            <span class="help-block">
                                <strong style="color: #ff0000">{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="form-group" {{ $errors->has('role_id') ? ' has-error' : '' }}>
                            <label for="text">User Role:</label>
                            <select class="form-control"  name="role_id" id="role_id">
                                <option value="">----Select Role-----</option>
                                @foreach($roles as $role)
                                <option @if( $role->role_name=="Super Admin") disabled  @endif  @if( $role->id==$users->role_id) selected  @endif value="{{$role->id}}">{{$role->role_name}} </option>
                                @endforeach

                            </select>
                            @if ($errors->has('role_id'))
                            <span class="help-block">
                                <strong style="color: #ff0000">{{ $errors->first('role_id') }}</strong>
                            </span>
                            @endif

                        </div>
                    </div>
                </div>

            </div>


        </div>

        <input type="submit" class="btn btn-warning" value="Submit"/>
        <button type="reset" class="btn btn-danger">Reset</button>

    </form>

</section>


@endsection