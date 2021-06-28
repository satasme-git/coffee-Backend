@extends('admin.layouts.home')

@section('content')
<link href="{{url('/')}}/css/plugins/dataTables/datatables.css">

 <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <a href="{{url('admin/addcustomers/0')}}" class="btn btn-primary pull-right">Add new</a>
                    </div>
					
                    <div class="ibox-content">
					@if(Session::has('msg'))
					{!! Session::get('msg') !!} 
					@endif
					
					
                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
						<th>Image</th>
                        <th>Name</th>
                        <th>E-Mail</th>                       
                        <th>Mobile Number</th>                       
                        <th>Status</th>
						<th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php $path='images/users/'; ?>
					@foreach($records as $users)
                    <tr>
                        
                        <td>
                        image here
                        </td>
                        <td>{{$users->name}}</td>
                        <td>{{$users->email}}</td>
                        <td>{{$users->mobile_no}}</td>
                        
                        @if($users->status == '0')
                            <td>Active</td>
                        @else
                            <td>Blacklisted</td>
                        @endif
                        
						<td>
							<a href="{{url('admin/addcustomers/'.$users->id)}}" class="btn btn-primary"><i class="fa fa-pencil"></i><a>
							<button onclick="deleteconfirm({{$users->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
							</td>
                        
                    </tr>
                   @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
						<th>Image</th>
                        <th>Name</th>
                        <th>E-Mail</th>                       
                        <th>Mobile Number</th>                       
                        <th>Status</th>
						<th>Action</th>
                       
                    </tr>
                    </tfoot>
                    </table>
                        </div>

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
				title: "Blacklist user",
				message: "Are you sure you want to blacklist this user?",
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
					if(result){
						window.location.href='{{url("admin/deletecustomers")}}'+'/'+id;
					}
				}
			});
		}
       
    </script>
         @endsection 