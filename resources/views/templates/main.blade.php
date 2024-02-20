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
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

    <link rel="icon" href="dist/img/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="dist/img/logo.png" type="image/x-icon">

    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed ">
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
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i></a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('profile') }}" class="brand-link">
                <img src="../../dist/img/logo.png" alt="Logo" class="brand-image img-circle">

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
                        <div style="display: none;">
                            <li class="nav-item {{ $page == 'SELF ASSESSMENT' ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ $page == 'SELF ASSESSMENT' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-sticky-note"></i>
                                    <p>
                                        LINK SELF ASSESSMENT
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview small">
                                    <?php $count = 0; ?>
                                    @foreach ($sheet as $item)
                                        @if ($item['LINK_SELF-ASSESSMENT'] && $item['LINK_SELF-ASSESSMENT'] != '#N/A')
                                            <?php if ($count == 1) {
                                                break;
                                            } ?>
                                            <li class="nav-item ">
                                                <a href="{{ route('self', ['page' => 'SELF ASSESSMENT', 'link' => $item['LINK_SELF-ASSESSMENT']]) }}"
                                                    class="nav-link {{ $item['LINK_SELF-ASSESSMENT'] == $link ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                                                        alt="foto" width="32" height="32" class="img-circle">
                                                    <p>{{ Auth::user()->npp . ' - ' . Auth::user()->nama }}
                                                    </p>
                                                </a>
                                            </li>
                                            <?php $count++; ?>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item {{ $page == 'MENILAI ATASAN' ? 'menu-open' : '' }} ">
                                <a href="#" class="nav-link {{ $page == 'MENILAI ATASAN' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-sticky-note"></i>
                                    <p>
                                        LINK MENILAI ATASAN
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview small">
                                    @foreach ($sheet as $item)
                                        @if ($item['LINK_MENILAI_ATASAN'] && $item['LINK_MENILAI_ATASAN'] != '#N/A')
                                            <li class="nav-item">
                                                <a href="{{ route('atasan', ['page' => 'MENILAI ATASAN', 'link' => $item['LINK_MENILAI_ATASAN']]) }}"
                                                    class="nav-link {{ $item['LINK_MENILAI_ATASAN'] == $link ? 'active' : '' }}">
                                                    @if (App\Models\User::where('npp', $item['NPP_ATASAN'])->first())
                                                        <img src="{{ asset('storage/' . App\Models\User::where('npp', $item['NPP_ATASAN'])->first()->foto) }}"
                                                            alt="foto" width="32" height="32"
                                                            class="img-circle">
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
                                <ul class="nav nav-treeview small">
                                    @foreach ($sheet as $item)
                                        @if ($item['LINK_MENILAI_SELEVEL'] && $item['LINK_MENILAI_SELEVEL'] != '#N/A')
                                            <li class="nav-item">
                                                <a href="{{ route('selevel', ['page' => 'MENILAI SELEVEL', 'link' => $item['LINK_MENILAI_SELEVEL']]) }}"
                                                    class="nav-link {{ $item['LINK_MENILAI_SELEVEL'] == $link ? 'active' : '' }} ">
                                                    @if (App\Models\User::where('npp', $item['NPP_SELEVEL'])->first())
                                                        <img src="{{ asset('storage/' . App\Models\User::where('npp', $item['NPP_SELEVEL'])->first()->foto) }}"
                                                            alt="foto" width="32" height="32"
                                                            class="img-circle">
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
                                <ul class="nav nav-treeview small">
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
                        </div>
                        @if (Auth::user()->level == 1)
                            @include('templates.partials.sidebar-hc')
                        @endif

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
                        <li class="text-center">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#popup">
                                <i class="fas fa-info-circle"></i> Help
                            </button>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Modal -->
        <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <h2>Selamat Datang</h2>
                            <p>
                                Anda berada di portal penilaian tahunan karyawan <b>PT Pindad Medika Utama</b>.
                                dalam penilaian ini anda akan menilai dan dinilai dari beberapa kriteria yang
                                ditetapkan.
                                Pilihlah pernyataan yang sesuai, yang menggambarkan kondisi objek penilaian.
                                Untuk mendapatkan nilai yang utuh, setiap karyawan melakukan penilaian terhadap :
                            </p>
                            <ol>
                                <li>
                                    Diri sendiri (self assessment), isilah bagian ini secara jujur sebagaimana anda apa
                                    adanya
                                    sesuai kondisi sebenarnya yang relevan dengan kriteria penilaian yang ditetapkan
                                    pada
                                    bagian
                                    deskripsi.
                                </li>
                                <li>
                                    Atasan, isilah bagian ini secara jujur sebagaimana atasan anda apa adanya sesuai
                                    kondisi
                                    sebenarnya yang relevan dengan kriteria penilaian yang ditetapkan pada bagian
                                    deskripsi.
                                </li>
                                <li>
                                    Rekan kerja, isilah bagian ini secara jujur sebagaimana rekan kerja anda apa adanya
                                    sesuai
                                    kondisi sebenarnya yang relevan dengan kriteria penilaian yang ditetapkan pada
                                    bagian
                                    deskripsi.
                                </li>
                                <li>
                                    Bawahan, isilah bagian ini secara jujur sebagaimana staff anda apa adanya sesuai
                                    kondisi
                                    sebenarnya yang relevan dengan kriteria penilaian yang ditetapkan pada bagian
                                    deskripsi.
                                </li>
                            </ol>
                            <p>
                                Keterangan : pemilihan untuk siapa rekan kerja yang dinilai, dipilih berdasarkan
                                kriteria
                                tertentu dengan pertimbangan seringnya koordinasi perihal pekerjaan dan interaksi, serta
                                level
                                jabatan.
                            </p>

                            <p>

                                Jika ada hal yang kurang jelas maupun permasalahan dalam melakukan penilaian ini,
                                silakan
                                klik
                                <a href="https://wa.me/6282240028580" target="_blank"
                                    rel="noopener noreferrer">disini</a>
                                untuk
                                pelaporan kendala.
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Konten Di Sini --}}
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

        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="../../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="../../plugins/raphael/raphael.min.js"></script>
    <script src="../../plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="../../plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="../../plugins/chart.js/Chart.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-id_ID.min.js"></script>

    <script>
        $("#dataTables").DataTable({});
        $("#dataTables2").DataTable({});
    </script>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script>
        $(document).ready(function() {
            var isshow = localStorage.getItem('isshow');
            if (isshow == null) {
                localStorage.setItem('isshow', 1);

                // Show popup here
                $('#popup').modal('show');
            }
        });
    </script>

    @include('sweetalert::alert')
</body>

</html>
