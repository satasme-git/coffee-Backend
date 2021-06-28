@extends('admin.layouts.app2')

@section('content')
<link href="{{ asset('css/plugins/dataTables/datatables.css')}}">
<link href="{{URL::asset('')}}css/admin/animate.css" rel="stylesheet">
<section class="content-header" >
    <h1>
        Food
        <small>add/edit food</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/admin/food')}}">foods</a></li>
        <li class="active">add/edit box</li>
    </ol>
</section>

<section class="content  animated fadeInRight">
    <form id="addcoffee" method="post" enctype="multipart/form-data" action="{{url('admin/food')}}">
        {{ csrf_field() }}
        <div class="row">


            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Basic details</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}" >

                            <label >Food Name </label>
                            <input type="text"  autocomplete="off" name="name" id="name"  placeholder="Enter Food Name"  class="form-control"
                                   @if($errors->any())
                                   value="{{old('name')}}""
                                   @elseif(!empty($food->name))
                                   value="{{$food->name}}"
                                   @endif />

                        </div>
                        <div class="form-group {{ $errors->has('subcategory') ? ' has-error' : '' }}" >
                            <label >Sub Category </label>

                            <select name="subcategory" id="subcategory"   class="form-control dynamic2">
                                <option value="">--Select Sub category--</option>
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

                        @if ($errors->has('subcategory'))
                        <span class="help-block m-b-none">
                            <strong>{{ $errors->first('subcategory') }}</strong>
                        </span>
                        @endif


                    </div>
                    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}" >

                        <label>Description</label>
                        <div>
                            <textarea class="form-control" id="description" rows="3" name="description" placeholder="Enter  Description">@if($errors->any()){{old('description')}}@elseif(!empty($food->description)){{$food->description}}@endif</textarea>


                        </div>
                        @if ($errors->has('description'))
                        <span class="help-block m-b-none">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div id="price"  class="form-group {{ $errors->has('price') ? ' has-error' : '' }}" >
                        <label>Price (small)</label>
                        <div>
                            <input type="number"  autocomplete="off" name="price" id="price"  class="form-control" placeholder="Enter Price "
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
        </div>


        <div class="col-md-6">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Other details</h3>
                </div>
                <div class="box-body">

                    <?php $path = 'images/food/'; ?>
                    @if(empty($food->img))
                    <img id="coffee-photo" width="200px" class="bevel-black" src="{{asset('/')}}images/upload.png" >
                    @else
                    <img id="coffee-photo" width="200px" class="bevel-black" src="{{asset('/')}}images/food/{{$food->img}}" >
                    @endif




                    <div class="form-group {{ $errors->has('food') ? ' has-error' : '' }}"  >
                        <label>Image</label>
                        <div class="{{ $errors->has('food') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-primary" onclick="$('#dasd').trigger('click');">
                                        Browse
                                    </span>

                                </label>
                                <input id="fileinput" type="text" class="form-control" readonly="" value="@if(isset($food->img)) {{$food->img}} @endif ">

                                <input type="file"  autocomplete="off" name="food" onchange="preview(event)" accept="image/*" value="@if(isset($food->img)) {{$food->img}} @endif " id="dasd" class="form-control"  style="display:none" />

                            </div>
                            @if ($errors->has('food'))
                            <span class="help-block m-b-none">
                                <strong>{{ $errors->first('food') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>


    <div class="row coffe_sizes" >
        <div class="col-md-6">
            <div class="box box-warning">
                <!-- <div class="box-header with-border">
                    <h3 class="box-title">Other details</h3>
                </div> -->
                <div class="box-body">
                    <div class="col-md-4 form-group {{ $errors->has('small') ? ' has-error' : '' }}" >

                        <label>Small</label>
                        <div>
                            <input type="number" step="any"  autocomplete="off" name="small" id="small" class="form-control" placeholder="Enter Price "
                                   @if($errors->any())
                                   value="{{old('small')}}""
                                   @elseif(!empty($sizes->small))
                                   value="{{$sizes->small}}"
                                   @else
                                   value="{{0}}"
                                   @endif />
                        </div>
                        @if ($errors->has('small'))
                        <span class="help-block m-b-none">
                            <strong>{{ $errors->first('small') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-4 form-group {{ $errors->has('medium') ? ' has-error' : '' }}" >

                        <label>Medium</label>
                        <div>
                            <input type="number" step="any"  autocomplete="off" name="medium" id="medium"  class="form-control" placeholder="Enter Price "
                                   @if($errors->any())
                                   value="{{old('medium')}}""
                                   @elseif(!empty($sizes->medium))
                                   value="{{$sizes->medium}}"
                                   @else
                                   value="{{0}}"
                                   @endif />
                        </div>
                        @if ($errors->has('medium'))
                        <span class="help-block m-b-none">
                            <strong>{{ $errors->first('medium') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-4 form-group {{ $errors->has('large') ? ' has-error' : '' }}" >

                        <label>Large</label>
                        <div>
                            <input type="number" step="any" autocomplete="off" name="large" id="large"  class="form-control" placeholder="Enter Price "
                                   @if($errors->any())
                                   value="{{old('large')}}""
                                   @elseif(!empty($sizes->large))
                                   value="{{$sizes->large}}"
                                   @else
                                   value="{{0}}"
                                   @endif />
                        </div>
                        @if ($errors->has('large'))
                        <span class="help-block m-b-none">
                            <strong>{{ $errors->first('large') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group " >
                        <label for="state">Milk Pricess</label>

                        <div class="col-md-12" style="background-color: #e0e0e0;padding-top:10px">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('fullCream') ? ' has-error' : '' }}" >

                                        <label>Full cream</label>
                                        <div>
                                            <input type="number" step="any" autocomplete="off" name="fullCream" id="fullCream"  class="form-control" placeholder="Enter Price "
                                                   @if($errors->any())
                                                   value="{{old('full_cream')}}""
                                                   @elseif(!empty($topins->full_cream))
                                                   value="{{$topins->full_cream}}"
                                                   @else
                                   value="{{0}}"
                                                   @endif />
                                        </div>
                                        @if ($errors->has('fullCream'))
                                        <span class="help-block m-b-none">
                                            <strong style="font-size:11px">{{ $errors->first('fullCream') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('skim') ? ' has-error' : '' }}" >

                                        <label>Skim</label>
                                        <div>
                                            <input type="number" step="any" autocomplete="off" name="skim" id="skim"  class="form-control" placeholder="Enter Price "
                                                   @if($errors->any())
                                                   value="{{old('skim')}}""
                                                   @elseif(!empty($topins->skim))
                                                   value="{{$topins->skim}}"
                                                   @else
                                   value="{{0}}"
                                                   @endif />
                                        </div>
                                        @if ($errors->has('skim'))
                                        <span class="help-block m-b-none">
                                            <strong style="font-size:11px">{{ $errors->first('skim') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('soy') ? ' has-error' : '' }}" >

                                        <label>Soy</label>
                                        <div>
                                            <input type="number" step="any" autocomplete="off" name="soy" id="soy"  class="form-control" placeholder="Enter Price "
                                                   @if($errors->any())
                                                   value="{{old('soy')}}""
                                                   @elseif(!empty($topins->soy))
                                                   value="{{$topins->soy}}"
                                                   @else
                                   value="{{0}}"
                                                   @endif />
                                        </div>
                                        @if ($errors->has('soy'))
                                        <span class="help-block m-b-none">
                                            <strong style="font-size:11px">{{ $errors->first('soy') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('almond') ? ' has-error' : '' }}" >

                                        <label>Almond</label>
                                        <div>
                                            <input type="number" step="any"  autocomplete="almond" name="almond" id="almond"  class="form-control" placeholder="Enter Price "

                                                   @if($errors->any())
                                                   value="{{old('almond')}}""
                                                   @elseif(!empty($topins->almond))
                                                   value="{{$topins->almond}}"
                                                   @else
                                   value="{{0}}"
                                                   @endif />
                                        </div>
                                        @if ($errors->has('almond'))
                                        <span class="help-block m-b-none">
                                            <strong style="font-size:11px">{{ $errors->first('almond') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('oat') ? ' has-error' : '' }}" >

                                        <label>Oat</label>
                                        <div>
                                            <input type="number" step="any"  autocomplete="off" name="oat" id="oat"  class="form-control" placeholder="Enter Price "
                                                   @if($errors->any())
                                                   value="{{old('oat')}}"
                                                   @elseif(!empty($topins->oat))
                                                   value="{{$topins->oat}}"
                                                   @else
                                   value="{{0}}"
                                                   @endif />
                                        </div>
                                        @if ($errors->has('oat'))
                                        <span class="help-block m-b-none">
                                            <strong style="font-size:11px">{{ $errors->first('oat') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @if(!empty($food->id))
    <button type="submit" class="btn btn-warning">Update fod</button>
    @else
    <button type="submit" class="btn btn-success">Add food</button>
    @endif

    <button type="reset" name="reset" class="btn btn-danger">
        <i class="glyphicon glyphicon-trash"></i>
        Clear</button>
    @if(!empty($food->id))
    <input type="hidden" name="id" value="{{$food->id}}">
    @endif


</form>

</section>
<script src="{{ asset('AdminLTE2/bower_components//jquery/dist/jquery.min.js')}}"></script>
<script>
                                    var coffeeurl = '@if(isset($food)) {{asset("images/food/".$food->img)}} @endif';
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
        var imgtag = document.getElementById("coffee-photo");
        reader.onload = function (event) {
            imgtag.src = event.target.result;
        };
        reader.readAsDataURL(selectedFile);
    }
    function myFunction() {

        var value = document.getElementById("subcategory").value;
        if (value == 1) {
            $(".coffe_sizes").show();
            $("#price").hide();
        } else {
            $(".coffe_sizes").hide();
            $("#price").show();
        }

      
    }
</script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {


        $('.dynamic2').change(function () {


            if ($(this).val() != '') {
                var select = $(this).attr("id");

                var value = $(this).val();

                if (value == 1) {
                    $(".coffe_sizes").show();
                    $("#price").hide();
                } else {
                    $(".coffe_sizes").hide();
                    $("#price").show();
                }



            }


        });
    });


</script>

@endsection