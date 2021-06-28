@extends('admin.layouts.app2')

@section('content')
<link href="{{ asset('css/plugins/dataTables/datatables.css')}}">
<link href="{{URL::asset('')}}css/admin/animate.css" rel="stylesheet">
<section class="content-header">
    <h1>
        Customer
        <small>View customers</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <!--<li><a href="{{url('admin/addboxes/0')}}">add box</a></li>-->
        <li class="active">View customers</li>
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
                                    <th>Name</th>
                                    <th>E-Mail</th>                       
                                    <th>Mobile Number</th>                       
                                 
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $path = 'images/users/'; ?>
                                @foreach($records as $users)
                                <tr>

                                    <td>
                                        @if(!empty($users->image))
                                       <img src="{{asset($path.$users->image)}}" style="width:52px">
                                       @else
                                       <img src="{{asset('/')}}images/avatar.jpg" style="width:52px">
                                  
                                       @endif
                                    </td>
                                    <td>{{$users->name}}</td>
                                    <td>{{$users->email}}</td>
                                    <td>{{$users->mobile_no}}</td>

<!--                                    @if($users->status == '0')
                                    <td>Active</td>
                                    @else
                                    <td>Blacklisted</td>
                                    @endif-->

                                    <td>
                                        <a href="{{url('admin/addcustomers/'.$users->id)}}" class="btn btn-default"><i class="fa fa-file"></i></a>
                                        <!--<button onclick="deleteconfirm({{$users->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>-->

                                        @if($users->status==0)
                                        <button onclick="blacklistfirm({{$users->id}})" type="button" class="btn btn-success btn-sm " >
                                            Activate </button>
                                        @elseif($users->status==1)
                                        <button  onclick="activatefirm({{$users->id}})" type="button" class="btn btn-github btn-sm ">
                                            Blacklist </button>

                                        @endif
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

<script src="{{ asset('js/jquery.1.12.4.min.js')}}"></script>

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
                                                 if (result){
                                                 window.location.href = '{{url("admin/deletecustomers")}}' + '/' + id;
                                                 }
                                                 }
                                         });
                                         }
</script>
<script>
function blacklistfirm(id){
		swal({
                title: "Are you sure?",
                text: "Do you want to activate the account!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
         
                   
					
                    swal("Poof! Account has been activated!", {
                    icon: "success",
                    
                    }
                
                    ).then((value) => {
                        window.location.href="{{url('customer_active/')}}"+ "/" + id;
                         });
                    ;
                } else {
                    swal("Your imaginary file is safe!");
                }
                });
		}

        function activatefirm(id){
		swal({
                title: "Are you sure?",
                text: "Once Deactivate, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
         
                   
                    swal("Poof! Account has been Blacklisted!", {
                    icon: "success",
                 
                    }
                   
                    ).then((value) => {
                        window.location.href="{{url('customer_blacklist/')}}"+ "/" + id;
                         });
                    ;
                } else {
                    swal("Your imaginary file is safe!");
                }
                });
		}
</script>

@endsection
