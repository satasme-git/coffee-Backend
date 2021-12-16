@extends('Layouts.app')

@section('content')
<link href="{{asset('/')}}css/add-coffee.css" rel="stylesheet">
<div class="page-header" >

    <div class="page-header-content">
        <div class="page-title" style="margin-top:-10px;margin-bottom:-10px">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User</span> - update user</h4>
        </div>
    </div>

    <div class="breadcrumb-line" >
        <ul class="breadcrumb">
            <li><a href="/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/view_user">User</a></li>
            <li class="active">Update user</li>
        </ul>
    </div>
</div>
<div class="content  animated fadeInRight">
    <form action="{{url('admin/user')}}" method="POST" >

        <div class="panel panel-flat">
            <div class="panel-body">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                        @if(Session::has('msg'))
                        {!! Session::get('msg') !!}
                        @endif
                    </div>


                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-copy position-left"></i> Basics details</legend>

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

                        </fieldset>
                    </div>


                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-copy position-left"></i> Other details</legend>

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

                        </fieldset>
                    </div>

                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-warning" value="Submit"/>
        <button type="reset" class="btn btn-danger">Reset</button>

    </form>
</div>
@endsection
