@extends('Layouts.app_pos')

@section('content')
<!-- <link href="{{url('/')}}/css/dataTables/datatables.css"> -->
<style>

</style>

<!-- Content area -->
<div class="content">

    <!-- 2 columns form -->


    <div class="col-md-5" >
        <div class="panel panel-flat" style="background-color:#eceff1">
            <div class="panel-body">
                <div class="row" >
                    <div class="col-md-12" >

                    <div class="form-group {{ $errors->has('customer_name') ? ' has-error' : '' }}">
      
                                <label>Select Customer:</label>
                                <select id="aioConceptName" data-placeholder="Select Username"  class="form-control select"  id="customer_name" name="customer_name" >
                                    <option id="aaaa"></option>
                                    @foreach($users as $user)
                                    <option  @if( $user->id==Session::get('customer_id')) selected  @endif value="{{$user->id}}"  >{{$user->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('customer_name'))
                                <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('customer_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        <div class="table-responsive"  style="height: 350px;background-color:#fff">

                            <table class="  table table-striped table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th width="5" style="padding:2px">#Id</th>
                                        <th  width="200" style="padding:2px">Name</th>
                                        <th  width="5" style="padding:2px">Quantity</th> 
                                        <th  width="5" style="padding:2px">Size</th>                         
                                        <th  width="5" style="padding:2px">Price</th>                       

                                        <th  width="5" style="padding:2px">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_body">

                                </tbody>

                            </table>

                        </div>

                        <!-- <div class="panel-body"> -->
                        <div class="row invoice-payment" style="margin-top:10px">
                            <div class="col-sm-5">
                                <div class="content-group">

                                    <!-- <div class="mb-15 mt-15">
                                      
                                        <p>Discount</p>
                                        <input type="text" id="discount_rate" class="form-control" placeholder="Enter discount rate" onkeyup ="createDiscount();"/>
                                    </div> -->

                                    <!-- <ul class="list-condensed list-unstyled text-muted">
                                        <li>Eugene Kopyov</li>
                                        <li>2269 Elba Lane</li>
                                        <li>Paris, France</li>
                                        <li>888-555-2311</li>
                                    </ul> -->
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="content-group">

                                    <div class="table-responsive no-border">
                                        <table class="table">

                                            <tr >
                                                <th style="padding-top:8px;padding-bottom:8px;color:black">Subtotal:</th>
                                                <input type="hidden" id="subtotal"/>
                                                <td id="p1" class="text-right" style="padding-top:8px;padding-bottom:8px;color:black"><span class="text-regular"></span>0.00</td>
                                            </tr>
                                            <tr>
                                                <th style="padding-top:8px;padding-bottom:8px;color:black">Discount: <span class="text-regular"></span></th>
                                                <td id="discount_value" class="text-right" style="padding-top:8px;padding-bottom:8px;color:black">0</td>
                                            </tr>
                                            <tr>
                                                <th style="padding-top:8px;padding-bottom:8px;color:black">Total:</th>
                                                <td id="gross_total" class="text-right text-primary" style="padding-top:8px;padding-bottom:8px;color:black"><h5 id="groos_tot" class="text-semibold;color:black"><span class="text-regular">$</span>0.00</h5></td>
                                            </tr>

                                        </table>
                                    </div>


                                </div>
                            </div>
                            <!-- </div> -->


                        </div>

                    </div>


                </div>

            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12"  >


                        <div class="row" >
                            <div id="products_div" class="table-responsive"  style="height: 440px">
                                @foreach($details as $detail)
                                <div class="col-lg-2 col-sm-4">
                                    <div class="thumbnail">
                                        <div class="thumb" style="padding:5px;">
                                            <img src="{{ asset('/images/food')}}/{{ $detail->img}}" alt="">
                                            <div class="caption-overflow">
                                                <span>
                                                <!-- <a href="assets/images/placeholder.jpg" data-popup="lightbox" onclick="abc({{$detail->id}});" data-toggle="modal" data-target="#modal_theme_custom" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a> -->
                                                    <a href="assets/images/placeholder.jpg" data-popup="lightbox" onclick="abc({{$detail->id}})" data-toggle="modal" data-target="#modal_theme_custom{{$detail->id}}" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                                                    <!-- <a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i class="icon-link2"></i></a> -->
                                                </span>
                                            </div>
                                        </div>

                                        <!-- <div style=""> -->
                                        <p style="padding-top: 5px;font-size:11px;margin-bottom:-5px;"><a href="#" style="color:black;"> {{ $detail->name}} </a></p>
                                        <!-- </div> -->
                                    </div>
                                </div>
                                <div id="modal_theme_custom{{$detail->id}}" class="modal fade">
                                    <div class="modal-dialog " style="width:55%">
                                        <div class="modal-content">
                                            <div class="modal-header bg-brown">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h6 class="modal-title">Product details</h6>
                                            </div>

                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Quantity:</label>
                                                            <input id='pro_qty{{$detail->id}}' type="number" class="form-control"  value="1" placeholder="Enter Quantity">
                                                            <input id='pro_id{{$detail->id}}' type="hidden" class="form-control" value="{{$detail->id}}" placeholder="Eugene Kopyov">

                                                        </div>
                                                        @if($detail->subcategory_id==1)
                                                        <div class="form-group">
                                                            <label class="text-semibold">Size</label>
                                                            <div class="row">
                                                                <div class="col-md-12">

                                                                    <form id="rates">
                                                                        <div class="radio col-md-4">
                                                                            <label>
                                                                                <input type="radio" name="size{{$detail->id}}" class="control-primary "  value="Small" checked="checked">

                                                                                <input type="hidden"  class="control-primary " id="small{{$detail->id}}" value="{{$detail->small}}">
                                                                                Small
                                                                            </label>
                                                                        </div>

                                                                        <div class="radio col-md-4" style="padding-top:8px">
                                                                            <label>
                                                                                <input type="radio" name="size{{$detail->id}}" class="control-danger" value="Medium">
                                                                                <input type="hidden"  class="control-primary " id="medium{{$detail->id}}" value="{{$detail->medium}}">
                                                                                Medium
                                                                            </label>
                                                                        </div>

                                                                        <div class="radio col-md-4" style="padding-top:8px">
                                                                            <label>
                                                                                <input type="radio" name="size{{$detail->id}}" class="control-success"  value="Large">
                                                                                <input type="hidden"  class="control-primary " id="large{{$detail->id}}" value="{{$detail->large}}">
                                                                                Large
                                                                            </label>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="text-semibold">Add Extra</label>
                                                            <div class="row">
                                                                <div class="col-md-6" id="rates"> 
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" id="icecream{{$detail->id}}" name="icecream" value="icecream" class="control-primary" >
                                                                            Ice cream
                                                                            <input type="hidden"  class="control-primary " id="_fullcream{{$detail->id}}" value="{{$detail->full_cream}}">
                                                                        </label>
                                                                    </div>

                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" id="skim{{$detail->id}}" name="skim" value="skim" class="control-danger" >
                                                                            <input type="hidden"  class="control-primary " id="_skim{{$detail->id}}" value="{{$detail->skim}}">
                                                                            Skim
                                                                        </label>
                                                                    </div>

                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" id="soy{{$detail->id}}" name="soy" value="soy" class="control-success" >
                                                                            <input type="hidden"  class="control-primary " id="_soy{{$detail->id}}" value="{{$detail->soy}}">
                                                                            Soy
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" id="almond{{$detail->id}}" name="almond" value="almond" class="control-warning" >
                                                                            <input type="hidden"  class="control-primary " id="_almond{{$detail->id}}" value="{{$detail->almond}}">
                                                                            Almond
                                                                        </label>
                                                                    </div>

                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" id="oat{{$detail->id}}" name="oat" value="oat" class="control-info" >
                                                                            <input type="hidden"  class="control-primary " id="_oat{{$detail->id}}" value="{{$detail->oat}}">
                                                                            Oat
                                                                        </label>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif


                                                    
                                                    
                                                        <input type="hidden" class="form-control" name="price{{$detail->id}}" id="price1{{$detail->id}}" value="{{$detail->price}}" readonly style="font-weight:bold;font-size:14px"/>



                                                    </div>
                                                    <div class="col-md-6">

                                                        <div class="form-group" style="margin-left:50px">

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row" style="margin-bottom:15px">
                                                                        <button onclick="calculator(1,{{$detail->id}});" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px;">1 </span></button>
                                                                        <button onclick="calculator(2,{{$detail->id}});" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px">2 </span></button>
                                                                        <button onclick="calculator(3,{{$detail->id}});" type="button" class="btn btn-default btn-float"> <span style="width:50px;height:30px">3 </span></button>
                                                                    </div>
                                                                    <div class="row" style="margin-bottom:15px">
                                                                        <button onclick="calculator(4,{{$detail->id}});" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px;">4 </span></button>
                                                                        <button onclick="calculator(5,{{$detail->id}});" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px">5 </span></button>
                                                                        <button onclick="calculator(6,{{$detail->id}});" type="button" class="btn btn-default btn-float"> <span style="width:50px;height:30px">6</span></button>
                                                                    </div>
                                                                    <div class="row" style="margin-bottom:15px">
                                                                        <button onclick="calculator(7,{{$detail->id}});" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px;">7 </span></button>
                                                                        <button onclick="calculator(8,{{$detail->id}});" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px">8 </span></button>
                                                                        <button onclick="calculator(9,{{$detail->id}});" type="button" class="btn btn-default btn-float"> <span style="width:50px;height:30px">9 </span></button>
                                                                    </div>

                                                                    <div class="row">
                                                                        <button onclick="calculator(-1,{{$detail->id}});"  type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px;">- </span></button>
                                                                        <button onclick="calculator(+1,{{$detail->id}});"  type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px">+ </span></button>
                                                                        <button onclick="clearval({{$detail->id}});" type="button" class="btn btn-default btn-float"> <span style="width:50px;height:30px">clear </span></button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button"  class="btn btn-link" data-dismiss="modal">Close</button>
                                                <button type="button" onclick="add_to_cart({{$detail->id}});" data-dismiss="modal" class="btn bg-brown">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div> 
                        </div>


                    </div>


                </div>

            </div>

        </div>
        <div >

            <button type="button" class="btn btn-warning btn-float"   onclick="loadFood();"><i class="icon-coffee"></i> <span style="width:50px">Food </span></button>
            <button type="button" class="btn bg-brown btn-float"><i class="fa fa-cube" onclick="loadBox();"></i>  <span style="width:50px">Box  </span></button>
            <button type="button" class="btn bg-pink btn-float  "  data-toggle="modal" data-target="#modal_theme_custom_customer" ><i class="fa fa-user-plus"></i>  <span style="width:50px">Customer  </span></button>
            <button type="button" class="btn bg-info btn-float" onclick="hold();"><i class="fa fa-stop"></i>  <span style="width:50px">Hold  </span></button>
            <button type="button" class="btn bg-slate-700 btn-float" data-toggle="modal" data-target="#modal_theme_search"><i class="fa fa-search"></i>  <span style="width:50px">Search  </span></button>
            <button onclick="cancel();" type="button" class="btn bg-danger btn-float"><i class="fa fa-remove"></i>  <span style="width:50px">Cancel  </span></button>
            <button  type="button" class="btn btn-success btn-float"  data-toggle="modal" data-target="#modal_theme_info" ><i class="fa fa-print"></i>  <span style="width:165px">Pay  </span></button>


        </div>


    </div>
    <!-- </form> -->
</div>


<!-- Info modal -->
<div id="modal_theme_info" class="modal fade" >
    <div class="modal-dialog modal-sm" >
        <div class="modal-content" >
            <div class="modal-header bg-default">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Payment Method</h6>
            </div>
            <form action="{{url('/checkout')}}" method="POST" >

                {{ csrf_field() }}
                <div class="modal-body">
                    <!-- <h6 class="text-semibold">Text in a modal</h6>
                    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
    
                    <hr> -->
                   
                    <input type="hidden" name="user_id" id="user_id"  @if(Session::get('customer_id')!="") value="{{Session::get('customer_id')}}" @endif/>
                    
                    
                   
                    <div class="col-md-6">
                        <div class="form-group">
                            <Center>
                                <img src="{{ asset('LTR/assets/images/card.png')}}"  class="img-thumbnail" width="110px" alt="">

                                <input name="payment_method" value="Card payment" type="submit" class="btn bg-teal-300" style="margin-top:10px" />
                            </Center>


                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <Center>

                                <img src="{{ asset('LTR/assets/images/cash.png')}}"  class="img-thumbnail" width="110px"  alt="">

                                <input name="payment_method" value="Cash payment"  type="submit" class="btn  bg-pink" style="margin-top:10px"/>
                            </Center>
                        </div>
                    </div>

                </div>

                <div class="modal-footer" >
                    <button type="button" class="btn btn-slate" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn bg-teal-300">Save changes</button> -->
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /info modal -->

<!-- Custom header color -->
<div id="modal_theme_search" class="modal fade">
    <div class="modal-dialog " style="width:80%">
        <div class="modal-content">
            <div class="modal-header bg-brown">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Search products</h6>
            </div>

            <div class="modal-body">
                <table class="table table-striped table-hover dataTables-example2" >
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th style="width:550px">Description</th>                       
                            <th>Category</th>        
                            <th>Price</th>                  
                        </tr>
                    </thead>
                    <tbody >
                        @foreach($data as $record)
                        <tr  onclick="setectProduct({{$record->id}})"  data-toggle="modal" data-target="#datamodal2{{$record->id}}">
                            <td>
                                <img src="{{ asset('/images/food')}}/{{ $record->img}}" alt="{{$record->name}}" style="width:42px">


                            </td>
                            <td>{{$record->name}}</td>
                            <td style="width:550px">{{$record->description}}</td>
                            <td>{{$record->subcat_name}}</td>
                            <td>${{$record->price}}</td>

                        </tr>


                    <div class="modal fade" id="datamodal2{{$record->id}}" >
                        <div class="modal-dialog " style="width:65%">
                            <div class="modal-content">
                                <div class="modal-header bg-brown">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h6 class="modal-title">Product details</h6>
                                </div>

                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Quantity:</label>
                                                <input id='pro_qty{{$record->id}}' value="1" type="number" class="form-control" placeholder="Enter Quantity">
                                                <input id="pro_id{{$record->id}}" type="hidden" class="form-control" placeholder="Eugene Kopyov" value="{{$record->id}}">

                                            </div>
                                            @if($record->subcategory_id==1)
                                            <div class="form-group">
                                                <label class="text-semibold">Size</label>
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <form id="rates">
                                                            <div class="radio col-md-4">
                                                                <label>
                                                                    <input type="radio" name="size{{$record->id}}" class="control-primary "  value="Small" checked="checked">

                                                                    <input type="hidden"  class="control-primary " id="small{{$record->id}}" value="{{$record->small}}">



                                                                    Small
                                                                </label>
                                                            </div>

                                                            <div class="radio col-md-4" style="padding-top:8px">
                                                                <label>
                                                                    <input type="radio" name="size{{$record->id}}" class="control-danger" value="Medium">
                                                                    <input type="hidden"  class="control-primary " id="medium{{$record->id}}" value="{{$record->medium}}">
                                                                    Medium
                                                                </label>
                                                            </div>

                                                            <div class="radio col-md-4" style="padding-top:8px">
                                                                <label>
                                                                    <input type="radio" name="size{{$record->id}}" class="control-success"  value="Large">
                                                                    <input type="hidden"  class="control-primary " id="large{{$record->id}}" value="{{$record->large}}">
                                                                    Large
                                                                </label>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="text-semibold">Add Extra</label>
                                                <div class="row">
                                                    <div class="col-md-6" id="rates"> 
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" id="icecream{{$record->id}}" name="icecream" value="icecream" class="control-primary" >
                                                                Ice cream
                                                                <input type="hidden"  class="control-primary " id="_fullcream{{$record->id}}" value="{{$record->full_cream}}">
                                                            </label>
                                                        </div>

                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" id="skim{{$record->id}}" name="skim" value="skim" class="control-danger" >
                                                                <input type="hidden"  class="control-primary " id="_skim{{$record->id}}" value="{{$record->skim}}">
                                                                Skim
                                                            </label>
                                                        </div>

                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" id="soy{{$record->id}}" name="soy" value="soy" class="control-success" >
                                                                <input type="hidden"  class="control-primary " id="_soy{{$record->id}}" value="{{$record->soy}}">
                                                                Soy
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" id="almond{{$record->id}}" name="almond" value="almond" class="control-warning" >
                                                                <input type="hidden"  class="control-primary " id="_almond{{$record->id}}" value="{{$record->almond}}">
                                                                Almond
                                                            </label>
                                                        </div>

                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" id="oat{{$record->id}}" name="oat" value="oat" class="control-info" >
                                                                <input type="hidden"  class="control-primary " id="_oat{{$record->id}}" value="{{$record->oat}}">
                                                                Oat
                                                            </label>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                            @endif


                                            <input type="hidden" class="form-control" name="price" id="price1{{$detail->id}}" value="{{$detail->price}}"/>

                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group" style="margin-left:50px">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                    <div class="row" style="margin-bottom:15px">
                                                                        <button onclick="calculator(1,{{$detail->id}});" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px;">1 </span></button>
                                                                        <button onclick="calculator(2,{{$detail->id}});" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px">2 </span></button>
                                                                        <button onclick="calculator(3,{{$detail->id}});" type="button" class="btn btn-default btn-float"> <span style="width:50px;height:30px">3 </span></button>
                                                                    </div>
                                                                    <div class="row" style="margin-bottom:15px">
                                                                        <button onclick="calculator(4,{{$detail->id}});" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px;">4 </span></button>
                                                                        <button onclick="calculator(5,{{$detail->id}});" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px">5 </span></button>
                                                                        <button onclick="calculator(6,{{$detail->id}});" type="button" class="btn btn-default btn-float"> <span style="width:50px;height:30px">6</span></button>
                                                                    </div>
                                                                    <div class="row" style="margin-bottom:15px">
                                                                        <button onclick="calculator(7,{{$detail->id}});" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px;">7 </span></button>
                                                                        <button onclick="calculator(8,{{$detail->id}});" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px">8 </span></button>
                                                                        <button onclick="calculator(9,{{$detail->id}});" type="button" class="btn btn-default btn-float"> <span style="width:50px;height:30px">9 </span></button>
                                                                    </div>

                                                                    <div class="row">
                                                                        <button onclick="calculator(-1,{{$detail->id}});"  type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px;">- </span></button>
                                                                        <button onclick="calculator(+1,{{$detail->id}});"  type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px">+ </span></button>
                                                                        <button onclick="clearval({{$detail->id}});" type="button" class="btn btn-default btn-float"> <span style="width:50px;height:30px">clear </span></button>
                                                                    </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-link" data-dismiss="modal">Close</button>
                                    <button type="button" onclick="add_to_cart({{$record->id}});" data-dismiss="modal" class="btn bg-brown">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    @endforeach


                    </tbody>

                </table>


            </div>

            <div class="modal-footer">
                <button type="button"  class="btn btn-link" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!-- /custom header color -->

<!-- Modal with basic title -->
<div id="modal_title_basic" class="modal fade">
    <div class="modal-dialog" style="width:80%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <span class="text-semibold modal-title">Hold Invoices</span>
            </div>

            <div class="modal-body">


                <table class="table table-striped table-hover dataTables-example2" >
                    <thead>
                        <tr>
                            <th>OrderId</th>
                            <th>Total</th>    
                            <th>Customer Name</th>     
                            <th>Email</th>        
                            <th>Invoice date</th>       
                            <th style="width:70px">Action</th>              
                        </tr>
                    </thead>
                    <tbody >
                        @foreach($orders as $order)
                        <tr >
           
                            <td>{{$order->orderid}}</td>
                            <td >{{$order->total}}</td>
                            <td>{{$order->user_name}}</td>
                            <td>{{$order->email}}</td>
                            <td>{{$order->created_at}}</td>
                            <td style="width:50px">
                                    <a href="{{url('/addtocart/holdInvoice/'.$order->id)}}" class="btn bg-success"><i class="fa fa-pencil"></i> open<a>
                                            <button onclick="deleteconfirm({{$order->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                             </td>

                        </tr>

                        @endforeach


                    </tbody>

                </table>


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>


   <!-- Custom header color -->
   <div id="modal_theme_custom_customer" class="modal fade">
						<div class="modal-dialog ">
							<div class="modal-content">
								<div class="modal-header ">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h6 class="modal-title">Add Customer</h6>
								</div>

								<div class="modal-body">
                                <div class="content">
      

       
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="row">

                        <div class="col-md-12">

                         

                        <form id="frm" >
        {{ csrf_field() }}

                                <div   class="form-group {{ $errors->has('name') ? ' has-error' : '' }}" >
                                    <label>Customer Name</label>
                                    <div>
                                        <input type="text"  autocomplete="off" name="name" id="name"  class="form-control" placeholder="Enter Name "
                                                />
                                    </div>
                                  
                                    <span class="text-danger error-text name_error"> </span>
                                </div>
                                <div   class="form-group {{ $errors->has('email') ? ' has-error' : '' }}" >
                                    <label>Email</label>
                                    <div>
                                        <input type="text"  autocomplete="off" name="email" id="email"  class="form-control" placeholder="Enter Email "
                                              />
                                    </div>
                                   
                                    <span class="text-danger error-text email_error"> </span>
                                </div>

                                <div   class="form-group {{ $errors->has('mobile_no') ? ' has-error' : '' }}" >
                                    <label>Mobile Number</label>
                                    <div>
                                        <input type="text"  autocomplete="off" name="mobile_no" id="mobile_no"  class="form-control" placeholder="Enter Mobile Number "
                                              />
                                    </div>
                                    
                                    <span class="text-danger error-text mobile_no_error"> </span>
                                </div>



                                <input type="submit" value="Submit" id="formSubmit" class="btn btn-success">
            <!-- <button type="submit" class="btn btn-success">Add Customer</button> -->


            <button type="reset" name="reset" class="btn btn-danger">
                <i class="glyphicon glyphicon-trash"></i>
                Clear</button>
        </form>
  
                        </div> 
                       

                    </div>
                    @if(!empty($food->id))
                    <input type="hidden" name="id" value="{{$food->id}}">
                    @endif




                    <br/>
                </div>
            </div>

    </div>
								</div>

								<!-- <div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
									<button type="button" class="btn bg-brown">Save changes</button>
								</div> -->
							</div>
						</div>
					</div>
					<!-- /custom header color -->
<!-- /modal with basic title -->



<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script> -->

<script language="JavaScript" type="text/javascript">

    function abc(id) {




    $.ajax({
    url: "{{url('getdatabyid')}}" + "/" + id, //
            type: 'get', //this is your method
            success: function (data) {
            // var pro = JSON.parse(data);
            document.getElementById('small' + id).value = data[0].small;
            document.getElementById('medium' + id).value = data[0].medium;
            document.getElementById('large' + id).value = data[0].large;
            }

    });
    // $("#pro_id").val(id);

    }
    function add_to_cart(ids) {

    var id = document.getElementById('pro_id' + ids).value;
    // var id2 = document.getElementById('pro_id2').value;


    var box = $("input[type='radio'][name='box" + id + "']:checked").val();
    var size = $("input[type='radio'][name='size" + id + "']:checked").val();

    var ele = [];
    var _fullcream = 0;
    var _skim = 0;
    var _soy = 0;
    var _almond = 0;
    var _oat = 0;
    var total = 0;
    var _small = 0;
    var _medium = 0;
    var _large = 0;
    var _price = 0;
    var gross_total = 0;
    if (size == "Small"){
    _small = document.getElementById("small" + id).value;
    } else if (size == "Medium"){
    _medium = document.getElementById("medium" + id).value;
    } else if (size == "Large"){
    _large = document.getElementById("large" + id).value;
    } else{
    size = "";
    _price = document.getElementById("price1"+id).value;
    }


    var icecream = document.getElementById("icecream" + id);
    if (icecream) {
    if (icecream.checked){
    _fullcream = document.getElementById("_fullcream" + id).value;
    ele.push(icecream.value);
    }
    }
    var skim = document.getElementById("skim" + id);
    if (skim) {
    if (skim.checked){
    _skim = document.getElementById("_skim" + id).value;
    ele.push(skim.value);
    }
    }
    var soy = document.getElementById("soy" + id)
            if (soy) {
    if (soy.checked){
    _soy = document.getElementById("_soy" + id).value;
    ele.push(soy.value);
    }
    }
    var almond = document.getElementById("almond" + id)
            if (almond) {
    if (almond.checked){
    _almond = document.getElementById("_almond" + id).value;
    ele.push(almond.value);
    }
    }
    var oat = document.getElementById("oat" + id)
            if (oat) {
    if (oat.checked){
    _oat = document.getElementById("_oat" + id).value;
    ele.push(oat.value);
    }
    }
    var tablebody = document.getElementById('tbl_body');
    let dataHtml = '';
    var qty = document.getElementById("pro_qty" + id).value;
    if (qty == ""){
    qty = 1;
    }

    total = parseFloat(_fullcream) + parseFloat(_skim) + parseFloat(_soy) + parseFloat(_almond) + parseFloat(_small) + parseFloat(_medium) + parseFloat(_large) + parseFloat(_price);
  
  if(size==""){
    size=box;
    // alert("size is null : "+box); 
  }
//   else{
//     alert("size is : "+size);
     
//   }
 

    // gross_total = parseFloat(total) * parseFloat(qty);
    gross_total = parseFloat(total);
    // alert("total : "+total+" / qty:  "+qty+" gross / "+gross_total);
    $.ajax({
    type: 'POST',
            url: '/add/to/cart',
            data: {
            "_token": "{{ csrf_token() }}",
                    size: size,
                    ele:ele,
                    id:id,
                    qty:qty,
                    total:gross_total

            },
    }).done(function (data) {
    $('.dataTables-example > tbody > tr').remove();
    var pro = JSON.parse(data);
    //  alert(data);
    console.log(data);
    var amount=0;
    for (var i in pro.original){
        amount=parseFloat(pro.original[i].price)*parseFloat(pro.original[i].qty);
         dataHtml += '<tr><td width="5" style="padding-left:10px">' + pro.original[i].product + '</td><td style="padding:2px">' + pro.original[i].name + '</td><td style="padding:2px">' + pro.original[i].qty + '</td><td style="padding:2px">' + pro.original[i].size + '</td><td style="padding:2px">' + amount+ '</td><td width="5" style="padding:4px"><button  onclick="deleteconfirm(' + pro.original[i].uid + ')" class="btn btn-danger remove"><i class="fa fa-trash-o"></i></button></td></tr>';
    }
    tablebody.innerHTML = dataHtml;
    });
    cartSession();
    $('.remove').live('click', function(){
    $(this).parent().parent().remove();
    });
  
    }






</script>
<script>
    function cancel(){
    $.ajax({
    url: "{{url('/cancel/to/cart')}}", //this is your uri
            type: 'get', //this is your method
            success: function (data) {
              
                if(data==-1){
                    swal({
                    title: "Sorry!",
                            text: "Your cart is empty. please add item first!",
                            icon: "warning",
                            button: "Ok!",
                    }).then(okay => {
                                            if (okay) {
                                                location.reload();
                                            
                                            }
                                            });
                }
                else{
                    swal({
                        title: "Good job!",
                                text: "Successfuly cancel invoice!",
                                icon: "success",
                                button: "Ok!",
                        }).then(okay => {
                                            if (okay) {
                                                location.reload();
                                            
                                            }
                                            });
                }

          
            }
    });

    document.getElementById('user_id').value ="";
    $('#aioConceptName').val('');
    cartSession();
    }
    function hold(){

var selected_value=  $('#aioConceptName').val();
if(selected_value!=""){

        $.ajax({
    url: "{{url('/count')}}", //this is your uri
            type: 'get', //this is your method
            success: function (data) {

             
                if(data==='"error"'){
                    swal({
                            title: "Sorry!",
                                    text: "Your can't hold in holded invoice.!",
                                    icon: "error",
                                    button: "Ok!",
                            });
                }else{
                    if(data>0){
                            swal({


                                title: "Are you sure?",
                                        text: "Once hold,Are you sue want to hold this invoice!",
                                        icon: "warning",
                                        buttons: true,
                                        dangerMode: true,
                                })
                                        .then((willDelete) => {
                                        if (willDelete) {
                                

                                        $.ajax({
                                        url: "{{url('/hold')}}"+"/"+selected_value, //this is your uri
                                                type: 'get', //this is your method
                                                success: function (data) {

                                                swal({
                                                title: "Good job!",
                                                        text: "Successfuly hold invoice!",
                                                        icon: "success",
                                                        button: "Ok!",
                                                }).then(okay => {
                                            if (okay) {
                                                location.reload();
                                            
                                            }
                                            });
                                                }
                                        });
                                        cartSession();
                                        } else {
                                        swal("Your imaginary file is safe!");
                                        }
                                        });
                                    
                        }else{
                            swal({
                            title: "Sorry!",
                                    text: "Your cart is empty. please add item first!",
                                    icon: "warning",
                                    button: "Ok!",
                            });
                
                        }
                    }
            }
    });

    }else{
        swal({
                            title: "Sorry!",
                                    text: "Please select customer first!",
                                    icon: "warning",
                                    button: "Ok!",
                            });
    }
   
    }
    function deleteconfirm(id){

    $.ajax({
    url: "{{url('/remove/to/cart')}}" + "/" + id, //this is your uri
            type: 'get', //this is your method
            success: function (data) {
            // console.log(data);
            }
    });
    cartSession();
    }
    function cartSession(){
      
    var tablebody = document.getElementById('tbl_body');
    let dataHtml = '';
    $.ajax({
    url: "{{url('/loadcart')}}", //this is your uri
            type: 'get', //this is your method
            success: function (data) {
            var pro = JSON.parse(data);
            var groos_tot = 0;
            var total = 0;
            var netTotal=0;
            var amount=0;
            for (var i in pro.original){
            amount=parseFloat(pro.original[i].price)*parseFloat(pro.original[i].qty);
            total += parseFloat(pro.original[i].price);
            netTotal +=parseFloat(pro.original[i].total);

            dataHtml += '<tr><td width="5"  style="padding-left:10px">' + pro.original[i].product + '</td><td style="padding:2px">' + pro.original[i].name + '</td><td style="padding:2px">' + pro.original[i].qty + '</td><td style="padding:2px">' + pro.original[i].size + '</td><td style="padding:2px">' +amount + '</td><td width="5" style="padding:4px"><button  onclick="deleteconfirm(' + pro.original[i].uid + ')" class="btn btn-danger remove"><i class="fa fa-trash-o"></i></button></td></tr>';
            }
            tablebody.innerHTML = dataHtml;
            document.getElementById("p1").innerHTML = netTotal;
            document.getElementById("subtotal").value = netTotal;
            document.getElementById("groos_tot").innerHTML = netTotal;
            }

    });
    $('.remove').live('click', function(){
    $(this).parent().parent().remove();
    });
    }

</script>
<script>
    $(document).ready(function(){

    

        $('select').on('change', function() {
            
            document.getElementById('user_id').value =this.value;
            
            
            });



    var response = '{{ Session::get('msg')}}';
    if (response == "insert"){
    swal({
    title: "Good job!",
            text: "Successfuly inserted record!",
            icon: "success",
            button: "Ok!",
    });
    }else if(response=="cartzero"){
        swal({
    title: "Sorry!",
            text: "Your cart is empty. please add item first!",
            icon: "warning",
            button: "Ok!",
    });
        
    }else if(response=="holdinsert"){
        swal({
    title: "Good job!",
    text: "Successfuly inserted hold record!",
            icon: "success",
            button: "Ok!",
    });
        
    }

    });</script>

<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

<script>
    $(document).ready(function(){

        
    $('.dataTables-example2').DataTable({
    });
    });
    function setectProduct(id){



    }

function calculator(val,id){

    var qty=document.getElementById('pro_qty'+id).value;
    console.log(qty+" / "+id);
    var total=0;
    total+=parseFloat(qty)+parseFloat(val);
    // alert(total);
    if(total>0){
    document.getElementById('pro_qty'+id).value =total;
    }
    discountCalculations(id);
}
function clearval(id){
    document.getElementById('pro_qty'+id).value =0;
}

$(function(){
$("#frm").on('submit',function(e){
    e.preventDefault();


         $.ajax({
         url:"{{url('form_submit')}}",
         data:jQuery("#frm").serialize(),
         type:'post',
         dataType:'json',
        //  contentType:false,
         beforeSend:function(){
             $(document).find('span.error-text').text('');
         },
         success:function(data){
             if(data.status==0){
                 $.each(data.error,function(prefix,val){
                    $('span.'+prefix+'_error').text(val[0]);
                 });
                 

             }else{
               
                    $('#frm')[0].reset;
                    location.reload();


             }
            //  console.log(">>>>>>>> "+data);

         }
     });


})
});

function closeDialog() {
        let d = document.getElementById('modal_theme_custom_customer');
        d.style.display = "none";
        d.close();
    }
    
    function loadFood(){
        $.ajax({
         url: "{{url('/get_food_all')}}", //this is your uri
            type: 'get', //this is your method
            success: function (data) {
    let dataHtml = '';

                for (var i=0 ;i<data.length;i++){
           
                    dataHtml += '<div class="col-lg-2 col-sm-4">'+
                                    '<div class="thumbnail">'+
                                        '<div class="thumb" style="padding:5px;">'+
                                            '<img src="{{ asset('/images/food')}}/'+data[i].img+'" alt="">'+
                                            '<div class="caption-overflow">'+
                                                '<span>'+
                                                    '<a href="assets/images/placeholder.jpg" data-popup="lightbox" onclick="abc('+data[i].id+')" data-toggle="modal" data-target="#modal_theme_custom'+data[i].id+'" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>'+
                                                '</span>'+
                                            '</div>'+
                                        '</div>'+
                                        '<p style="padding-top: 5px;font-size:11px;margin-bottom:-5px;"><a href="#" style="color:black;">'+data[i].name+'</a></p>'+
                                    '</div>'+
                                '</div>'+
                                '<div id="modal_theme_custom'+data[i].id+'" class="modal fade">'+
                                '<div class="modal-dialog " style="width:55%">'+
                                '<div class="modal-content">'+
                                '<div class="modal-header bg-brown">'+
                                '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
                                '<h6 class="modal-title">Product details</h6>'+
                                '</div>'+
                                '<div class="modal-body">'+
                                '<div class="row">'+
                                '<div class="col-md-6">'+
                                '<div class="form-group">'+
                                '<label>Quantity:</label>'+
                                '<input id="pro_qty'+data[i].id+'" type="number" class="form-control"  value="1" placeholder="Enter Quantity">'+
                                '<input id="pro_id'+data[i].id+'" type="hidden" class="form-control" value="'+data[i].id+'" placeholder="Eugene Kopyov">'+
                             
                                '</div>';
                                if(data[i].subcategory_id==1){
                                 
                    dataHtml+='<div class="form-group">'+
                                '<label class="text-semibold">Size</label>'+
                                '<div class="row">'+
                                '<div class="col-md-12">'+
                                '<form id="rates"><div class="radio col-md-4"><label><input type="radio" name="size'+data[i].id+'" class="control-primary "  value="Small"  checked="checked"><input type="hidden"  class="control-primary" id="small'+data[i].id+'" value="'+data[i].small+'">Small</label></div><div class="radio col-md-4" style="padding-top:8px"><label><input type="radio" name="size'+data[i].id+'" class="control-danger" value="Medium"><input type="hidden"  class="control-primary" id="medium'+data[i].id+'" value="'+data[i].medium+'">Medium</label></div><div class="radio col-md-4" style="padding-top:8px"><label><input type="radio" name="size'+data[i].id+'" class="control-success"  value="Large"><input type="hidden"  class="control-primary" id="large'+data[i].id+'" value="'+data[i].large+'">Large</label></div></form>'+
                                '</div>'+
                                '</div>'+
                                '</div>'+
                                '<div class="form-group">'+
                                '<label class="text-semibold">Add Extra</label>'+
                                '<div class="row">'+
                                '<div class="col-md-6" id="rates"> '+
                                '<div class="checkbox">'+
                                '<label>'+
                                '<input type="checkbox" id="icecream'+data[i].id+'" name="icecream" value="icecream" class="control-primary" >Ice cream'+
                                '<input type="hidden"  class="control-primary " id="_fullcream'+data[i].id+'" value="'+data[i].full_cream+'">'+
                                '</label>'+
                                '</div>'+
                                '<div class="checkbox">'+
                                '<label>'+
                                '<input type="checkbox" id="skim'+data[i].id+'" name="skim" value="skim" class="control-danger" >'+
                                '<input type="hidden"  class="control-primary " id="_skim'+data[i].id+'" value="'+data[i].skim+'">Skim'+
                                '</label>'+
                                '</div>'+
                                '<div class="checkbox">'+
                                '<label>'+
                                '<input type="checkbox" id="soy'+data[i].id+'" name="soy" value="soy" class="control-success" >'+
                                '<input type="hidden"  class="control-primary " id="_soy'+data[i].id+'" value="'+data[i].soy+'">Soy'+
                                '</label>'+
                                '</div>'+
                                '</div>'+
                                '<div class="col-md-6">'+
                                '<div class="checkbox">'+
                                '<label>'+
                                '<input type="checkbox" id="almond'+data[i].id+'" name="almond" value="almond" class="control-warning" >'+
                                                                            '<input type="hidden"  class="control-primary " id="_almond'+data[i].id+'" value="'+data[i].almond+'">Almond'+
                                                                            '</label>'+
                                                                            '</div>'+
                                                                            '<div class="checkbox">'+
                                                                            '<label>'+
                                                                            '<input type="checkbox" id="oat'+data[i].id+'" name="oat" value="oat" class="control-info" >'+
                                                                            '<input type="hidden"  class="control-primary " id="_oat'+data[i].id+'" value="'+data[i].oat+'">Oat'+
                                                                            '</label>'+
                                                                            '</div>'+
                                                                            '</div>'+
                                                                            '</div>'+
                                                                            '</div>';
                }
                dataHtml+='<input type="hidden" class="form-control" name="price" id="price1'+data[i].id+'" value="'+data[i].price+'"/>'+
                                                                            '</div>'+
                                                                            '<div class="col-md-6">'+
                                                                            '<div class="form-group" style="margin-left:50px">'+
                                                                            '<div class="row">'+
                                                                            '<div class="col-md-12">'+
                                                                            '<div class="row" style="margin-bottom:15px">'+
                                                                            '<button onclick="calculator(1,'+data[i].id+');" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px;">1 </span></button>'+
                                                                            '<button onclick="calculator(2,'+data[i].id+');" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px">2 </span></button>'+
                                                                            '<button onclick="calculator(3,'+data[i].id+');" type="button" class="btn btn-default btn-float"> <span style="width:50px;height:30px">3 </span></button>'+
                                                                            '</div>'+
                                                                            '<div class="row" style="margin-bottom:15px">'+
                                                                            '<button onclick="calculator(4,'+data[i].id+');" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px;">4 </span></button>'+
                                                                            '<button onclick="calculator(5,'+data[i].id+');" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px">5 </span></button>'+
                                                                            '<button onclick="calculator(6,'+data[i].id+');" type="button" class="btn btn-default btn-float"> <span style="width:50px;height:30px">6</span></button>'+
                                                                            '</div>'+
                                                                            '<div class="row" style="margin-bottom:15px">'+
                                                                            '<button onclick="calculator(7,'+data[i].id+');" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px;">7 </span></button>'+
                                                                            '<button onclick="calculator(8,'+data[i].id+');" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px">8 </span></button>'+
                                                                            '<button onclick="calculator(9,'+data[i].id+');" type="button" class="btn btn-default btn-float"> <span style="width:50px;height:30px">9 </span></button>'+
                                                                            '</div>'+
                                                                            '<div class="row">'+
                                                                            '<button onclick="calculator(-1,'+data[i].id+');"  type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px;">- </span></button>'+
                                                                            '<button onclick="calculator(+1,'+data[i].id+');"  type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px">+ </span></button>'+
                                                                            '<button onclick="clearval('+data[i].id+');" type="button" class="btn btn-default btn-float"> <span style="width:50px;height:30px">clear </span></button>'+
                                                                            '</div>'+
                                                                            '</div>'+
                                                                            '</div>'+
                                                                            '</div>'+
                                                                            '</div>'+
                                                                            '</div>'+
                                                                            '</div>'+
                                                                            '<div class="modal-footer">'+
                                                                            '<button type="button"  class="btn btn-link" data-dismiss="modal">Close</button>'+
                                                                            '<button type="button" onclick="add_to_cart('+data[i].id+');" data-dismiss="modal" class="btn bg-brown">Add</button>'+
                                                                            '</div>'+
                                            '</div>'+
                                        '</div>'+
                                '</div>'









                }
                document.getElementById("products_div").innerHTML=dataHtml; 
            }
    });
    }
    function loadBox(){
        $.ajax({
         url: "{{url('/get_box_all')}}", //this is your uri
            type: 'get', //this is your method
            success: function (data) {
    let dataHtml = '';

                for (var i=0 ;i<data.length;i++){
           
                    dataHtml += '<div class="col-lg-2 col-sm-4">'+
                                    '<div class="thumbnail">'+
                                        '<div class="thumb" style="padding:5px;">'+
                                            '<img src="{{ asset('/images/Box')}}/'+data[i].img+'" alt="">'+
                                            '<div class="caption-overflow">'+
                                                '<span>'+
                                                    '<a href="assets/images/placeholder.jpg" data-popup="lightbox" onclick="abc('+data[i].id+')" data-toggle="modal" data-target="#modal_theme_custom'+data[i].id+'" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>'+
                                                '</span>'+
                                            '</div>'+
                                        '</div>'+
                                        '<p style="padding-top: 5px;font-size:11px;margin-bottom:-5px;"><a href="#" style="color:black;">'+data[i].name+'</a></p>'+
                                    '</div>'+
                                '</div>'+
                                '<div id="modal_theme_custom'+data[i].id+'" class="modal fade">'+
                                '<div class="modal-dialog " style="width:55%">'+
                                '<div class="modal-content">'+
                                '<div class="modal-header bg-brown">'+
                                '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
                                '<h6 class="modal-title">Product details</h6>'+
                                '</div>'+
                                '<div class="modal-body">'+
                                '<div class="row">'+
                                '<div class="col-md-6">'+
                                '<div class="form-group">'+
                                '<label>Quantity:</label>'+
                                '<input id="pro_qty'+data[i].id+'" type="number" class="form-control"  value="1" placeholder="Enter Quantity">'+
                                '<input id="pro_id'+data[i].id+'" type="hidden" class="form-control" value="'+data[i].id+'" placeholder="Eugene Kopyov">'+
                             
                                '</div>';
                                if(data[i].subcategory_id==9){
                                 
                    dataHtml+='<div class="form-group">'+
                    '<label class="text-semibold">Size</label>'+
                    ' <div class="row">'+
                    '<div class="col-md-12">'+

                    '<form id="rates">'+
                    '<div class="radio col-md-3">'+
                    ' <label style="margin-left:-20px;font-size:12px;">'+
                    '<input  type="radio" name="box'+data[i].id+'" class="control-primary "  value="Residential" checked="checked">'+
                    'Residential'+
                                                                                '</label>'+
                                                                                '</div>'+

                                                                                '<div class="radio col-md-4" style="padding-top:8px">'+
                                                                                '<label style="margin-left:-18px;font-size:13px">'+
                                                                                '<input type="radio" name="box'+data[i].id+'" class="control-danger" value="Commercial">'+
                                                                          
                                                                                'Commercial'+
                                                                                '</label>'+
                                                                                '</div>'+

                                                                                '<div class="radio col-md-5" style="padding-top:8px">'+
                                                                                '<label style="margin-left:-10px;font-size:12px">'+
                                                                                '<input type="radio" name="box'+data[i].id+'" class="control-success"  value="Home Applience">'+

                                                                                'Home Applience'+
                                                                                '</label>'+
                                                                                '</div>'+
                                                                                ' </form>'+
                                                                                '</div>'+

                                                                                '</div>'+
                                                                                '</div>'+
                                                                                '<div class="col-md-6">'+
                                                                                '<div class="form-group">'+
                                                                                '<label>Discount:</label>'+
                                                                                ' <input type="text" class="form-control" name="discount_rate'+data[i].id+'" id="discount_rate'+data[i].id+'"  onkeyup ="discountCalculations('+data[i].id+');" value="0"/>'+
                                                                                '</div>'+
                                                            ' </div>'+
                                                            ' <div class="col-md-6">'+
                                                            '<div class="form-group">'+
                                                            '<label>Price:</label>'+
                                                            '<input type="hidden" class="form-control" name="price'+data[i].id+'" id="price1'+data[i].id+'" value="'+data[i].price+'" readonly style="font-weight:bold;font-size:14px"/>'+
                                                            '<input type="hidden" class="form-control" name="price2'+data[i].id+'" id="price2'+data[i].id+'" value="'+data[i].price+'"/>'+
                                                            '<input type="text" class="form-control" name="price3'+data[i].id+'" id="price3'+data[i].id+'" value="'+data[i].price+'" readonly style="font-weight:bold;font-size:14px"/>'+
                                                            ' </div>'+
                                                            '</div>';
                }
                dataHtml+='<input type="hidden" class="form-control" name="price" id="price1'+data[i].id+'" value="'+data[i].price+'"/>'+
                                                                            '</div>'+
                                                                            '<div class="col-md-6">'+
                                                                            '<div class="form-group" style="margin-left:50px">'+
                                                                            '<div class="row">'+
                                                                            '<div class="col-md-12">'+
                                                                            '<div class="row" style="margin-bottom:15px">'+
                                                                            '<button onclick="calculator(1,'+data[i].id+');" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px;">1 </span></button>'+
                                                                            '<button onclick="calculator(2,'+data[i].id+');" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px">2 </span></button>'+
                                                                            '<button onclick="calculator(3,'+data[i].id+');" type="button" class="btn btn-default btn-float"> <span style="width:50px;height:30px">3 </span></button>'+
                                                                            '</div>'+
                                                                            '<div class="row" style="margin-bottom:15px">'+
                                                                            '<button onclick="calculator(4,'+data[i].id+');" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px;">4 </span></button>'+
                                                                            '<button onclick="calculator(5,'+data[i].id+');" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px">5 </span></button>'+
                                                                            '<button onclick="calculator(6,'+data[i].id+');" type="button" class="btn btn-default btn-float"> <span style="width:50px;height:30px">6</span></button>'+
                                                                            '</div>'+
                                                                            '<div class="row" style="margin-bottom:15px">'+
                                                                            '<button onclick="calculator(7,'+data[i].id+');" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px;">7 </span></button>'+
                                                                            '<button onclick="calculator(8,'+data[i].id+');" type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px">8 </span></button>'+
                                                                            '<button onclick="calculator(9,'+data[i].id+');" type="button" class="btn btn-default btn-float"> <span style="width:50px;height:30px">9 </span></button>'+
                                                                            '</div>'+
                                                                            '<div class="row">'+
                                                                            '<button onclick="calculator(-1,'+data[i].id+');"  type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px;">- </span></button>'+
                                                                            '<button onclick="calculator(+1,'+data[i].id+');"  type="button" class="btn btn-default btn-float" style="margin-right:15px"> <span style="width:50px;height:30px">+ </span></button>'+
                                                                            '<button onclick="clearval('+data[i].id+');" type="button" class="btn btn-default btn-float"> <span style="width:50px;height:30px">clear </span></button>'+
                                                                            '</div>'+
                                                                            '</div>'+
                                                                            '</div>'+
                                                                            '</div>'+
                                                                            '</div>'+
                                                                            '</div>'+
                                                                            '</div>'+
                                                                            '<div class="modal-footer">'+
                                                                            '<button type="button"  class="btn btn-link" data-dismiss="modal">Close</button>'+
                                                                            '<button type="button" onclick="add_to_cart('+data[i].id+');" data-dismiss="modal" class="btn bg-brown">Add</button>'+
                                                                            '</div>'+
                                            '</div>'+
                                        '</div>'+
                                '</div>'


                }
                document.getElementById("products_div").innerHTML=dataHtml; 
            }
    });
    
    }

function discountCalculations(id){
     var discount_rate = document.getElementById('discount_rate'+id).value;
    var price = document.getElementById('price2'+id).value;
    var qty = document.getElementById('pro_qty'+id).value;
    var discount=(price*(100-discount_rate))/100;
    document.getElementById('price1'+id).value=discount;
    document.getElementById('price3'+id).value=(discount*qty).toFixed(2);
    
}
function createDiscount(){
    var subtotal=document.getElementById("subtotal").value;
    var discount_rate=document.getElementById("discount_rate").value;
    var discountval=(subtotal*discount_rate)/100;

    document.getElementById("discount_value").innerHTML=discountval;
    document.getElementById("gross_total").innerHTML=(subtotal-discountval);

    // cartSession();
}
</script>
@endsection
