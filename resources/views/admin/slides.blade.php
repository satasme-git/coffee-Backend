@extends('admin.layouts.app2')

@section('content')
<link href="{{ asset('css/plugins/dataTables/datatables.css')}}">
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
<section class="content">

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
                                    <th>Thumb</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $path = '/work/public/images/slides/'; ?>
                                @foreach($records as $row)
                                <tr>

                                    <td style="width:155px">

                                        <img src="{{asset($path.$row->thumb)}}" style="width:150px;">

                                    </td>
                                    <td>
                                        {{$row->description}}
                                    </td>
                                    <td style="width:100px">
                                        <a href="{{url('admin/addslides/'.$row->id)}}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
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

<script src="{{ asset('js/jquery.1.12.4.min.js')}}"></script>

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
                                                    if (result){
                                                    window.location.href = '{{url("admin/deleteslides")}}' + '/' + id;
                                                    }
                                                    }
                                            });
                                            }

</script>

@endsection
