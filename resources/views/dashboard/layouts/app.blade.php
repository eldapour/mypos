<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @if(Route::currentRouteName() == 'dashboard.home')
        <title>@lang('site.dashboard')</title>
    @else
        <title>@lang('site.control_panel')</title>
    @endif
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Skin -->
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- summernote - text editor -->
    <link href="{{ asset('plugins/summernote/summernote.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
    <!-- Noty Notification-->
    <link href="{{asset('noty.css')}}" rel="stylesheet">
    <script src="{{ asset('noty.js') }}" type="text/javascript"></script>
    <!-- CKEditor-->
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    <!-- ARABIC SIDE -->
    @if(app()->getLocale() == 'ar')
    <!-- RTL MODE -->
    <link rel="stylesheet" href="{{ asset('rtl/dist/css/AdminLTE.css') }}">
    <link rel="stylesheet" href="{{ asset('rtl/dist/css/bootstrap-rtl.min.css') }}">
    @else
            <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    @endif
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ route('dashboard.home') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b></b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>myPOS</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    @if(Route::currentRouteName() == 'dashboard.home')
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="label label-warning">{{ $order_count}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">@lang('site.orders_count'){{ $order_count }} </li>
                            <li>
                                <ul class="menu">
                                    @foreach($orders as $order)
                                    <li>
                                        <a href="{{ route('dashboard.orders.index', $order->id) }}">
                                            <i class="fa fa-shopping-cart text-green"></i>
                                            {{ $order->client->name }} @lang('site.total') {{ $order->total_price }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="footer"><a href="{{ route('dashboard.orders.index') }}">@lang('site.view_all')</a></li>
                        </ul>
                    </li>
                    @endif
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('uploads/users_images/' . auth()->user()->image) }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ asset('uploads/users_images/' . auth()->user()->image) }}" class="img-circle" alt="User Image">
                                <p>
                                    {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}- Backend Web Developer
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="text-center w-auto">
                                    <a  href="{{ route('dashboard.logout') }}" class="btn btn-danger btn-flat">@lang('site.logout')</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

<!-- /HEADER -->
<!-- MAIN -->

@extends('dashboard.layouts._aside')

@yield('content')

@include('dashboard.include.session')

<!-- /MAIN -->

<!-- FOOTER -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2021-2022 <a href="https://github.com/el-dapour/">Abdullah Mahmoud</a>.</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <div class="tab-content">
        <div class="tab-pane" id="control-sidebar-home-tab"></div>
    </div>
</aside>
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/summernote/summernote.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>

<script src="{{ asset('rtl/dist/js/app.min.js') }}"></script>

<script src="{{ asset('bower_components/chart.js/Chart.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>
<!-- Noty -->
<script src="{{ asset('noty.js') }}" type="text/javascript"></script>
<!-- OSS -->
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
{{-- order pages --}}
<script src="{{ asset('dist/js/custom/order.js') }}"></script>
{{-- juery numper --}}
<script src="{{ asset('dist/js/custom/jquery.number.js') }}"></script>
{{-- Print This --}}
<script src="{{ asset('dist/js/printThis.js') }}"></script>
<script>
    CKEDITOR.config.language = "{{ app()->getLocale() }}";
</script>
</body>
</html>

