@extends('Layouts.app')

@section('content')
<link href="{{asset('/')}}css/add-user.css" rel="stylesheet">
<div class="page-header" >

    <div class="page-header-content">
        <div class="page-title" style="margin-top:-10px;margin-bottom:-10px">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Open</span> - Create Special Closing Dates</h4>
        </div>
    </div>

    <div class="breadcrumb-line" >
        <ul class="breadcrumb">
            <li><a href="/admin/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/open">Open</a></li>
            <li class="active">Create Special Closing Dates</li>
        </ul>
    </div>
</div>
<style>
    #productcoffee{
        border-color: #fff;
    }
</style>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #e20d1b;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #e20d1b;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>


<div class="content  animated fadeInRight">
    <form id="addcoffee" method="post" enctype="multipart/form-data" action="{{url('admin/addclose')}}">
        <div class="panel panel-flat">
            <div class="panel-body">

                {{ csrf_field() }}
                <div class="row">

                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-copy position-left"></i> Basics details</legend>
                            <div class="row">
                                <div class="col-md-12 {{ $errors->has('date') ? ' has-error' : '' }}">
                                    <label >Date </label>

                                    <input type="date" class="form-control" placeholder="Enter date" name="date" id="date"
                                           @if($errors->any())
                                           value="{{old('date')}}""
                                           @elseif(!empty($records->date))
                                           value="{{$records->date}}"
                                           @endif />

                                           @if ($errors->has('date'))
                                           <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12 {{ $errors->has('reason') ? ' has-error' : '' }}">
                                    <label  style="padding-top:10px">Reason </label>

                                    <input type="text" class="form-control" placeholder="Enter Reason" name="reason" id="reason"
                                           @if($errors->any())
                                           value="{{old('reason')}}""
                                           @elseif(!empty($records->reason))
                                           value="{{$records->reason}}"
                                           @endif />

                                           @if ($errors->has('reason'))
                                           <span class="help-block m-b-none">
                                        <strong>{{ $errors->first('reason') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            @if(!empty($records->full))
                            <div class="col-md-12 " style=" padding-top: 10px;display: flex;align-items: center;padding-left:0px">
                                <label  style="padding-right:10px">Full day Closed  </label>
                                <label class="switch">
                                    <input id="full" type="checkbox" name="full" value="1" onclick="myFunction()" {{ $records->full==1 ? ' checked' : '' }}@if($errors->any())
                                    @elseif(!empty($records->full))
                                    @if($records->full==0) checked @endif
                                    @endif 
                                    >
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            @else
                            <div class="col-md-12 " style="padding-top: 10px;display: flex;align-items: center;padding-left:0px">
                                <label style="padding-right:10px">Full day Closed  </label>
                                <label class="switch">
                                    <input id="full" type="checkbox" name="full" value="1" onclick="myFunction()">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            @endif

                            <div id="duration">
                                <div class="row">
                                    <div class="col-md-12 {{ $errors->has('open') ? ' has-error' : '' }}">
                                        <label  style="padding-top:0px">Open time </label>

                                        <input type="time" class="form-control" placeholder="Enter open time" name="open" id="open"
                                               @if($errors->any())
                                               value="{{old('open')}}""
                                               @elseif(!empty($records->open))
                                               value="{{$records->open}}"
                                               @endif />

                                               @if ($errors->has('open'))
                                               <span class="help-block m-b-none">
                                            <strong>{{ $errors->first('open') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12 {{ $errors->has('close') ? ' has-error' : '' }}">
                                        <label  style="padding-top:10px">Close time </label>

                                        <input type="time" class="form-control" placeholder="Enter close time" name="close" id="close"
                                               @if($errors->any())
                                               value="{{old('close')}}""
                                               @elseif(!empty($records->close))
                                               value="{{$records->close}}"
                                               @endif />

                                               @if ($errors->has('close'))
                                               <span class="help-block m-b-none">
                                            <strong>{{ $errors->first('close') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

        </div>

        <div class="row" >
            <div class="col-md-12">
                @if(!empty($records->id))
                <button type="submit" class="btn btn-warning">Update</button>
                @else
                <button type="submit" class="btn btn-success">Add</button>
                @endif

                <button type="reset" name="reset" class="btn btn-danger" onclick="myFunction2()">
                    <i class="glyphicon glyphicon-trash"></i>
                    Clear</button>
                @if(!empty($records->id))
                <input type="hidden" name="id" value="{{$records->id}}">
                @endif


            </div>
        </div>
    </form>
</div>

<script>

    window.onload = (event) => {
        var checkBox = document.getElementById("full");
        var text = document.getElementById("duration");
        var open = document.getElementById("open");
        var close = document.getElementById("close");
        if (checkBox.checked == true) {
            text.style.display = "none";
            open.valueAsDate = null;
            close.valueAsDate = null;
        } else {
            text.style.display = "block";
        }
    };

    function myFunction() {
        var checkBox = document.getElementById("full");
        var text = document.getElementById("duration");
        var open = document.getElementById("open");
        var close = document.getElementById("close");
        if (checkBox.checked == true) {
            text.style.display = "none";
            open.valueAsDate = null;
            close.valueAsDate = null;
        } else {
            text.style.display = "block";
        }
    }

    function myFunction2() {
        var text = document.getElementById("duration");
        text.style.display = "block";
    }
</script>

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