<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Donut POS</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('/')}}plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('/')}}dist/css/adminlte.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        
    

        @livewireStyles
        @yield('css')

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            @if (Route::has('login'))
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                @auth
                <!-- ถ้าเข้าสู่ระบบ -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{url('/')}}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="#" class="nav-link" onclick="event.preventDefault();this.closest('form').submit();" >{{ __('Log Out') }}</a>
                        </form>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                </ul>
                @else
                <!-- ถ้าไม่ได้เข้าสู่ระบบ -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{url('/')}}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('login') }}" class="nav-link">Log in</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </li>
                    @endif
                </ul>
                
                @endauth
            </nav>
            @endif
            <!-- /.navbar -->

            @if (Route::has('login'))
            <!-- Main Sidebar Container -->
            @auth
            <!-- ถ้าเข้าสู่ระบบ -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{url('/')}}" class="brand-link">
                    <img src="{{url('/')}}/dist/img/AdminLTELogo.png" alt="DonutBlog Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light"><b>Donut</b>POS</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{url('/')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                                alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{Auth::user()->name}}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                            <li class="nav-item menu-open">
                                <a href="{{ route('dashboard') }}" class="nav-link menu-open">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        {{ __('Dashboard') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Account Management
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('profile.show') }}"  class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('Profile') }}</p>
                                        </a>
                                    </li>
                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <li class="nav-item">
                                        <a href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('API Tokens') }}</p>
                                        </a>
                                    </li>
                                    @endif
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Boxed</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Fixed Sidebar</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('order-control') }}" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>
                                        ขายสินค้า
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>
                                        Employee Type
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('enterprise') }}" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>
                                        Enterprise
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('promotions') }}" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>
                                        Promotions
                                    </p>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Products
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('products') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>products</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('products-group') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>products group</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                         Employee
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('emp') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> Add  Employee</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>employee type</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>consumers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>inventory orders</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('payment-type') }}" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>payment type</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
            @else
            <!-- ถ้าไม่ได้เข้าสู่ระบบ -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{url('/')}}" class="brand-link">
                    <img src="{{url('/')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light"><b>Donut</b>Blog</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">
                                    <!-- <i class="nav-icon fas faslock fa-th"></i> -->
                                    <i class="nav-icon fas fa-sign-in-alt"></i>
                                    <p>
                                        Login
                                    </p>
                                </a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">
                                    <!-- <i class="nav-icon fas fa-th"></i> -->
                                    <i class="nav-icon fas fa-user-plus"></i>
                                    <p>
                                        Register
                                    </p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
            @endauth
            @endif

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('contents')
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 3.1.0-rc
                </div>
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
                reserved.
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        @stack('modals')
        
        <!-- jQuery -->
        <script src="{{asset('/')}}plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('/')}}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('/')}}dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{asset('/')}}dist/js/demo.js"></script>

        @livewireScripts
        @yield('js')
    </body>
</html>
