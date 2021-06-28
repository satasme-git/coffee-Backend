@extends('admin.layouts.app2')

@section('content')
<link href="{{ asset('css/plugins/dataTables/datatables.css')}}">
<link href="{{URL::asset('')}}css/admin/animate.css" rel="stylesheet">
<section class="content-header">
    <h1>
        Box
        <small>add/edit box</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/admin/viewBoxes')}}">box</a></li>
        <li class="active">add/edit box</li>
    </ol>
</section>

<section class="content  animated fadeInRight">
<form action="{{url('admin/user')}}" method="POST" >
        {{ csrf_field() }}
        <div class="row">


            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Basic details</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group"  {{ $errors->has('user_fname') ? ' has-error' : '' }}>
                            <label for="pwd">First Name:</label>
                            <input type="text" class="form-control" placeholder="Enter first name" name="user_fname" id="user_fname"
                                   @if($errors->any())
                                   value="{{old('user_fname')}}""
                                   @elseif(!empty($records->user_fname))
                                   value="{{$records->user_fname}}"
                                   @endif />
                                   @if ($errors->has('user_fname'))
                                   <span class="help-block">
                                <strong style="color: #ff0000">{{ $errors->first('user_fname') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group" {{ $errors->has('user_lname') ? ' has-error' : '' }}>
                            <label for="pwd">Last Name:</label>
                            <input type="text" class="form-control" placeholder="Enter last name" name="user_lname" id="user_lname"
                                   @if($errors->any())
                                   value="{{old('user_lname')}}""
                                   @elseif(!empty($records->user_lname))
                                   value="{{$records->user_lname}}"
                                   @endif />
                                   @if ($errors->has('user_lname'))
                                   <span class="help-block">
                                <strong style="color: #ff0000">{{ $errors->first('user_lname') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group" {{ $errors->has('user_nic') ? ' has-error' : '' }}>
                            <label for="pwd"> NIC number:</label>
                            <input type="text" class="form-control" placeholder="Enter nic number" name="user_nic" id="user_nic"
                                   @if($errors->any())
                                   value="{{old('user_nic')}}""
                                   @elseif(!empty($records->user_nic))
                                   value="{{$records->user_nic}}"
                                   @endif />
                                   @if ($errors->has('user_nic'))
                                   <span class="help-block">
                                <strong style="color: #ff0000">{{ $errors->first('user_nic') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group" {{ $errors->has('user_dob') ? ' has-error' : '' }}>
                            <label for="pwd">Date OF Birth:</label>
                            <input type="date" class="form-control" placeholder="Enter date of birth" name="user_dob" id="user_dob"
                                   @if($errors->any())
                                   value="{{old('user_dob')}}""
                                   @elseif(!empty($records->user_dob))
                                   value="{{$records->user_dob}}"
                                   @endif />
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

                            <input type="text" class="form-control" placeholder="Enter username" name="username" id="username"
                                   @if($errors->any())
                                   value="{{old('username')}}""
                                   @elseif(!empty($records->username))
                                   value="{{$records->username}}"
                                   @endif />
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
                                @foreach($users as $user)
                                <option @if( $user->role_name=="Super Admin") disabled  @endif value="{{$user->id}}">{{$user->role_name}} </option>
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

        @if(!empty($records->id))
        <button type="submit" class="btn btn-warning">Update Box</button>
        @else
        <button type="submit" class="btn btn-success">Add Box</button>
        @endif

        <button type="reset" name="reset" class="btn btn-danger">
            <i class="glyphicon glyphicon-trash"></i>
            Clear</button>
        @if(!empty($records->id))
        <input type="hidden" name="id" value="{{$records->id}}">
        @endif
    </form>

</section>


@endsection