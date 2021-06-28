@extends('admin.layouts.home')

@section('content')
<!-- <link href="{{url('/')}}/css/plugins/dataTables/datatables.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

 <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <a  href="{{url('admin/addslides/0')}}" class="btn btn-primary pull-right">Add new</a>
                    </div>
					
                    <div class="ibox-content" style="margin-top:1%">
					@if(Session::has('msg'))
					{!! Session::get('msg') !!} 
					@endif
					
					
                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
						<th>Thumb</th>
						<th>Description</th>
						<th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
					@foreach($records as $row)
                    <tr>
                        
                    <td>
						@if(!empty($row->thumb) && file_exists(public_path($row->thumb)))
							<img src="{{asset($row->thumb)}}" style="width:52px;height:52px;">
						@endif
						</td>
                        <td>
                            {{$row->description}}
                        </td>
                        <td>
							<button onclick="deleteconfirm({{$row->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
						</td>
                    </tr>
                   @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Thumb</th>
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
	<!-- <script src="{{url('/')}}/js/plugins/dataTables/datatables.min.js"></script> -->
    <script src="{{url('/')}}/js/plugins/bootbox/bootbox.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
	<script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable();

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
						window.location.href='{{url("admin/deleteslides")}}'+'/'+id;
					}
				}
			});
		}
       
    </script>
         @endsection 