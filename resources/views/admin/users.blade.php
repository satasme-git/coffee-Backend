@extends('Layouts.app')

@section('content')
<link href="{{url('/')}}/css/plugins/dataTables/datatables.css">
<div class="page-header" >

    <div class="page-header-content" style="margin-top:-10px;margin-bottom:-10px">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Customer</span> - View customers</h4>
        </div>

        <div class="heading-elements">
    
        </div>
    </div>

    <div class="breadcrumb-line" >
        <ul class="breadcrumb">
            <li><a href="/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/view_user">Customer</a></li>
            <li class="active">View customers</li>
        </ul>

        <ul class="breadcrumb-elements">
        
        </ul>
    </div>
</div>
<!-- /page header -->
<div class="wrapper wrapper-content animated fadeInRight" style="margin-top:-20px"> 
   <!-- <div class="panel panel-flat"> -->
        <div class="panel-body">
            <div class="table-responsive">
                <div class="panel panel-default">
                    <!--                <div class="panel-heading">View Customers
                                        <a style="/* padding: 10px; */height: 25px;display: flex;justify-content: center;align-items: center;font-size: 12px;" href="{{url('admin/createCustomer')}}" class="btn btn-primary pull-right">
                                          <i class="fa fa-pencil"></i> 
                                            Add New
                                        </a>
                                    </div> -->
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
                                            <th>Name</th>
                                            <th>E-Mail</th>                       
                                            <th>Mobile Number</th>                       
                                            <th>Points</th>
                                            <th>Joined date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $path = 'images/Customer/'; ?>
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
                                            @if(!empty($users->points))
                                            <td>{{$users->points}}</td>
                                            @else
                                            <td>0</td>

                                            @endif
                                            <td>{{$users->created_at}}</td>


                                            <!--@if($users->status == '0')-->
                                            <!--    <td>Active</td>-->
                                            <!--@else-->
                                            <!--    <td>Blacklisted</td>-->
                                            <!--@endif-->

                                            <td>
                                                <a href="{{url('admin/addcustomers/'.$users->id)}}" class="btn btn-default"><i class="fa fa-file"></i></a>
                                                <!--<button onclick="deleteconfirm({{$users->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>-->

                                                @if($users->status==1)
                                                <button onclick="blacklistfirm({{$users->id}})" type="button" class="btn btn-success btn-sm " >
                                                    Activate </button>
                                                @elseif($users->status==0)
                                                <button  onclick="activatefirm({{$users->id}})" type="button" class="btn btn-github btn-sm ">
                                                    Blacklist </button>

                                                @endif
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                      <!--              <tfoot>-->
                      <!--              <tr>-->
                                                                <!--<th>Image</th>-->
                      <!--                  <th>Name</th>-->
                      <!--                  <th>E-Mail</th>                       -->
                      <!--                  <th>Mobile Number</th>                       -->
                                        <!--<th>Status</th>-->
                                                                <!--<th>Action</th>-->

                                    <!--              </tr>-->
                                    <!--              </tfoot>-->
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- </div>  -->
</div>

<script src="{{url('/')}}/js/plugins/dataTables/datatables.min.js"></script>
<script src="{{url('/')}}/js/plugins/bootbox/bootbox.min.js"></script>
<script>
                                                    $(document).ready(function(){
                                                    $('.dataTables-example').DataTable({


                                                    });
                                                    });
// 		function deleteconfirm(id){
// 			bootbox.confirm({
// 				title: "Blacklist user",
// 				message: "Are you sure you want to blacklist this user?",
// 				buttons: {
// 					confirm: {
// 						label: 'Yes',
// 						className: 'btn-success'
// 					},
// 					cancel: {
// 						label: 'No',
// 						className: 'btn-danger'
// 					}
// 				},
// 				callback: function (result) {
// 					if(result){
// 						window.location.href='{{url("admin/deletecustomers")}}'+'/'+id;
// 					}
// 				}
// 			});
// 		}

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
                                                            window.location.href = "{{url('customer_active/')}}" + "/" + id;
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
                                                            window.location.href = "{{url('customer_blacklist/')}}" + "/" + id;
                                                            });
                                                            ;
                                                            } else {
                                                            swal("Your imaginary file is safe!");
                                                            }
                                                            });
                                                    }

</script>
@endsection 