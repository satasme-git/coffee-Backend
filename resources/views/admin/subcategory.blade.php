
@extends('Layouts.app')
@section('content')
<div class="page-header" >

    <div class="page-header-content">
        <div class="page-title" style="margin-top:-10px;margin-bottom:-10px">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Category</span> - View categories</h4>
        </div>
    </div>

    <div class="breadcrumb-line" >
        <ul class="breadcrumb">
            <li><a href="/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/view_user">Category</a></li>
            <li class="active">View categories</li>
        </ul>
    </div>
</div>
<div class="content  animated fadeInRight">
    <div class="panel panel-flat">
        <div class="panel-body">

           
            <div class="ibox-content">
                @if(Session::has('msg'))
                {!! Session::get('msg') !!} 
                @endif

                <div class="table-responsive">
                    <table class="table table-striped  table-hover dataTables-example" >
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
                                    <a href="{{url('admin/addcategory/'.$row->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i><a>
                                            <!-- <button class="btn btn-primary" onclick="editcategory('{{$row->id}}','{{$row->name}}')"><i class="fa fa-pencil"></i></button> -->
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