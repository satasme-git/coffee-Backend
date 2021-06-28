@extends('admin.layouts.home')
@section('content')
<link href="{{url('/')}}/css/plugins/dataTables/datatables.css">

 <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Sub Category</h5>
                        
                    </div>
					
                    <div class="ibox-content">
					@if(Session::has('msg'))
					{!! Session::get('msg') !!} 
					@endif
					
					<div class="row">
						<form method="post" enctype="multipart/form-data" action="{{url('/admin/subcategory')}}">
						{{ csrf_field() }}
							<div class="col-md-3 col-lg-3">
								<input type="text" class="form-control input-sm" placeholder="SubCategory name" name="subcategory" >
							</div>

							<div class="col-md-6 col-lg-6" style="display:flex">
								<label class="input-group-btn">
									<span class="btn btn-primary" onclick="$('#dasd').trigger('click');">
			 							Browse 
									</span>

								</label>
								<input id="fileinput" type="text" class="form-control" readonly="" style="width:50%;margin-left:15%">
								<input type="file"  autocomplete="off" name="subcatimage"  accept="image/*"  id="dasd" class="form-control" style="display:none" />
							</div>

							<div class="col-md-3 col-lg-3">
								<button class="btn btn-primary ">Add</button>
							</div>
						</form>
					</div>
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Category Name</th>
                        <th width="20%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
					
					<?php $path='images/subcategory/'; ?>
					@foreach($records as $row)
                    <tr>
                        
						<td>@if(file_exists(public_path($path.$row->image)))
							<img src="{{asset($path.$row->image)}}" style="width:52px;height:52px;">
						@endif</td>
                        <td>{{$row->name}}</td>
						<td>
							<button class="btn btn-primary" onclick="editcategory('{{$row->id}}','{{$row->name}}')"><i class="fa fa-pencil"></i></button>
							<button onclick="deleteconfirm({{$row->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
							</td>
                        
                    </tr>
                   @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Image</th>
                        <th>Category Name</th>
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
		<div id="editcategory" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<form method="post"> 
			{{ csrf_field() }}
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Category</h4>
			  </div>
			  <div class="modal-body">
				<div class="form-group">
					<label class="col-lg-2 control-label">Category</label>
					<div class="col-lg-10">
						<input type="text" id="subcategory" name="subcategory" placeholder="category Name" class="form-control"> 
						<input type="hidden" name="id" id="id" > 
					</div>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="submit" class="btn btn-primary" >Save</button>
			  </div>
			</div>
			</form>

		  </div>
		</div>
	<script src="{{url('/')}}/js/plugins/dataTables/datatables.min.js"></script>
	<script src="{{url('/')}}/js/plugins/bootbox/bootbox.min.js"></script>
	<script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                order:[]

            });

        });
		function deleteconfirm(id){
			bootbox.confirm({
				title: "Delete Record",
				message: "Are you sure you want to delete this category",
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
						window.location.href='{{url("admin/deletesubcategory")}}'+'/'+id;
					}
				}
			});
		}
		function editcategory(id,name){
			$('#subcategory').val(name);
			$('#id').val(id);
			$('#editcategory').modal('show');
		}

		$("#dasd").on("change", function(){
    		var files = !!this.files ? this.files : [];
    		if (!files.length || !window.FileReader) return;
    		$('#fileinput').val(this.files.length ? this.files[0].name : '');
    		if (/^image/.test(files[0].type)) {
    			var reader = new FileReader();
    			reader.readAsDataURL(files[0]);
    			reader.onloadend = function(){

    			}
    		}
    	});
       
    </script>
         @endsection 