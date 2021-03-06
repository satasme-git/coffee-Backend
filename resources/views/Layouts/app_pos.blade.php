<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/assets/css/core.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/assets/css/components.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/assets/css/colors.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="{{ asset('LTR/assets/font-awesome/css/font-awesome.min.css')}}">

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ asset('LTR/assets/js/plugins/loaders/pace.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('LTR/assets/js/core/libraries/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('LTR/assets/js/core/libraries/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('LTR/assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('LTR/assets/js/plugins/forms/selects/select2.min.js')}}"></script>

	<script type="text/javascript" src="{{ asset('LTR/assets/js/plugins/visualization/d3/d3.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('LTR/assets/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
	<script type="text/javascript" src="{{ asset('LTR/assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('LTR/assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('LTR/assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
	<script type="text/javascript" src="{{ asset('LTR/assets/js/plugins/ui/moment/moment.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('LTR/assets/js/plugins/pickers/daterangepicker.js')}}"></script>

	<script type="text/javascript" src="{{ asset('LTR/assets/js/core/app.js')}}"></script>


    <script type="text/javascript" src="{{ asset('LTR/assets/js/pages/form_layouts.js')}}"></script>


	<link rel="stylesheet" href="{{ asset('LTR/assets/css/datatables.min.css')}}">
	<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> -->


	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">


            <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
	<!-- /theme JS files -->








    </head>

    <body class="sidebar-xs" onload="cartSession()">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script> -->
        <!-- Main navbar -->
        <div class="navbar navbar-default header-highlight">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html"><img src="{{ asset('LTR/assets/images/marlenlogo.png')}}" alt=""></a>

                <ul class="nav navbar-nav pull-right visible-xs-block">
                    <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                    <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
                </ul>
            </div>

            <div class="navbar-collapse collapse" id="navbar-mobile">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="sidebar-control sidebar-main-toggle hidden-xs" data-popup="tooltip" title="Collapse main" data-placement="bottom" data-container="body">
                            <i class="icon-paragraph-justify3"></i>
                        </a>
                    </li>

                    <li class="dropdown">
                        <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-git-compare"></i>
                            <span class="visible-xs-inline-block position-right">Git updates</span>
                            <span class="badge bg-warning-400">7</span>
                        </a> -->

                        <div class="dropdown-menu dropdown-content">
                            <div class="dropdown-content-heading">
                                Git updates
                                <ul class="icons-list">
                                    <li><a href="#"><i class="icon-sync"></i></a></li>
                                </ul>
                            </div>

                            <ul class="media-list dropdown-content-body width-350">
                                <li class="media">
                                    <div class="media-left">
                                        <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
                                    </div>

                                    <div class="media-body">
                                        Drop the IE <a href="#">specific hacks</a> for temporal inputs
                                        <div class="media-annotation">4 minutes ago</div>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="media-left">
                                        <a href="#" class="btn border-warning text-warning btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-commit"></i></a>
                                    </div>

                                    <div class="media-body">
                                        Add full font overrides for popovers and tooltips
                                        <div class="media-annotation">36 minutes ago</div>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="media-left">
                                        <a href="#" class="btn border-info text-info btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-branch"></i></a>
                                    </div>

                                    <div class="media-body">
                                        <a href="#">Chris Arney</a> created a new <span class="text-semibold">Design</span> branch
                                        <div class="media-annotation">2 hours ago</div>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="media-left">
                                        <a href="#" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-merge"></i></a>
                                    </div>

                                    <div class="media-body">
                                        <a href="#">Eugene Kopyov</a> merged <span class="text-semibold">Master</span> and <span class="text-semibold">Dev</span> branches
                                        <div class="media-annotation">Dec 18, 18:36</div>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="media-left">
                                        <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
                                    </div>

                                    <div class="media-body">
                                        Have Carousel ignore keyboard events
                                        <div class="media-annotation">Dec 12, 05:46</div>
                                    </div>
                                </li>
                            </ul>

                            <div class="dropdown-content-footer">
                                <a href="#" data-popup="tooltip" title="All activity"><i class="icon-menu display-block"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>

                <p class="navbar-text">
                    <span class="label bg-success">Online</span>
                </p>

                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-people"></i>
                                <span class="visible-xs-inline-block position-right">Users</span>
                            </a> -->

                            <div class="dropdown-menu dropdown-content">
                                <div class="dropdown-content-heading">
                                    Users online
                                    <ul class="icons-list">
                                        <li><a href="#"><i class="icon-gear"></i></a></li>
                                    </ul>
                                </div>

                                
                                <div class="dropdown-content-footer">
                                    <a href="#" data-popup="tooltip" title="All users"><i class="icon-menu display-block"></i></a>
                                </div>
                            </div>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle"  data-toggle="modal" data-target="#modal_title_basic">
                                <i class="icon-price-tags2"></i>
                                <!-- <span class="visible-xs-inline-block position-right">Messages</span> -->
                                <span class="badge bg-warning-400"></span> 
                            </a>

                            <div class="dropdown-menu dropdown-content width-350">
                                <div class="dropdown-content-heading">
                                    Messages
                                    <ul class="icons-list">
                                        <li><a href="#"><i class="icon-compose"></i></a></li>
                                    </ul>
                                </div>

                                

                                <div class="dropdown-content-footer">
                                    <a href="#" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>
                                </div>
                            </div>
                        </li>

                       
                    </ul>
                </div>
            </div>
        </div>
        <!-- /main navbar -->


        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main sidebar -->
                <div class="sidebar sidebar-main">
                    <div class="sidebar-content">

                        <!-- User menu -->
                        <div class="sidebar-user">
                            <div class="category-content">
                                <div class="media">
                                    <a href="#" class="media-left"><img src="{{ asset('/images/')}}/avatar.jpg" class="img-circle img-sm" alt=""></a>
                                    <div class="media-body">
                                        	<span class="media-heading text-semibold">{{Session::get('user_info.suser_fname') }} {{Session::get('user_info.suser_flname') }}</span>
									<div class="text-size-mini text-muted">
										<i class="fa fa-envelope-o text-size-small"></i> &nbsp;{{Session::get('user_info.suser_username') }}
									</div>
                                    </div>

                                    <div class="media-right media-middle">
                                        <ul class="icons-list">
                                            <li>
                                                <a href="#"><i class="icon-cog3"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /user menu -->


                        <!-- Main navigation -->
                        <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
								<li class="active"><a href="/admin/dashboard"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
							
								<li>
									<a href="#"><i class="icon-user-tie"></i> <span>Customer management</span></a>
									<ul>
										<li><a href="{{url('/admin/customers')}}" id="layout1">View Customers</a></li>
										<li><a href="{{url('admin/createCustomer')}}" id="layout1">Create Customer</a></li>
										
									</ul>
								</li>
								<li>
									<a href="#"><i class="icon-basket"></i> <span>Order management</span></a>
									<ul>
										<li><a href="{{url('/admin/orders')}}" id="layout1">Food Orders</a></li>
										<li><a href="{{url('/admin/order_box')}}" id="layout1">Box Orders</a></li>	
									</ul>
								</li>
								
								<li>
									<a href="#"><i class="icon-coffee"></i> <span>Food Management</span></a>
									<ul>
										<li><a href="{{url('/admin/food')}}">View Foods</a></li>
										<li><a href="{{url('admin/addfood/0')}}" id="layout1">Create Food</a></li>
									</ul>
								</li>
								<li>
									<a href="#"><i class="icon-folder-open2"></i> <span>Category Management</span></a>
									<ul>
										<li><a href="{{url('/admin/subcategory')}}">View Category</a></li>
										<li><a href="{{url('admin/addcategory/0')}}" id="layout1">Create Category</a></li>
									</ul>
								</li>
								<li>
									<a href="#"><i class="icon-images2"></i> <span>Slide Management</span></a>
									<ul>
										<li><a href="{{url('/admin/slides')}}">View Slides</a></li>
										<li><a href="{{url('admin/addslides/0')}}" id="layout1">Create Slide</a></li>
									</ul>
								</li>
								<li>
									<a href="#"><i class="icon-price-tag2"></i> <span>Event Management</span></a>
									<ul>
										<li><a href="{{url('/admin/viewEvents')}}">View Events</a></li>
										<li><a href="{{url('admin/addevents/0')}}" id="layout1">Create Event</a></li>
									</ul>
								</li>
								<li>
									<a href="#"><i class="fa fa-cube"></i> <span>Box Management</span></a>
									<ul>
										<li><a href="{{url('/admin/viewBoxes')}}">View Boxes</a></li>
										<li><a href="{{url('admin/addboxes/0')}}" id="layout1">Create Box</a></li>
									</ul>
								</li>
								<li>
									<a href="#"><i class="icon-user"></i> <span>User Management</span></a>
									<ul>
										<li><a href="{{url('/admin/view_system_users')}}">View Users</a></li>
										<li><a href="{{url('admin/user')}}" id="layout1">Create User</a></li>
									</ul>
								</li>
								<li>
									<a href="#"><i class="icon-store"></i> <span>Shop Open </span></a>
									<ul>
										<li><a href="{{url('/admin/open')}}">Shop Open Details</a></li>
										<!--<li><a href="{{url('admin/user')}}" id="layout1">Create User</a></li>-->
									</ul>
								</li>
                                <li>
									<a href="{{url('/admin/pos')}}"><i class="icon-cart5"></i> <span>POS </span></a>
									
								</li>
							</ul>
						</div>
                        </div>
                        <!-- /main navigation -->

                    </div>
                </div>
                <!-- /main sidebar -->


                <!-- Main content -->
                <div class="content-wrapper">

                    <!-- Page header -->
            
                    <!-- /page header -->

                    @section('content')

@show
                
                    <!-- /content area -->

                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->

        </div>
        <!-- /page container -->
        <script src="{{ asset('LTR/assets/js/dataTables.min.js')}}"></script>
       
    </body>
</html>
