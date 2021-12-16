@extends('Layouts.app')

@section('content')
<!-- <link href="{{asset('/')}}css/add-coffee.css" rel="stylesheet"> -->

<!-- Page header -->
<div class="page-header">

    <div class="page-header-content" style="margin-top:-10px;margin-bottom:-10px">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Customer</span> - create customer</h4>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/view_creditor">Customer</a></li>
            <li class="active">Create customer</li>
        </ul>


    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight" style="margin-top:-20px">

    <div class="content">
        @if(Session::has('msg'))
        {!! Session::get('msg') !!} 
        @endif

        <form id="addcoffee" method="post" enctype="multipart/form-data" action="{{url('admin/add_customer')}}">
            {{ csrf_field() }}
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="row">

                        <div class="col-md-6">

                            <fieldset>
                                <legend class="text-semibold"><i class="icon-image2 position-left"></i> Basics details</legend>



                                <div   class="form-group {{ $errors->has('name') ? ' has-error' : '' }}" >
                                    <label>Customer Name</label>
                                    <div>
                                        <input type="text"  autocomplete="off" name="name" id="name"  class="form-control" placeholder="Enter Name "
                                               @if($errors->any())
                                               value="{{old('name')}}""
                                               @elseif(!empty($food->name))
                                               value="{{$food->name}}"
                                               @endif />
                                    </div>
                                    @if ($errors->has('name'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div   class="form-group {{ $errors->has('email') ? ' has-error' : '' }}" >
                                    <label>Email</label>
                                    <div>
                                        <input type="text"  autocomplete="off" name="email" id="email"  class="form-control" placeholder="Enter Email "
                                               @if($errors->any())
                                               value="{{old('email')}}""
                                               @elseif(!empty($food->email))
                                               value="{{$food->email}}"
                                               @endif />
                                    </div>
                                    @if ($errors->has('email'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div   class="form-group {{ $errors->has('mobile_no') ? ' has-error' : '' }}" >
                                    <label>Mobile Number</label>
                                    <div>
                                        <input type="text"  autocomplete="off" name="mobile_no" id="mobile_no"  class="form-control" placeholder="Enter Mobile Number "
                                               @if($errors->any())
                                               value="{{old('mobile_no')}}""
                                               @elseif(!empty($food->mobile_no))
                                               value="{{$food->mobile_no}}"
                                               @endif />
                                    </div>
                                    @if ($errors->has('mobile_no'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('mobile_no') }}</strong>
                                    </span>
                                    @endif
                                </div>




                            </fieldset>
                        </div> 
                        <div class="col-md-6">
                            <fieldset>
                                <legend class="text-semibold"><i class="icon-image2 position-left"></i> Basics details</legend>
                                <div class="ibox-content">
                                    <div class="form-group  {{ $errors->has('image') ? ' has-error' : '' }}" >
                                        <?php $path = 'images/Customer/'; ?>
                                        <img id="coffee-photo" class="bevel-black" src="{{asset('/')}}images/upload.png" width="200px"
                                             @if($errors->any())
                                             value="{{old('image')}}""
                                             @elseif(!empty($food->image))
                                             src="{{asset($path.$food->image)}}"
                                             @endif >


                                    </div>




                                    <div class="form-group {{ $errors->has('frame') ? ' has-error' : '' }}" >

                                        <label > Image </label>
                                        <div class="{{ $errors->has('frame') ? ' has-error' : '' }}">
                                            <div class="input-group">
                                                <label class="input-group-btn">
                                                    <span class="btn btn-primary" onclick="$('#dasd').trigger('click');">
                                                        Browse
                                                    </span>

                                                </label>
                                                <input id="fileinput" type="text" class="form-control" readonly="" value="@if(isset($food->img)) {{$food->img}} @endif ">

                                                <input type="file"  autocomplete="off" name="food" onchange="preview(event)" accept="image/*" value="@if(isset($food->img)) {{$food->img}} @endif " id="dasd" class="form-control"  style="display:none" />

                                            </div>
                                            @if ($errors->has('frame'))
                                            <span class="help-block m-b-none">
                                                <strong>{{ $errors->first('frame') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </fieldset>
                        </div>

                    </div>
                    @if(!empty($food->id))
                    <input type="hidden" name="id" value="{{$food->id}}">
                    @endif




                    <br/>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Add Customer</button>


            <button type="reset" name="reset" class="btn btn-danger">
                <i class="glyphicon glyphicon-trash"></i>
                Clear</button>
        </form>
    </div>
</div>
<script>
    var coffeeurl = '@if(isset($food)) {{asset("images/food/".$food->img)}} @endif';
    $("#dasd").on("change", function () {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader)
            return;
        $('#fileinput').val(this.files.length ? this.files[0].name : '');
        if (/^image/.test(files[0].type)) {
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onloadend = function () {

                coffeeurl = this.result;
            }
        }
    });


</script>
<script type="text/javascript">
    function preview(event) {
        var selectedFile = event.target.files[0];
        var reader = new FileReader();
        var imgtag = document.getElementById("coffee-photo");
        reader.onload = function (event) {
            imgtag.src = event.target.result;
        };
        reader.readAsDataURL(selectedFile);
    }
</script>



<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script> -->
<script type="text/javascript">

    $(document).ready(function () {


        $('.dynamic2').change(function () {


            if ($(this).val() != '') {
                var select = $(this).attr("id");

                var value = $(this).val();
                // alert("sssssssssssss : "+value);
                if (value == 1) {
                    $(".coffe_sizes").show();
                    $("#price").hide();
                    // var oust=document.getElementById("oust").value;
                    // var installemt_val=parseFloat(oust)/6

                    // document.getElementById("inst").value=installemt_val;
                } else {
                    // document.getElementById("inst").value=0;
                    $(".coffe_sizes").hide();
                    $("#price").show();
                }



            }


        });
    });


</script>
@endsection