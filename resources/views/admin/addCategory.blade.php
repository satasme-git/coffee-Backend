@extends('Layouts.app')
@section('content')
<div class="page-header">

    <div class="page-header-content" style="margin-top:-10px;margin-bottom:-10px">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Category</span> - create category</h4>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/view_creditor">Category</a></li>
            <li class="active">Create category</li>
        </ul>


    </div>
</div>

<div class="content  animated fadeInRight">
    <form id="addcoffee" method="post" enctype="multipart/form-data" action="{{url('admin/storecategory')}}">
        <div class="panel panel-flat">
            <div class="panel-body">

                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                    <fieldset>
											<legend class="text-semibold"><i class="icon-image2 position-left"></i> Image details</legend>
                        <?php $path = 'images/subcategory/'; ?>
                        @if(empty($records->image))
                        <img id="user-photo" class="bevel-black" src="{{asset('/')}}images/upload.png"width="200px" >
                        @else
                        <img id="user-photo" class="bevel-black" src="{{asset('/')}}images/subcategory/{{$records->image}}" width="200px">
                        @endif
</fieldset>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group clearfix">
                        <fieldset>
											<legend class="text-semibold"><i class="icon-copy position-left"></i> Basics details</legend>
                            <div class=""  >
                                <div class="input-group" {{ $errors->has('image') ? ' has-error' : '' }}>
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary" onclick="$('#dasd').trigger('click');">
                                            Browse
                                        </span>

                                    </label>
                                    <input id="fileinput" type="text" class="form-control" readonly="" value="@if(isset($records->image)) {{$records->image}} @endif ">

                                    <input type="file"  autocomplete="off" name="image" onchange="preview(event)" accept="image/*" value="@if(isset($records->image)) {{$records->image}} @endif " id="dasd" class="form-control"  style="display:none" />

                                </div>
                                @if ($errors->has('image'))
                                <span class="help-block m-b-none">
                                    <strong style="color: #ff0000">{{ $errors->first('image') }}</strong>
                                </span>
                                @endif


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 " {{ $errors->has('name') ? ' has-error' : '' }}>
                                <label >Category name </label>
                                <input type="text"  autocomplete="off" name="name" id="name"  class="form-control"
                                       @if($errors->any())
                                       value="{{old('name')}}""
                                       @elseif(!empty($records->name))
                                       value="{{$records->name}}"
                                       @endif />

                                       @if ($errors->has('name'))
                                       <span class="help-block m-b-none">
                                    <strong style="color: #ff0000">{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>




                        <div class="row" style="padding-top:20px">
                            <div class="col-md-12">
                                @if(!empty($records->id))
                                <button type="submit" class="btn btn-warning">Update category</button>
                                @else
                                <button type="submit" class="btn btn-success">Add category</button>
                                @endif

                                <button type="reset" name="reset" class="btn btn-danger">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    Clear</button>
                                @if(!empty($records->id))
                                <input type="hidden" name="id" value="{{$records->id}}">
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