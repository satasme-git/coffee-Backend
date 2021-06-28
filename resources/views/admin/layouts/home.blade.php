@include('admin.includes.head')
<body>
    <div id="wrapper">
    @include('admin.includes.leftsidebar')
        <div id="page-wrapper" class="gray-bg">
		 @include('admin.includes.header')
		 @yield('content')
         @include('admin.includes.footer')
		</div>
        @include('admin.includes.rightsidebar')
	</div>

    <!-- Mainly scripts -->
    <script src="{{url('/')}}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
   <script src="{{url('/')}}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{url('/')}}/js/admin/narmadatech.js"></script>
  

    <script>
        $(document).ready(function() {
            
        });
    </script>
</body>
</html>
