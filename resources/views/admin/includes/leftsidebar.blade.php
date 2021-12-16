
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
  <div style="background-color:#00897b;height:60px;width:100%;text-align:center">
    <p style="font-size:1.5em;font-weight:bold;color:white;padding-top:16px">MARLEN'S <span style="font-weight:normal;font-size:13">coffee<span></p>

  </div>
        <ul class="nav metismenu" id="side-menu">
 

            <li class="nav-header">
                <div class="dropdown profile-element"> <span style="font-size: 20px; color: #FFF;">
                        <img src="{{ asset('images/logo.jpg') }}" alt="" width="50px;">
                    </span>
                </div>
                <div class="logo-element"> M </div>
            </li>
            <li>
                <!-- <a href="{{url('/admin/dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a> -->
            </li>

          
                        
            <li  class=" treeview">
                <a href="{{url('/admin/customers')}}"><i class="fa fas fa-user"></i> <span class="nav-label">Customers</span></a>
            </li>
            <li >
                <a href="{{url('/admin/orders')}}"><i class="fa fas fa-dollar"></i> <span class="nav-label">Orders</span></a>
            </li>
            <li  class=" treeview">
                <a href="{{url('/admin/food')}}"><i class="fa fas fa-coffee"></i> <span class="nav-label">Foods</span></a>
            </li>
            <li>
                <!-- <a href="{{url('/admin/category')}}"><i class="fa fa-list-alt"></i> <span class="nav-label">Category</span></a> -->
            </li>
            <li>
                <a href="{{url('/admin/subcategory')}}"><i class="fa fa-list-alt"></i> <span class="nav-label"> Category</span></a>
            </li>
            <li>
                <a href="{{url('/admin/slides')}}"><i class="fa fa-slideshare"></i> <span class="nav-label">Slides</span></a>
            </li>
            <li>
                <a href="{{url('/admin/viewEvents')}}"><i class="fa fa-calendar"></i> <span class="nav-label">Events</span></a>
            </li>
             <li>
                <a href="{{url('/admin/order_box')}}"><i class="fa fa-calendar"></i> <span class="nav-label">Order boxes</span></a>
            </li>
            <li>
                <a href="{{url('/admin/viewBoxes')}}"><i class="fa fa-dropbox"></i> <span class="nav-label">Box</span></a>
            </li>
            
            
            <li>
                <a href="{{url('/admin/open')}}"><i class="fa fa-calendar-check-o"></i> <span class="nav-label">Shop Open Details</span></a>
            </li>
            
            @if(Session::get('role_id')==1)
           
            <li>
                <a href="{{url('/admin/view_system_users')}}"><i class="fa fa-users"></i> <span class="nav-label">User</span></a>
            </li>
             @endif

        </ul>
    </div>
</div>
</nav>
