<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Marlen's coffee</title>

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


	<!--<link rel="stylesheet" href="{{ asset('LTR/assets/css/datatables.min.css')}}">-->
	 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> 


	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">


            <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript" src="assets/js/pages/animations_velocity_examples.js"></script>
	<!-- /theme JS files -->










</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-default header-highlight">
		<div class="navbar-header">
			<a class="navbar-brand" href=""><img src="{{ asset('LTR/assets/images/marlenlogo.png')}}" alt="" style="height: 25px;float:left;"></a>
			<p class="aa"  style="color:white;font-weight:bold;float:left;font-size:15px;margin-top:10px">MARLEN'S' <span style="font-weight:normal">coffee</span></p>
			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

			
			</ul>

			<p class="navbar-text"><span class="label bg-success">Online</span></p>

			<ul class="nav navbar-nav navbar-right">
				<!-- <li class="dropdown language-switch">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="assets/images/flags/gb.png" class="position-left" alt="">
						English
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu">
						<li><a class="deutsch"><img src="assets/images/flags/de.png" alt=""> Deutsch</a></li>
						<li><a class="ukrainian"><img src="assets/images/flags/ua.png" alt=""> Українська</a></li>
						<li><a class="english"><img src="assets/images/flags/gb.png" alt=""> English</a></li>
						<li><a class="espana"><img src="assets/images/flags/es.png" alt=""> España</a></li>
						<li><a class="russian"><img src="assets/images/flags/ru.png" alt=""> Русский</a></li>
					</ul>
				</li> -->

				

				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<!-- <img src="assets/images/placeholder.jpg" alt=""> -->
						<span>{{Session::get('user_info.user_username')}}</span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="{{url('/admin/update_profile/'.Session::get('user_info.id'))}}" ><i class="icon-user-plus"></i> My profile</a></li>
						<!-- <li><a href="#"><i class="icon-coins"></i> {{Session::get('user_info.user_username')}}</a></li>
						<li><a href="#"><span class="badge bg-teal-400 pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li> -->
						<li class="divider"></li>
						<!-- <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li> -->
						<li><a href="{{ url('logout') }}"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
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
                              
								<a href="#" class="media-left">
									<!-- @if(Session::get('user_info.user_image')=="" ) -->
									<img src="{{ asset('/images/')}}/avatar.jpg" class="img-circle img-sm" alt="">
									<!-- @else
									<img src="{{ asset('/images/user/')}}/{{Session::get('user_info.user_image') }}" class="img-circle img-sm" alt="">
									@endif -->
								
								</a>
								<div class="media-body">
									<span class="media-heading text-semibold">{{Session::get('user_info.suser_fname') }} {{Session::get('user_info.suser_flname') }}</span>
									<div class="text-size-mini text-muted">
										<i class="fa fa-envelope-o text-size-small"></i> &nbsp;{{Session::get('user_info.suser_username') }}
									</div>
								</div>

								<!-- <div class="media-right media-middle">
									<ul class="icons-list">
										<li>
											<a href="#"><i class="icon-cog3"></i></a>
										</li>
									</ul>
								</div> -->
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

				<!-- Content area -->
			

					
					<!-- /dashboard content -->
                    @section('content')

                    @show

                    <div class="content">
					<!-- Footer -->
					<div class="footer text-muted">
						&copy; 2021. <a href="https://boxesfree.com/">MARLEN'S coffee</a> by <a href="https://satasme.lk/" target="_blank">SATASME</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->


 <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> 

<!--<script src="{{ asset('LTR/assets/js/dataTables.min.js')}}"></script>-->



</body>
</html>
