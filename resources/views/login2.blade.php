<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Finance -Web App Login</title>

        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="{{ asset('LTR/assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('LTR/assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('LTR/assets/css/core.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('LTR/assets/css/components.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('LTR/assets/css/colors.css')}}" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script type="text/javascript" src="{{ asset('LTR/assets/js/plugins/loaders/pace.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('LTR/assets/js/core/libraries/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('LTR/assets/js/core/libraries/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('LTR/assets/js/plugins/loaders/blockui.min.js')}}"></script>
        <!-- /core JS files -->


        <!-- Theme JS files -->
        <script type="text/javascript" src="{{ asset('LTR/assets/js/core/app.js')}}"></script>
        <!-- /theme JS files -->

    </head>

    <body>

        <!-- Main navbar -->
        <div class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html"><img src="{{ asset('images/logo.png')}}" alt="User Image"></a>

                <ul class="nav navbar-nav pull-right visible-xs-block">
                    <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                </ul>
            </div>

            <div class="navbar-collapse collapse" id="navbar-mobile">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#">
                            <i class="icon-display4"></i> <span class="visible-xs-inline-block position-right"> Go to website</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="icon-user-tie"></i> <span class="visible-xs-inline-block position-right"> Contact admin</span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-cog3"></i>
                            <span class="visible-xs-inline-block position-right"> Options</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /main navbar -->


        <!-- Page container -->
        <div class="page-container login-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">

                    <!-- Content area -->
               
                    <div class="content">

                        <!-- Simple login form -->
                        <div class="login-logo">
                        <div class="text-center" >
                            <a href="../../index2.html"><span style="font-size:38px;color:black;text-dexoration:none"><b >Marlen's</b></span><span style="font-size:30px;color:grey;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;font-weight:300"> coffee</span> </a>
                        </div>
                        </div>
                        <form action="{{url('/login_validate')}}" method="post">
                            {{csrf_field()}}
                            <div class="panel panel-body login-form">
                                
                                <div class="text-center">
                                    
                                    <div ><img src="{{ asset('images/logo.png')}}" width="80px" alt="User Image"></div>
                                    <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
                                </div>
                                @if(Session::has('msg'))
                            {!! Session::get('msg') !!} 
             @endif
                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="text" class="form-control" placeholder="Username" 	name="user_username" id="user_username"	
                                           @if($errors->any())
                                           value="{{old('user_username')}}""
                                           @elseif(!empty($records->user_username))
                                           value="{{$records->user_username}}"
                                           @endif />
                                           @if ($errors->has('user_username'))
                                           <span class="help-block">
                                        <strong style="color: #ff0000">{{ $errors->first('user_username') }}</strong>
                                    </span>
                                    @endif
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                </div>

                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="password" class="form-control" placeholder="Password" name="user_password" id="user_password"
                                           @if($errors->any())
                                           value="{{old('user_password')}}""
                                           @elseif(!empty($records->user_password))
                                           value="{{$records->user_password}}"
                                           @endif />
                                           @if ($errors->has('user_password'))
                                           <span class="help-block">
                                        <strong style="color: #ff0000">{{ $errors->first('user_password') }}</strong>
                                    </span>
                                    @endif
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
                                </div>

                                <!--<div class="text-center">-->
                                <!--    <a href="/fogot_password">Forgot password?</a>-->
                                <!--</div>-->
                            </div>
                        </form>
                        <!-- /simple login form -->


                        <!-- Footer -->
                        <div class="footer text-muted">
                            &copy; 2021. <a href="https://satasme.lk/">SATASME Web App </a>  <a href="" target="_blank"></a>
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

    </body>
    <script>
    $(document).ready(function(){
             $('#alert-msg').fadeIn().delay(3000).fadeOut();
     
		
    });
</script>
</html>
