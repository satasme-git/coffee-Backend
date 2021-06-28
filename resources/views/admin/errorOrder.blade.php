@extends('admin.layouts.home')

@section('content')
<link href="{{url('/')}}/css/plugins/dataTables/datatables.css">

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">


                <!-- <div class="ibox-content">
                    @if(Session::has('msg'))
                    {!! Session::get('msg') !!}
                    @endif -->


                    <div class="table-responsive">
                    <div class="alert alert-danger" role="alert">
                        <a href="#" class="alert-link">Customer has no orders</a>
                        </div>
                    </div>

                <!-- </div> -->

            </div>
        </div>
    </div>
</div>
<!-- <script src="{{url('/')}}/js/plugins/dataTables/datatables.min.js"></script> -->
<script src="{{url('/')}}/js/plugins/bootbox/bootbox.min.js"></script>

@endsection
