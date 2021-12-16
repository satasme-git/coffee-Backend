@extends('Layouts.app')

@section('content')
<link href="{{asset('/')}}css/add-coffee.css" rel="stylesheet">
<div class="page-header" >

    <div class="page-header-content">
        <div class="page-title" style="margin-top:-10px;margin-bottom:-10px">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Food</span> - Create food</h4>
        </div>
    </div>

    <div class="breadcrumb-line" >
        <ul class="breadcrumb">
            <li><a href="/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/view_user">Food</a></li>
            <li class="active">Create Food</li>
        </ul>
    </div>
</div>
<div class="content  animated fadeInRight">
    <form id="addcoffee" method="post" enctype="multipart/form-data" action="{{url('admin/food')}}">
        <div class="panel panel-flat">
            <div class="panel-body">




                {{ csrf_field() }}
                <div class="row">

                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-copy position-left"></i> Basics details</legend>



                            <div class="form-group {{ $errors->has('frame') ? ' has-error' : '' }}" >

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
                                <textarea class="form-control" id="description" rows="4" name="description" placeholder="Enter  Description"> @if($errors->any()){{old('description')}}@elseif(!empty($food->description)){{$food->description}}@endif </textarea>


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
                        @if(!empty($food->subcategory_id))
                        @if(!empty($food->subcategory_id==1))

                        <div class="row coffe_sizes" >
                            <div style="background-color: green;">
                                <div class="col-md-4">

                                    <div class="form-group {{ $errors->has('small') ? ' has-error' : '' }}" >

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
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group {{ $errors->has('medium') ? ' has-error' : '' }}" >

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
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group {{ $errors->has('large') ? ' has-error' : '' }}" >

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
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="" >
                                        <label for="state">Milk Pricess</label>

                                        <div class="col-md-12" style="background-color: #e0e0e0;padding-top:10px">

                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('full_cream') ? ' has-error' : '' }}" >

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
                                                    @if ($errors->has('full_cream'))
                                                    <span class="help-block m-b-none">
                                                        <strong>{{ $errors->first('full_cream') }}</strong>
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
                                                        <strong>{{ $errors->first('skim') }}</strong>
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
                                                        <strong>{{ $errors->first('soy') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
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
                                                        <strong>{{ $errors->first('almond') }}</strong>
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
                                                        <strong>{{ $errors->first('oat') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @else

                        <div class="row coffe_sizes" >
                            <div style="background-color: green;">
                                <div class="col-md-4">

                                    <div class="form-group {{ $errors->has('small') ? ' has-error' : '' }}" >

                                        <label>Small</label>
                                        <div>
                                            <input type="number" step="any"  autocomplete="off" name="small" id="small"  class="form-control" placeholder="Enter Price "
                                                   @if($errors->any())
                                                   value="{{old('small')}}""
                                                   @elseif(!empty($sizes->small))
                                                   value="{{$sizes->small}}"
                                                   @endif />
                                        </div>
                                        @if ($errors->has('small'))
                                        <span class="help-block m-b-none">
                                            <strong>{{ $errors->first('small') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group {{ $errors->has('medium') ? ' has-error' : '' }}" >

                                        <label>Medium</label>
                                        <div>
                                            <input type="number" step="any" autocomplete="off" name="medium" id="medium"  class="form-control" placeholder="Enter Price "
                                                   @if($errors->any())
                                                   value="{{old('medium')}}""
                                                   @elseif(!empty($sizes->medium))
                                                   value="{{$sizes->medium}}"
                                                   @endif />
                                        </div>
                                        @if ($errors->has('medium'))
                                        <span class="help-block m-b-none">
                                            <strong>{{ $errors->first('medium') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group {{ $errors->has('large') ? ' has-error' : '' }}" >

                                        <label>Large</label>
                                        <div>
                                            <input type="number" step="any" autocomplete="off" name="large" id="large"  class="form-control" placeholder="Enter Price "
                                                   @if($errors->any())
                                                   value="{{old('large')}}""
                                                   @elseif(!empty($sizes->large))
                                                   value="{{$sizes->large}}"
                                                   @endif />
                                        </div>
                                        @if ($errors->has('large'))
                                        <span class="help-block m-b-none">
                                            <strong>{{ $errors->first('large') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="" >
                                        <label for="state">Milk Pricess</label>

                                        <div class="col-md-12" style="background-color: #e0e0e0;padding-top:10px">

                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('full_cream') ? ' has-error' : '' }}" >

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
                                                    @if ($errors->has('full_cream'))
                                                    <span class="help-block m-b-none">
                                                        <strong>{{ $errors->first('full_cream') }}</strong>
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
                                                        <strong>{{ $errors->first('skim') }}</strong>
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
                                                        <strong>{{ $errors->first('soy') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('almond') ? ' has-error' : '' }}" >

                                                    <label>Almond</label>
                                                    <div>
                                                        <input type="number" step="any" autocomplete="almond" name="almond" id="almond"  class="form-control" placeholder="Enter Price "

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
                                                        <strong>{{ $errors->first('almond') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('oat') ? ' has-error' : '' }}" >

                                                    <label>Oat</label>
                                                    <div>
                                                        <input type="number" step="any" autocomplete="off" name="oat" id="oat"  class="form-control" placeholder="Enter Price "
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
                                                        <strong>{{ $errors->first('oat') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </fieldset>
                </div> 
                <div class="col-md-6">

                    <fieldset>
                        <legend class="text-semibold"><i class="icon-image2 position-left"></i> Image details</legend>

                        <div class="form-group  {{ $errors->has('img') ? ' has-error' : '' }}" >
                            <?php $path = 'images/food/'; ?>
                            <img id="coffee-photo" class="bevel-black" src="{{asset('/')}}images/upload.png" width="150px"
                                 @if($errors->any())
                                 value="{{old('img')}}""
                                 @elseif(!empty($food->img))
                                 src="{{asset($path.$food->img)}}"
                                 @endif >


                        </div>




                        <div class="form-group {{ $errors->has('frame') ? ' has-error' : '' }}" >

                            <label >Food Name </label>
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


                    </fieldset>
                </div>
                @if(!empty($food->id))
                <input type="hidden" name="id" value="{{$food->id}}">
                @endif

            </div>


            <br/>
        </div>
    </div>
    @if(!empty($food->id))
    <button type="submit" class="btn btn-warning">Update Food</button>
    @else
    <button type="submit" class="btn btn-success">Add Food</button>
    @endif

    <button type="reset" name="reset" class="btn btn-danger">
        <i class="glyphicon glyphicon-trash"></i>
        Clear</button>
</form>
</div>
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
</script>




<script type="text/javascript">

    $(document).ready(function () {


        $('.dynamic2').change(function () {


            if ($(this).val() != '') {
                var select = $(this).attr("id");

                var value = $(this).val();
// alert("sssssssssssss : "+value);
                if (value == 1) {
                    $(".coffe_sizes").show();
                    $("#price").hide();
                    // var oust=document.getElementById("oust").value;
                    // var installemt_val=parseFloat(oust)/6

                    // document.getElementById("inst").value=installemt_val;
                } else {
                    // document.getElementById("inst").value=0;
                    $(".coffe_sizes").hide();
                    $("#price").show();
                }



            }


        });
    });


</script>
@endsection