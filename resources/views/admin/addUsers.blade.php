@extends('admin.layouts.home')

@section('content')
<link href="{{asset('/')}}css/add-user.css" rel="stylesheet">
<style>
    #productcoffee{
        border-color: #fff;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add/Edit Customers</h5>
                </div>
                <div class="ibox-content">
                    <form id="addcoffee" method="post" enctype="multipart/form-data" action="{{url('admin/customers')}}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                    <?php $path='images/users/'; ?>
                                    <img id="user-photo" class="bevel-black" src="{{asset('/')}}images/upload.png" >

                            </div>
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <label>User Image</label>
                                    <div class="{{ $errors->has('frame') ? ' has-error' : '' }}">
                                        <div class="input-group">
                                            <label class="input-group-btn">
                                                <span class="btn btn-primary" onclick="$('#dasd').trigger('click');">
                                                    Browse 
                                                </span>

                                            </label>
                                            <input id="fileinput" type="text" class="form-control" readonly="" value="@if(isset($records->img)) {{$records->img}} @endif ">

                                            <input type="file"  autocomplete="off" name="user" onchange="preview(event)" accept="image/*" value="@if(isset($records->img)) {{$records->img}} @endif " id="dasd" class="form-control"  style="display:none" />

                                        </div>
                                        @if ($errors->has('frame'))
                                        <span class="help-block m-b-none">
                                            <strong>{{ $errors->first('frame') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <label >Customer Name </label>
                                        <input type="text"  autocomplete="off" name="name" id="name"  class="form-control"  
                                                   @if($errors->any())
                                                   value="{{old('name')}}"" 
                                                   @elseif(!empty($records->name)) 
                                                   value="{{$records->name}}" 
                                                   @endif />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label >E-Mail</label>
                                        <input type="text"  autocomplete="off" name="email" id="email"  class="form-control"  
                                                   @if($errors->any())
                                                   value="{{old('name')}}"" 
                                                   @elseif(!empty($records->email)) 
                                                   value="{{$records->email}}" 
                                                   @endif />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label >Mobile Number</label>
                                        <input type="text"  autocomplete="off" name="mobile_no" id="mobile_no"  class="form-control"  
                                                   @if($errors->any())
                                                   value="{{old('name')}}"" 
                                                   @elseif(!empty($records->mobile_no)) 
                                                   value="{{$records->mobile_no}}" 
                                                   @endif />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                    <label >Status </label>
                                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                            <div>
                                                <select name="status" id="status"  class="form-control">  
                                                    <option value="">--Select--</option>
                                                    <option 
                                                    @if (!empty($records->status)) value="{{$records->status}}"@endif 
                                                    @if(!empty($records->status) && $records->status == '0') selected @endif>
                                                    Active
                                                    </option>
                                                    <option 
                                                    @if (!empty($records->status)) value="{{$records->status}}"@endif 
                                                    @if(!empty($records->status) && $records->status == '1') selected @endif>
                                                    Blacklist
                                                    </option>
                                                    
                                                </select>
                                        </div>
                                        @if ($errors->has('status'))
                                        <span class="help-block m-b-none">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="">
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <button class="btn btn-sm btn-primary" type="submit">Save</button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    @if(!empty($records->id))
                    <input type="hidden" name="id" value="{{$records->id}}">
                    @endif
                </form>
            </div>

        </div>


        </div>
    </div>
</div>
<script>
    // var coffeeurl = '@if(isset($records)) {{asset("images/users/".$records->name)}} @endif';
    $("#dasd").on("change", function(){
    var files = !!this.files ? this.files : [];
    if (!files.length || !window.FileReader) return;
    $('#fileinput').val(this.files.length ? this.files[0].name : '');
    if (/^image/.test(files[0].type)) {
    var reader = new FileReader();
    reader.readAsDataURL(files[0]);
    reader.onloadend = function(){

    coffeeurl = this.result;
    }
    }
    });
    
    
</script>
<script type="text/javascript">
    function preview(event){
        var selectedFile = event.target.files[0];
        var reader = new FileReader();
        var imgtag = document.getElementById("user-photo");
        reader.onload = function(event) {
            imgtag.src = event.target.result;
        };
        reader.readAsDataURL(selectedFile);
    }
</script>

@endsection 