@extends('admin.layouts.app2')

@section('content')
<link href="{{ asset('css/plugins/dataTables/datatables.css')}}">
<link href="{{URL::asset('')}}css/admin/animate.css" rel="stylesheet">
<section class="content-header">
    <h1>
        Box
        <small>add/edit box</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/admin/viewBoxes')}}">box</a></li>
        <li class="active">add/edit box</li>
    </ol>
</section>

<section class="content  animated fadeInRight">
    <form id="addcoffee" method="post" enctype="multipart/form-data" action="{{url('admin/storeboxes')}}">
        {{ csrf_field() }}
        <div class="row">


            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Basic details</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}"" >
                            <label >Box name </label>
                            <input type="text"  autocomplete="off" name="name" id="name" placeholder="Enter box name"  class="form-control"
                                   @if($errors->any())
                                   value="{{old('name')}}"
                                   @elseif(!empty($records->box_name))
                                   value="{{$records->box_name}}"
                                   @endif />

                                   @if ($errors->has('name'))
                                   <span class="help-block m-b-none">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">

                            <label >Box title </label>
                            <input type="text"  autocomplete="off" name="title" placeholder="Enter box title"  id="title"  class="form-control"
                                   @if($errors->any())
                                   value="{{old('title')}}""
                                   @elseif(!empty($records->box_title))
                                   value="{{$records->box_title}}"
                                   @endif />

                                   @if ($errors->has('title'))
                                   <span class="help-block m-b-none">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif

                        </div>
                        <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}" >

                            <label >Price </label>
                            <input type="number"  autocomplete="off" name="price" id="price" placeholder="Enter box price"   class="form-control"
                                   @if($errors->any())
                                   value="{{old('price')}}""
                                   @elseif(!empty($records->box_price))
                                   value="{{$records->box_price}}"
                                   @endif />

                                   @if ($errors->has('price'))
                                   <span class="help-block m-b-none">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                            @endif

                        </div>
                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}" >

                            <label >Description</label>
                            <div>
                                <textarea class="form-control" id="description" rows="4"   name="description" placeholder="Enter description here">@if($errors->any()){{old('description')}}@elseif(!empty($records->box_description)){{$records->box_description}}@endif</textarea>
                            </div>

                            @if ($errors->has('description'))
                            <span class="help-block m-b-none">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif


                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Other details</h3>
                    </div>
                    <div class="box-body">

                        <?php $path = 'images/Box/'; ?>
                        @if(empty($records->box_image))
                        <img id="user-photo" width="200px" class="bevel-black" src="{{asset('/')}}images/upload.png" >
                        @else
                        <img id="user-photo" width="200px" class="bevel-black" src="{{asset('/')}}images/Box/{{$records->box_image}}" >
                        @endif




                        <div class="form-group"  {{ $errors->has('email') ? ' has-error' : '' }}>
                            <label>Image</label>
                            <div class="{{ $errors->has('box') ? ' has-error' : '' }}">
                                <div class="input-group {{ $errors->has('box') ? ' has-error' : '' }}">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary" onclick="$('#dasd').trigger('click');">
                                            Browse
                                        </span>

                                    </label>
                                    <input id="fileinput" type="text" class="form-control" readonly="" value="@if(isset($records->box_image)) {{$records->box_image}} @endif ">

                                    <input type="file"  autocomplete="off" name="box" onchange="preview(event)" accept="image/*" value="@if(isset($records->box_image)) {{$records->box_image}} @endif " id="dasd" class="form-control"  style="display:none" />

                                </div>
                                @if ($errors->has('box'))
                                <span class="help-block m-b-none">
                                    <strong>{{ $errors->first('box') }}</strong>
                                </span>
                                @endif


                            </div>
                        </div>


                    </div>
                </div>

            </div>


        </div>

        @if(!empty($records->id))
        <button type="submit" class="btn btn-warning">Update Box</button>
        @else
        <button type="submit" class="btn btn-success">Add Box</button>
        @endif

        <button type="reset" name="reset" class="btn btn-danger">
            <i class="glyphicon glyphicon-trash"></i>
            Clear</button>
        @if(!empty($records->id))
        <input type="hidden" name="id" value="{{$records->id}}">
        @endif
    </form>

</section>
<script src="{{ asset('AdminLTE2/bower_components//jquery/dist/jquery.min.js')}}"></script>
<script>

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