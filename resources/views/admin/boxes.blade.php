@extends('admin.layouts.app2')

@section('content')
<link href="{{ asset('css/plugins/dataTables/datatables.css')}}">
<link href="{{URL::asset('')}}css/admin/animate.css" rel="stylesheet">
<section class="content-header">
    <h1>
    Box
        <small>View Boxes</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('admin/addboxes/0')}}">add box</a></li>
        <li class="active">View boxes</li>
    </ol>
</section>
<section class="content  animated fadeInRight">

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
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>                       
                                    <!-- <th>Date</th>                        -->
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $path = 'images/Box/'; ?>
                                @foreach($boxes as $box)
                                <tr>

                                    <td>
                                        <img src="{{asset($path.$box->box_image)}}" style="width:52px;height:52px;">
                                    </td>
                                    <td>{{$box->box_title}}</td>
                                    <td>{{$box->box_description}}</td>

                                    @if($box->status == '1')
                                    <td> <span class="badge badge-info"> Active</span></td>

                                    @else
                                    <td></td>
                                    @endif

                                    <td style="width:100px">
                                        <a href="{{url('admin/addboxes/'.$box->id)}}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                        <button onclick="deleteconfirm({{$box->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
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
      });
  </script>

<script src="{{ asset('js/jquery.1.12.4.min.js')}}"></script>

	<script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                

            });

        });
		function deleteconfirm(id){
			bootbox.confirm({
				title: "Delete box",
				message: "Are you sure you want to delete this box?",
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
						window.location.href='{{url("admin/deleteboxes")}}'+'/'+id;
					}
				}
			});
		}
       
    </script>

@endsection
