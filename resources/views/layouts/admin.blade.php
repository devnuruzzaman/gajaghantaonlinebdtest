<?php
use App\Models\Setting;
use App\Models\User;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ Setting::get('site_name', 'ISP Management System') }} - @yield('title', 'Admin Panel')</title>
    
    @if(Setting::get('favicon'))
    <link rel="icon" href="{{ asset(Setting::get('favicon')) }}">
    @endif
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6/css/all.min.css">
    <!-- AdminLTE Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="https://via.placeholder.com/50" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Not available</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 5 mins ago</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <!-- Fullscreen -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <!-- User Account Menu -->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ Auth::user()->profile_photo_url }}" class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2" alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since {{ Auth::user()->created_at->format('M Y') }}</small>
                        </p>
                    </li>

                    <!-- Menu Body
                    <li class="user-body">
                        <div class="row">
                            <div class="col-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </div>
                    </li> -->
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="{{ route('admin.profile.edit') }}" class="btn btn-default btn-flat">Profile</a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-default btn-flat float-right">Sign out</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            @if(Setting::get('logo'))
            <img src="{{ asset(Setting::get('logo')) }}" alt="{{ Setting::get('site_name', 'ISP Management System') }}" class="brand-image img-circle elevation-3" style="opacity: .8">
            @else
            <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE" class="brand-image img-circle elevation-3" style="opacity: .8">
            @endif
            <span class="brand-text font-weight-light">{{ Setting::get('site_name', 'ISP Management') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    @can('settings.view')
                    <li class="nav-item">
                        <a href="{{ route('admin.settings.index') }}" class="nav-link @if(request()->routeIs('admin.settings.*')) active @endif">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                    @endcan
                    @can('customers.view')
                    <li class="nav-item">
                        <a href="#" class="nav-link @if(request()->routeIs('admin.customers.*')) active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Customers
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.customers.index') }}" class="nav-link @if(request()->routeIs('admin.customers.index')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Customers</p>
                                </a>
                            </li>
                            @can('customers.create')
                            <li class="nav-item">
                                <a href="{{ route('admin.customers.create') }}" class="nav-link @if(request()->routeIs('admin.customers.create')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Customer</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('packages.view')
                    <li class="nav-item">
                        <a href="#" class="nav-link @if(request()->routeIs('admin.packages.*')) active @endif">
                            <i class="nav-icon fas fa-box"></i>
                            <p>
                                Packages
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.packages.index') }}" class="nav-link @if(request()->routeIs('admin.packages.index')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Packages</p>
                                </a>
                            </li>
                            @can('packages.create')
                            <li class="nav-item">
                                <a href="{{ route('admin.packages.create') }}" class="nav-link @if(request()->routeIs('admin.packages.create')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Package</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('routers.view')
                    <li class="nav-item">
                        <a href="#" class="nav-link @if(request()->routeIs('admin.routers.*')) active @endif">
                            <i class="nav-icon fas fa-wifi"></i>
                            <p>
                                Routers
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.routers.index') }}" class="nav-link @if(request()->routeIs('admin.routers.index')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Routers</p>
                                </a>
                            </li>
                            @can('routers.create')
                            <li class="nav-item">
                                <a href="{{ route('admin.routers.create') }}" class="nav-link @if(request()->routeIs('admin.routers.create')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Router</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('billing.view')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice-dollar"></i>
                            <p>
                                Billing
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.invoices.index') }}" class="nav-link @if(request()->routeIs('admin.invoices.*')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Invoices</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.payments.index') }}" class="nav-link @if(request()->routeIs('admin.payments.*')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Payments</p>
                                </a>
                            </li>
                            @can('billing.create')
                            <li class="nav-item">
                                <a href="{{ route('admin.invoices.create') }}" class="nav-link @if(request()->routeIs('admin.invoices.create')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Generate Invoice</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                </ul>
            </nav>
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title', 'Dashboard')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">@yield('breadcrumb', 'Dashboard')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; {{ date('Y') }} {{ Setting::get('site_name', 'ISP Management') }}.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- AdminLTE initialization -->
<script>
    $(document).ready(function() {
        // Initialize AdminLTE
        const layout = $('body').AdminLTE({
            // Uncomment to change options
            // sidebarSlim: true,
            controlSidebarOptions: {
                // Control Sidebar options
                slide: true
            }
        });
        
        // Initialize data-widget attributes
        $('[data-widget="pushmenu"]').PushMenu();
        $('[data-widget="control-sidebar"]').ControlSidebar();
        $('[data-widget="fullscreen"]').Fullscreen();
    });
</script>

@yield('scripts')

</body>
</html>
