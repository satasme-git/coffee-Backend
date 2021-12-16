@extends('Layouts.app')
@section('content')
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

<div class="content  animated fadeInRight">
    <form id="addcoffee" method="post" enctype="multipart/form-data" action="{{url('/admin/slides')}}">
        {{ csrf_field() }}
        <div class="panel panel-flat">
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-image2 position-left"></i> Image details</legend>
                            <?php $path = '/work/public/images/slides/'; ?>

                            @if(empty($slides->thumb))
                            <img id="user-photo" class="bevel-black" src="{{asset('/')}}images/upload.png" width="300px">
                            @else
                            <img id="user-photo" class="bevel-black" src="{{asset('/')}}/work/public/images/slides/{{$slides->thumb}}"width="300px">
                            @endif
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-copy position-left"></i> Basic details</legend>
                            <div class="form-group clearfix">
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
                            <div class="row" style="padding-top:20px">
                                <div class="col-md-12 {{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label >Description</label>
                                    <div>
                                        <textarea class="form-control" id="description" rows="4" name="description" placeholder="Enter  Description"> @if($errors->any()){{old('description')}}@elseif(!empty($slides->description)){{$slides->description}}@endif </textarea>
                                    </div>

                                    @if ($errors->has('description'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="row" style="padding-top:20px">
                                <div class="col-md-12">

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
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
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