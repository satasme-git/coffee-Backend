@extends('admin.layouts.app2')

@section('content')
<link href="{{ asset('css/plugins/dataTables/datatables.css')}}">
<link href="{{URL::asset('')}}css/admin/animate.css" rel="stylesheet">
<section class="content-header">
    <h1>
        Category
        <small>View Category</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('admin/addcategory/0')}}">add category</a></li>
        <li class="active">View category</li>
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
                                    <th>Category Name</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $path = 'images/subcategory/'; ?>
                                @foreach($records as $row)
                                <tr>

                                    <td>@if(file_exists(public_path($path.$row->image)))
                                        <img src="{{asset($path.$row->image)}}" style="width:52px;height:52px;">
                                        @endif</td>
                                    <td>{{$row->name}}</td>
                                    <td>
                                        <a href="{{url('admin/addcategory/'.$row->id)}}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                <!-- <button class="btn btn-primary" onclick="editcategory('{{$row->id}}','{{$row->name}}')"><i class="fa fa-pencil"></i></button> -->
                                        <button onclick="deleteconfirm({{$row->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
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
<script src="{{ asset('js/jquery.1.12.4.min.js')}}"></script>

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
                                                    if (result){
                                                    window.location.href = '{{url("admin/deletesubcategory")}}' + '/' + id;
                                                    }
                                                    }
                                            });
                                            }
                                            function editcategory(id, name){
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
