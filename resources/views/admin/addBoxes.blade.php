@extends('Layouts.app')
@section('content')
<div class="page-header" >

    <div class="page-header-content">
        <div class="page-title" style="margin-top:-10px;margin-bottom:-10px">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Box</span> - Create Box</h4>
        </div>
    </div>

    <div class="breadcrumb-line" >
        <ul class="breadcrumb">
            <li><a href="/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/view_user">Box</a></li>
            <li class="active">Create Box</li>
        </ul>
    </div>
</div>
<div class="content  animated fadeInRight">
    <form id="addcoffee" method="post" enctype="multipart/form-data" action="{{url('admin/storeboxes')}}">
        {{ csrf_field() }}
        <div class="panel panel-flat">
            <div class="panel-body">





                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-image2 position-left"></i> Image details</legend>
                            <?php $path = 'images/Box/'; ?>
                            @if(empty($records->img))
                            <img id="user-photo" class="bevel-black" src="{{asset('/')}}images/upload.png" width="300px">
                            @else
                            <img id="user-photo" class="bevel-black" src="{{asset('/')}}images/Box/{{$records->img}}" width="300px">
                            @endif
                        </fieldset>


                    </div>
                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-copy position-left"></i> Basic details</legend>
                            <div class="form-group clearfix">
                                <label>Image</label>
                                <div class="{{ $errors->has('img') ? ' has-error' : '' }}">
                                    <div class="input-group {{ $errors->has('img') ? ' has-error' : '' }}">
                                        <label class="input-group-btn">
                                            <span class="btn btn-primary" onclick="$('#dasd').trigger('click');">
                                                Browse
                                            </span>

                                        </label>
                                        <input id="fileinput" type="text" class="form-control" readonly="" value="@if(isset($records->img)) {{$records->img}} @endif ">

                                        <input type="file"  autocomplete="off" name="box" onchange="preview(event)" accept="image/*" value="@if(isset($records->img)) {{$records->img}} @endif " id="dasd" class="form-control"  style="display:none" />

                                    </div>
                                    @if ($errors->has('img'))
                                    <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('box') }}</strong>
                                    </span>
                                    @endif


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label >Box name </label>
                                    <input type="text"  autocomplete="off" name="name" id="name"  class="form-control"
                                           @if($errors->any())
                                           value="{{old('name')}}"
                                           @elseif(!empty($records->name))
                                           value="{{$records->name}}"
                                           @endif />

                                           @if ($errors->has('name'))
                                           <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label >Box title </label>
                                    <input type="text"  autocomplete="off" name="title" id="title"  class="form-control"
                                           @if($errors->any())
                                           value="{{old('title')}}""
                                           @elseif(!empty($records->title))
                                           value="{{$records->title}}"
                                           @endif />

                                           @if ($errors->has('title'))
                                           <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 {{ $errors->has('price') ? ' has-error' : '' }}">
                                    <label >Price </label>
                                    <input type="text"  autocomplete="off" name="price" id="price"  class="form-control"
                                           @if($errors->any())
                                           value="{{old('price')}}""
                                           @elseif(!empty($records->price))
                                           value="{{$records->price}}"
                                           @endif />

                                           @if ($errors->has('price'))
                                           <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>


                            <div class="row" style="padding-top:20px">
                                <div class="col-md-12 {{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label >Description</label>
                                    <div>
                                        <textarea class="form-control" id="description" rows="4" name="description" placeholder="Enter  Description"> @if($errors->any()){{old('description')}}@elseif(!empty($records->description)){{$records->description}}@endif </textarea>
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