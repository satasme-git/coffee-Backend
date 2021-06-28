@extends('admin.layouts.app2')

@section('content')
<link href="{{ asset('css/plugins/dataTables/datatables.css')}}">
<link href="{{URL::asset('')}}css/admin/animate.css" rel="stylesheet">
<section class="content-header">
    <h1>
        Event
        <small>add/edit event</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/admin/viewEvents')}}">events</a></li>
        <li class="active">add/edit event</li>
    </ol>
</section>

<section class="content  animated fadeInRight">
<form id="addcoffee" method="post" enctype="multipart/form-data" action="{{url('admin/events2')}}">
        {{ csrf_field() }}
        <div class="row">


            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Basic details</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">

                            <label >Event title </label>
                            <input type="text"  autocomplete="off" name="title" id="title" placeholder="Enter event title"  class="form-control"
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
                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">


                            <label >Description</label>
                            <div>
                                <textarea class="form-control" id="description" rows="4" name="description" placeholder="Enter  Description">@if($errors->any()){{old('description')}}@elseif(!empty($records->description)){{$records->description}}@endif</textarea>
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

                        <?php $path = 'images/Events/';?>

                        @if(empty($records->event_image))
                        <img id="user-photo" width="170px" class="bevel-black" src="{{asset('/')}}images/upload.png" >
                        @else
                        <img id="user-photo" width="170px" class="bevel-black" src="{{asset('/')}}images/Events/{{$records->event_image}}" >
                        @endif




                        <div class="form-group"  {{ $errors->has('event') ? ' has-error' : '' }}>
                            <label>Image</label>

                            <div class="{{ $errors->has('event') ? ' has-error' : '' }}">
                                <div class="input-group {{ $errors->has('event') ? ' has-error' : '' }}">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary" onclick="$('#dasd').trigger('click');">
                                            Browse
                                        </span>

                                    </label>
                                    <input id="fileinput" type="text" class="form-control" readonly="" value="@if(isset($records->event_image)) {{$records->event_image}} @endif ">

                                    <input type="file"  autocomplete="off" name="event" onchange="preview(event)" accept="image/*" value="@if(isset($records->event_image)) {{$records->event_image}} @endif " id="dasd" class="form-control"  style="display:none" />

                                </div>
                                @if ($errors->has('event'))
                                <span class="help-block m-b-none">
                                    <strong>{{ $errors->first('event') }}</strong>
                                </span>
                                @endif


                            </div>

                        </div>


                    </div>
                </div>

            </div>


        </div>

        @if(!empty($records->id))
        <button type="submit" class="btn btn-warning">Update Event</button>
        @else
        <button type="submit" class="btn btn-success">Add Event</button>
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