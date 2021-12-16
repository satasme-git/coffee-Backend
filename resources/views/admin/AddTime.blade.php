@extends('Layouts.app')
@section('content')
<section class="content-header">
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
    <div class="page-header" >

        <div class="page-header-content">
            <div class="page-title" style="margin-top:-10px;margin-bottom:-10px">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Open</span> - Show open details</h4>
            </div>
        </div>

        <div class="breadcrumb-line" >
            <ul class="breadcrumb">
                <li><a href="/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
                <li><a href="{{url('admin/open')}}">Open</a></li>
                <li class="active">Show open details</li>
            </ul>
        </div>
    </div>



    <div class="content  animated fadeInRight">

        <div class="panel panel-flat">
            <div class="panel-body">	

                <div class="row" style="background-color:white">
                    <div class="">
                        <div class="ibox-content" style="padding-top: 5px; padding-bottom: 5px;font-weight:bold">
                            <div class="col-md-2" >Day</div>
                            <div class="col-md-3" >Open at</div>
                            <div class="col-md-3" >Close at </div>
                            <div class="col-md-2" >Closed</div>
                            <div class="col-md-2" ></div>
                        </div>
                    </div>
                </div>
                @foreach($days as $day)

                <form action="{{url('admin/editopentime')}}" method="POST" >
                    {{csrf_field()}}
                    <div class="row" style="background-color:white">

                        <div class="ibox float-e-margins">
                            <div class="ibox-content" >
                                <div class="col-md-2"> {{$day->day}}</div>
                                <div class="col-md-3">


                                    <div class="form-group" {{ $errors->has('open') ? ' has-error' : '' }}>
                                        <input type="time" class="form-control" placeholder="Enter date of birth" name="open" id="open"
                                               @if($errors->any())
                                               value="{{old('open')}}"
                                               @elseif(!empty($day->open))
                                               value="{{$day->open}}"
                                               @endif />

                                               @if ($errors->has('open'))
                                               <span class="help-block">
                                            <strong style="color: #ff0000">{{ $errors->first('open') }}</strong>
                                        </span>
                                        @endif
                                    </div>  


                                </div>

                                <div class="col-md-3">


                                    <div class="form-group" {{ $errors->has('close') ? ' has-error' : '' }}>
                                        <input type="time" class="form-control" placeholder="Enter date of birth" name="close" id="close"
                                               @if($errors->any())
                                               value="{{old('close')}}"
                                               @elseif(!empty($day->close))
                                               value="{{$day->close}}"
                                               @endif />

                                               @if ($errors->has('close'))
                                               <span class="help-block">
                                            <strong style="color: #ff0000">{{ $errors->first('close') }}</strong>
                                        </span>
                                        @endif
                                    </div>  


                                </div>
                                <input type="hidden" id="id" name="id" value="{{$day->id}}">

                                <div class="col-md-2">
                                    <label class="switch">
                                        <input type="checkbox" name="status" value="{{$day->status}}" {{ $day->status==0 ? ' checked' : '' }}
                                        @if($errors->any())
                                        @elseif(!empty($day->status))
                                        @if($day->status==0) checked @endif
                                        @endif >
                                        <span class="slider round"></span>
                                    </label>
                                </div>

                                <div class="col-md-2"><input type="submit" class="btn btn-primary" value="Update"></div>

                            </div>
                        </div>

                    </div>

                </form>
                @endforeach

            </div>
        </div>
    </div>
    @endsection
