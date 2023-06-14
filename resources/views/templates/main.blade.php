<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PT PINDAD MEDIKA UTAMA | {{ $title }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <link rel="icon" href="dist/img/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="dist/img/logo.png" type="image/x-icon">


</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed ">
    <div class="wrapper">

        {{-- <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
        </div> --}}

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>


        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('profile') }}" class="brand-link">
                <img src="dist/img/logo.png" alt="Logo" class="brand-image img-circle">

                <span class="brand-text font-weight-light">PINDAD
                    MEDIKA</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-header">INTERFACE</li>
                        <li class="nav-item  {{ $page == 'SELF ASSESSMENT' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $page == 'SELF ASSESSMENT' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-sticky-note"></i>
                                <p>
                                    LINK SELF ASSESSMENT
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <?php $count = 0; ?>
                                @foreach ($sheet as $item)
                                    @if ($item['LINK_SELF-ASSESSMENT'] && $item['LINK_SELF-ASSESSMENT'] != '#N/A')
                                        <?php if ($count == 1) {
                                            break;
                                        } ?>
                                        <li class="nav-item ">
                                            <a href="{{ route('self', ['page' => 'SELF ASSESSMENT', 'link' => $item['LINK_SELF-ASSESSMENT']]) }}"
                                                class="nav-link {{ $item['LINK_SELF-ASSESSMENT'] == $link ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="foto"
                                                    width="32" height="32" class="img-circle">
                                                <p>{{ Auth::user()->npp . ' - ' . Auth::user()->nama }}
                                                </p>
                                            </a>
                                        </li>
                                        <?php $count++; ?>
                                    @endif
                                @endforeach
                            </ul>
                        </li>

                        <li class="nav-item  {{ $page == 'MENILAI ATASAN' ? 'menu-open' : '' }} ">
                            <a href="#" class="nav-link {{ $page == 'MENILAI ATASAN' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-sticky-note"></i>
                                <p>
                                    LINK MENILAI ATASAN
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach ($sheet as $item)
                                    @if ($item['LINK_MENILAI_ATASAN'] && $item['LINK_MENILAI_ATASAN'] != '#N/A')
                                        <li class="nav-item">
                                            <a href="{{ route('atasan', ['page' => 'MENILAI ATASAN', 'link' => $item['LINK_MENILAI_ATASAN']]) }}"
                                                class="nav-link {{ $item['LINK_MENILAI_ATASAN'] == $link ? 'active' : '' }}">
                                                @if (App\Models\User::where('npp', $item['NPP_ATASAN'])->first())
                                                    <img src="{{ asset('storage/' . App\Models\User::where('npp', $item['NPP_ATASAN'])->first()->foto) }}"
                                                        alt="foto" width="32" height="32" class="img-circle">
                                                @else
                                                    <img src="dist/img/avatar.png" alt="foto" width="32"
                                                        height="32" class="img-circle">
                                                @endif
                                                <p>{{ $item['NPP_ATASAN'] }} -
                                                    {{ optional(App\Models\Employee::where('npp', $item['NPP_ATASAN'])->first())->nama }}
                                                </p>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>

                        <li class="nav-item {{ $page == 'MENILAI SELEVEL' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link  {{ $page == 'MENILAI SELEVEL' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-sticky-note"></i>
                                <p>
                                    LINK MENILAI SELEVEL
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach ($sheet as $item)
                                    @if ($item['LINK_MENILAI_SELEVEL'] && $item['LINK_MENILAI_SELEVEL'] != '#N/A')
                                        <li class="nav-item">
                                            <a href="{{ route('selevel', ['page' => 'MENILAI SELEVEL', 'link' => $item['LINK_MENILAI_SELEVEL']]) }}"
                                                class="nav-link {{ $item['LINK_MENILAI_SELEVEL'] == $link ? 'active' : '' }} ">
                                                @if (App\Models\User::where('npp', $item['NPP_SELEVEL'])->first())
                                                    <img src="{{ asset('storage/' . App\Models\User::where('npp', $item['NPP_SELEVEL'])->first()->foto) }}"
                                                        alt="foto" width="32" height="32" class="img-circle">
                                                @else
                                                    <img src="dist/img/avatar.png" alt="foto" width="32"
                                                        height="32" class="img-circle">
                                                @endif
                                                <p>{{ $item['NPP_SELEVEL'] }} -
                                                    {{ optional(App\Models\Employee::where('npp', $item['NPP_SELEVEL'])->first())->nama }}
                                                </p>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item {{ $page == 'MENILAI STAFF' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link  {{ $page == 'MENILAI STAFF' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-sticky-note"></i>
                                <p>
                                    LINK MENILAI STAFF
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach ($sheet as $item)
                                    @if ($item['LINK_MENILAI_STAFF'] && $item['LINK_MENILAI_STAFF'] != '#N/A')
                                        <li class="nav-item">
                                            <a href="{{ route('staff', ['page' => 'MENILAI STAFF', 'link' => $item['LINK_MENILAI_STAFF']]) }}"
                                                class="nav-link {{ $item['LINK_MENILAI_STAFF'] == $link ? 'active' : '' }}">
                                                @if (App\Models\User::where('npp', $item['NPP_STAFF'])->first())
                                                    <img src="{{ asset('storage/' . App\Models\User::where('npp', $item['NPP_STAFF'])->first()->foto) }}"
                                                        alt="foto" width="32" height="32"
                                                        class="img-circle">
                                                @else
                                                    <img src="dist/img/avatar.png" alt="foto" width="32"
                                                        height="32" class="img-circle">
                                                @endif
                                                <p>{{ $item['NPP_STAFF'] }} -
                                                    {{ optional(App\Models\Employee::where('npp', $item['NPP_STAFF'])->first())->nama }}
                                                </p>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-header">SETTINGS</li>
                        <li class="nav-item">
                            <a href="{{ route('profile') }}"
                                class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2023 <a href="https://pindadmedika.com">PT PINDAD MEDIKA UTAMA</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    {{-- <script src="dist/js/demo.js"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="dist/js/pages/dashboard2.js"></script> --}}

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    @include('sweetalert::alert')
</body>

</html>
