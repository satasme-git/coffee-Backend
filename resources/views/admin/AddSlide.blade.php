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
    <form id="addcoffee" method="post" enctype="multipart/form-data" action="{{url('/admin/slides')}}">
        {{ csrf_field() }}
        <div class="row">


            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Basic details</h3>
                    </div>
                    <div class="box-body">
                    <div class="col-md-6">

                        <?php $path = '/work/public/images/slides/'; ?>

                        @if(empty($slides->thumb))
                        <img id="user-photo" width="200px" class="bevel-black" src="{{asset('/')}}images/upload.png" >
                        @else
                        <img id="user-photo" width="200px" class="bevel-black" src="{{asset('/')}}images{{$slides->thumb}}" >
                        @endif

                        <div class="form-group"  {{ $errors->has('email') ? ' has-error' : '' }}>
                            <label>Image</label>
                            <div class="{{ $errors->has('thumb') ? ' has-error' : '' }}">
                                <div class="input-group {{ $errors->has('thumb') ? ' has-error' : '' }}">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary" onclick="$('#dasd').trigger('click');">
                                            Browse
                                        </span>

                                    </label>
                                    <input id="fileinput" type="text" class="form-control" readonly="" value="@if(isset($slides->thumb)) {{$slides->thumb}} @endif ">

                                    <input type="file"  autocomplete="off" name="thumb" onchange="preview(event)" accept="image/*" value="@if(isset($slides->thumb)) {{$slides->thumb}} @endif " id="dasd" class="form-control"  style="display:none" />

                                </div>
                                @if ($errors->has('thumb'))
                                <span class="help-block m-b-none">
                                    <strong>{{ $errors->first('thumb') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}" >

                        <label >Description</label>

                        <textarea class="form-control" id="description" rows="4" name="description" placeholder="Enter  Description">@if($errors->any()){{old('description')}}@elseif(!empty($slides->description)){{$slides->description}}@endif</textarea>


                        @if ($errors->has('description'))
                        <span class="help-block m-b-none">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                        @endif


                    </div>

                    </div>
                </div>
                </div>
            </div>


           


        </div>

        @if(!empty($slides->id))
        <button type="submit" class="btn btn-warning">Update slide</button>
        @else
        <button type="submit" class="btn btn-success">Add slide</button>
        @endif

        <button type="reset" name="reset" class="btn btn-danger">
            <i class="glyphicon glyphicon-trash"></i>
            Clear</button>
        @if(!empty($slides->id))
        <input type="hidden" name="id" value="{{$slides->id}}">
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