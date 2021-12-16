@extends('Layouts.app')

@section('content')
<link href="{{asset('/')}}css/add-coffee.css" rel="stylesheet">
<div class="page-header" >

    <div class="page-header-content">
        <div class="page-title" style="margin-top:-10px;margin-bottom:-10px">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Customer</span> - View customers</h4>
        </div>
    </div>

    <div class="breadcrumb-line" >
        <ul class="breadcrumb">
            <li><a href="/dashboard"><i class="icon position-left"></i> Home</a></li>
            <li><a href="/admin/view_user">Customer</a></li>
            <li class="active">View customers</li>
        </ul>
    </div>
</div>
<div class="content  animated fadeInRight">
    <form id="addcoffee" method="post" enctype="multipart/form-data" action="/admin/updateCustomerById/{{$records->id}}">
        <div class="panel panel-flat">
            <div class="panel-body">

                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <?php $path = 'images/Customer/'; ?>
                        @if(!empty($records->image))
                        <img src="{{asset($path.$records->image)}}" style="width:400px">
                        @else
                        <img src="{{asset('/')}}images/avatar.jpg" style="width:300px">

                        @endif

                    </div>

                    <div class="col-md-6">


                        <div class="row {{ $errors->has('name') ? ' has-error' : '' }}" >
                            <div class="col-md-12">
                                <label >Customer Name </label>
                                <input type="text"  autocomplete="off" name="name" id="name"  class="form-control"  
                                       @if($errors->any())
                                       value="{{old('name')}}"" 
                                       @elseif(!empty($records->name)) 
                                       value="{{$records->name}}" 
                                       @endif />
                                       @if ($errors->has('name'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row {{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label >E-Mail</label>
                                <input type="text"  autocomplete="off" name="email" id="email"  class="form-control"  
                                       @if($errors->any())
                                       value="{{old('email')}}"" 
                                       @elseif(!empty($records->email)) 
                                       value="{{$records->email}}" 
                                       @endif />
                                       @if ($errors->has('email'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row {{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label >Mobile Number</label>
                                <input type="text"  autocomplete="off" name="mobile_no" id="mobile_no"  class="form-control"  
                                       @if($errors->any())
                                       value="{{old('mobile_no')}}"" 
                                       @elseif(!empty($records->mobile_no)) 
                                       value="{{$records->mobile_no}}" 
                                       @endif />
                                       @if ($errors->has('mobile_no'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('mobile_no') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-12">

                                <label >Available Points</label>
                                <input type="text"  autocomplete="off" readonly name="points" id="points"  class="form-control"  
                                       @if($errors->any())
                                       value="{{old('name')}}"" 
                                       @elseif(!empty($points->points)) 
                                       value="{{$points->points}}" 
                                       @else
                                       value="0" 
                                       @endif />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                <label >Add Points</label>
                                <input type="number"  autocomplete="off"  name="ad_point" id="ad_point" value="0"  class="form-control"  
                                       />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning" style="margin-top: 20px">Update Customer</button>
                    </div>
                </div>
                @if(!empty($records->id))
                <input type="hidden" name="id" value="{{$records->id}}">
                @endif


            </div>

        </div>




    </form>
</div>
<script>
    // var coffeeurl = '@if(isset($records)) {{asset("images/users/".$records->name)}} @endif';
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
        var imgtag = document.getElementById("user-photo");
        reader.onload = function (event) {
            imgtag.src = event.target.result;
        };
        reader.readAsDataURL(selectedFile);
    }
</script>

@endsection 