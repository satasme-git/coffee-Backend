@extends('admin.layouts.home')

@section('content')
<link href="{{url('/')}}/css/plugins/dataTables/datatables.css">

 <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <a href="{{url('admin/addfood/0')}}" class="btn btn-primary pull-right">Add new</a>
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
                        <th>Category</th>                       
                        <th>Sub Category</th>                       
                        <th>Price</th>
                        <th>Description</th>
						<th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php $path='images/food/'; ?>
					@foreach($food as $foods)
                    <tr>
                        
                        <td>@if(file_exists(public_path($path.$foods->img)))
							<img src="{{asset($path.$foods->img)}}" style="width:52px;height:52px;">
						@endif</td>
                        <td>{{$foods->name}}</td>
                        <td>{{$foods->category}}</td>
                        <td>{{$foods->subcategory}}</td>
                        <td>{{money_formate($foods->price)}}</td>
                        <td>{{$foods->description}}</td>
						<td>
							<a href="{{url('admin/addfood/'.$foods->id)}}" class="btn btn-primary"><i class="fa fa-pencil"></i><a>
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
					if(result){
						window.location.href='{{url("admin/deletefood")}}'+'/'+id;
					}
				}
			});
		}
       
    </script>
         @endsection 