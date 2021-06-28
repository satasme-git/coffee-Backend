@extends('admin.layouts.home')

@section('content')
<link href="{{asset('/')}}css/add-coffee.css" rel="stylesheet">
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
                    <h5>Add/Edit Food</h5>
                </div>
                <div class="ibox-content">
                    <form id="addcoffee" method="post" enctype="multipart/form-data" action="{{url('admin/food')}}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                               
                            <?php $path='images/food/'; ?>
                                    <img id="coffee-photo" class="bevel-black" src="{{asset('/')}}images/upload.png" 
                                            @if($errors->any())
                                                   value="{{old('food-photo')}}"" 
                                                   @elseif(!empty($food->img)) 
                                                   src="{{asset($path.$food->img)}}"
                                                   @endif >

                            </div>
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <label>Food Image</label>
                                    <div class="{{ $errors->has('frame') ? ' has-error' : '' }}">
                                        <div class="input-group">
                                            <label class="input-group-btn">
                                                <span class="btn btn-primary" onclick="$('#dasd').trigger('click');">
                                                    Browse 
                                                </span>

                                            </label>
                                            <input id="fileinput" type="text" class="form-control" readonly="" value="@if(isset($food->img)) {{$food->img}} @endif ">

                                            <input type="file"  autocomplete="off" name="food" onchange="preview(event)" accept="image/*" value="@if(isset($food->img)) {{$food->img}} @endif " id="dasd" class="form-control"  style="display:none" />

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
                                        <label >Coffee Name </label>
                                        <input type="text"  autocomplete="off" name="name" id="name"  class="form-control"  
                                                   @if($errors->any())
                                                   value="{{old('name')}}"" 
                                                   @elseif(!empty($food->name)) 
                                                   value="{{$food->name}}" 
                                                   @endif />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label >Category </label>
                                        <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                                            <div>
                                                <select name="category" id="category"  class="form-control">  
                                                    <option value="">--Select--</option>
                                                    @foreach($category as $categories)
                                                    <option value="{{$categories->id}}"
                                                            @if($errors->any() && old('category') == $categories->id)
                                                            selected
                                                            @elseif(!empty($food->category_id) && $food->category_id == $categories->id) 
                                                            selected
                                                            @endif 
                                                            >{{$categories->name}}
                                                </option>
                                                @endforeach
                                                 
                                            </select>
                                        </div>
                                        @if ($errors->has('category'))
                                        <span class="help-block m-b-none">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <label >Sub Category </label>
                                        <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                                            <div>
                                                <select name="subcategory" id="subcategory"  class="form-control">  
                                                    <option value="">--Select--</option>
                                                    @foreach($subcategory as $categories)
                                                    <option value="{{$categories->id}}"
                                                            @if($errors->any() && old('subcategory') == $categories->id)
                                                            selected
                                                            @elseif(!empty($food->subcategory_id) && $food->subcategory_id == $categories->id) 
                                                            selected
                                                            @endif 
                                                            >{{$categories->name}}
                                                </option>
                                                @endforeach
                                                 
                                            </select>
                                        </div>
                                        @if ($errors->has('subcategory'))
                                        <span class="help-block m-b-none">
                                            <strong>{{ $errors->first('subcategory') }}</strong>
                                        </span>
                                        @endif
                                </div>

                                
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                        <label>Description</label>
                                        <div>
                                            <input type="text"  autocomplete="off" name="description" id="description"  class="form-control"  
                                                   @if($errors->any())
                                                   value="{{old('description')}}"" 
                                                   @elseif(!empty($food->description)) 
                                                   value="{{$food->description}}" 
                                                   @endif />
                                        </div>
                                        @if ($errors->has('title'))
                                        <span class="help-block m-b-none">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                                        <label>Price</label>
                                        <div>
                                            <input type="number"  autocomplete="off" name="price" id="price"  class="form-control"  
                                                   @if($errors->any())
                                                   value="{{old('price')}}"" 
                                                   @elseif(!empty($food->price)) 
                                                   value="{{$food->price}}" 
                                                   @endif />
                                        </div>
                                        @if ($errors->has('price'))
                                        <span class="help-block m-b-none">
                                            <strong>{{ $errors->first('price') }}</strong>
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
                    @if(!empty($food->id))
                    <input type="hidden" name="id" value="{{$food->id}}">
                    @endif
                </form>
            </div>

        </div>


    </div>
</div>
</div>
<script>
    var coffeeurl = '@if(isset($food)) {{asset("images/food/".$food->img)}} @endif';
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
        var imgtag = document.getElementById("coffee-photo");
        reader.onload = function(event) {
            imgtag.src = event.target.result;
        };
        reader.readAsDataURL(selectedFile);
    }
</script>

@endsection 