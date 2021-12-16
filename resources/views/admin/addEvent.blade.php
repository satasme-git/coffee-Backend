@extends('Layouts.app')

@section('content')

<div class="page-header" >

    <div class="page-header-content">
        <div class="page-title" style="margin-top:-10px;margin-bottom:-10px">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Event</span> - Create event</h4>
        </div>
    </div>

    <div class="breadcrumb-line" >
        <ul class="breadcrumb">
            <li><a href="/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/view_user">Event</a></li>
            <li class="active">Create Event</li>
        </ul>
    </div>
</div>

<div class="content  animated fadeInRight">
    <form id="addcoffee" method="post" enctype="multipart/form-data" action="{{url('admin/events2')}}">
        <div class="panel panel-flat">
            <div class="panel-body">

                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-image2 position-left"></i> Image details</legend>
                            <?php $path = 'images/Events/'; ?>
                            @if(empty($records->event_image))
                            <img id="user-photo" class="bevel-black" src="{{asset('/')}}images/upload.png" width="300px">
                            @else
                            <img id="user-photo" class="bevel-black" src="{{asset('/')}}images/Events/{{$records->event_image}}" width="300px">
                            @endif
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-copy position-left"></i> Basics details</legend>
                            <div class="{{ $errors->has('event') ? ' has-error' : '' }}">
                            <label >Image </label>
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
                        </fieldset>

                        <div class="row">
                            <div class="col-md-12 {{ $errors->has('title') ? ' has-error' : '' }}"style="margin-top:15px">
                                <label >Event title </label>
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


                            </div>
                        </div>
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