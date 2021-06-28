@extends('admin.layouts.app2')

@section('content')
<link href="{{ asset('css/plugins/dataTables/datatables.css')}}">
<link href="{{URL::asset('')}}css/admin/animate.css" rel="stylesheet">
<section class="content-header">
    <h1>
        Category
        <small>add/edit category</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/admin/subcategory')}}">category</a></li>
        <li class="active">add/edit category</li>
    </ol>
</section>

<section class="content  animated fadeInRight">
    <form id="addcoffee" method="post" enctype="multipart/form-data" action="{{url('admin/storecategory')}}">
        {{ csrf_field() }}
        <div class="row">


            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Basic details</h3>
                    </div>
                    <div class="box-body">
                    <div class="col-md-6">
                    <?php $path = 'images/subcategory/'; ?>
                        @if(empty($records->image))
                        <img id="user-photo" width="200px" class="bevel-black" src="{{asset('/')}}images/upload.png" >
                        @else
                        <img id="user-photo" width="200px" class="bevel-black" src="{{asset('/')}}images/subcategory/{{$records->image}}" >
                        @endif




                        <div class="form-group"  {{ $errors->has('image') ? ' has-error' : '' }}>
                            <label>Image</label>
                            <div class=""  >
                                <div class="input-group" {{ $errors->has('image') ? ' has-error' : '' }}>
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary" onclick="$('#dasd').trigger('click');">
                                            Browse
                                        </span>

                                    </label>
                                    <input id="fileinput" type="text" class="form-control" readonly="" value="@if(isset($records->image)) {{$records->image}} @endif " >

                                    <input type="file"  autocomplete="off" name="image" onchange="preview(event)" accept="image/*" value="@if(isset($records->image)) {{$records->image}} @endif " id="dasd" class="form-control" style="display:none"  />

                                </div>
                                @if ($errors->has('image'))
                                <span class="help-block m-b-none">
                                    <strong style="color: #ff0000">{{ $errors->first('image') }}</strong>
                                </span>
                                @endif


                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}"" >
                            <label >Category name </label>
                            <input type="text"  autocomplete="off" name="name" id="name" placeholder="Enter category name"  class="form-control"
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

                    </div>
                </div>
            </div>


            <!-- <div class="col-md-6">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Other details</h3>
                    </div>
                    <div class="box-body">

                        


                    </div>
                </div>

            </div> -->


        </div>

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