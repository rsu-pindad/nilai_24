<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PT PINDAD MEDIKA UTAMA | {{ $title ?? 'RSU PINDAD' }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/dist/css/adminlte.min.css') }}">

    <link rel="icon" href="{{ asset('/dist/img/logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/dist/img/logo.png') }}" type="image/x-icon">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    @stack('styles')

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Popper -->
    <script src="{{ asset('/plugins/popper/umd/popper.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/dist/js/adminlte.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('/plugins/chart.js/Chart.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/plugins/pdfmake/vfs_fonts.js') }}"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-id_ID.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed ">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            @php
                $rememberState = true;
            @endphp
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"
                        data-enable-remember="{{ $rememberState }}"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('profile') }}" class="brand-link">
                <img src="{{ asset('/dist/img/logo.png') }}" alt="Logo" class="brand-image img-circle">
                <span class="brand-text font-weight-light">PINDAD
                    MEDIKA</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar text-uppercase">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (Auth::user()->level != 1)
                            <li class="nav-header">PENILAIAN</li>
                            @isset($sheet['LINK_SELF'])
                                @if ($sheet['LINK_SELF'] != '')
                                    <li class="nav-item {{ $page == 'SELF ASSESSMENT' ? 'menu-open' : '' }}">
                                        <a href="#"
                                            class="nav-link {{ $page == 'SELF ASSESSMENT' ? 'active' : '' }}">
                                            <i class="nav-icon fas fas fa-file-alt"></i>
                                            <p>
                                                MENILAI SENDIRI
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview small">
                                            <li class="nav-item ">
                                                <a href="{{ route('self', ['page' => 'SELF ASSESSMENT', 'link' => $sheet['LINK_SELF']]) }}"
                                                    class="LinkMenilai nav-link {{ $sheet['LINK_SELF'] == $link ? 'active' : '' }}"
                                                    data-npp="{{ Auth::user()->npp }}"
                                                    onclick="checkstatus(`{{ Auth::user()->npp }}`)">
                                                    <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="foto"
                                                        width="32" height="32" class="img-circle">
                                                    <p id="LinkNilaiSelf">
                                                        {{ Auth::user()->npp . ' - ' . Auth::user()->nama }}
                                                    </p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                            @endisset
                            @isset($sheet['LINK_ATASAN'])
                                @if ($sheet['LINK_ATASAN'] != '')
                                    <li class="nav-item {{ $page == 'MENILAI ATASAN' ? 'menu-open' : '' }} ">
                                        <a href="#" class="nav-link {{ $page == 'MENILAI ATASAN' ? 'active' : '' }}">
                                            <i class="nav-icon fas fas fa-file-alt"></i>
                                            <p>
                                                MENILAI ATASAN
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview small">
                                            <li class="nav-sheet">
                                                <a href="{{ route('atasan', ['page' => 'MENILAI ATASAN', 'link' => $sheet['LINK_ATASAN']]) }}"
                                                    class="LinkMenilai nav-link {{ $sheet['LINK_ATASAN'] == $link ? 'active' : '' }}"
                                                    data-npp="{{ $sheet['NPP_ATASAN'] }}"
                                                    onclick="checkstatus(`{{ $sheet['NPP_ATASAN'] }}`)">
                                                    @if (App\Models\User::where('npp', $sheet['NPP_ATASAN'])->first())
                                                        <img src="{{ asset('storage/' . App\Models\User::where('npp', $sheet['NPP_ATASAN'])->first()->foto) }}"
                                                            alt="foto" width="32" height="32" class="img-circle">
                                                    @else
                                                        <img src="dist/img/avatar.png" alt="foto" width="32"
                                                            height="32" class="img-circle">
                                                    @endif
                                                    <p id="LinkNilaiAtasan">{{ $sheet['NPP_ATASAN'] }} -
                                                        {{ optional(App\Models\RelasiKaryawan::where('npp_karyawan', $sheet['NPP_ATASAN'])->first())->nama_karyawan }}
                                                    </p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                            @endisset
                            @isset($sheet['LINK_SELEVEL'])
                                @if ($sheet['LINK_SELEVEL'] != null)
                                    <li class="nav-item {{ $page == 'MENILAI SELEVEL' ? 'menu-open' : '' }}">
                                        <a href="#"
                                            class="nav-link  {{ $page == 'MENILAI SELEVEL' ? 'active' : '' }}">
                                            <i class="nav-icon fas fas fa-file-alt"></i>
                                            <p>
                                                MENILAI SELEVEL
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview small">
                                            <li class="nav-item">
                                                <a href="{{ route('selevel', ['page' => 'MENILAI SELEVEL', 'link' => $sheet['LINK_SELEVEL']]) }}"
                                                    class="LinkMenilai nav-link {{ $sheet['LINK_SELEVEL'] == $link ? 'active' : '' }}"
                                                    data-npp="{{ $sheet['NPP_SELEVEL'] }}"
                                                    onclick="checkstatus(`{{ $sheet['NPP_SELEVEL'] }}`)">
                                                    @if (App\Models\User::where('npp', $sheet['NPP_SELEVEL'])->first())
                                                        <img src="{{ asset('storage/' . App\Models\User::where('npp', $sheet['NPP_SELEVEL'])->first()->foto) }}"
                                                            alt="foto" width="32" height="32"
                                                            class="img-circle">
                                                    @else
                                                        <img src="dist/img/avatar.png" alt="foto" width="32"
                                                            height="32" class="img-circle">
                                                    @endif
                                                    <p id="LinkNilaiSelevel">{{ $sheet['NPP_SELEVEL'] }} -
                                                        {{ optional(App\Models\RelasiKaryawan::where('npp_karyawan', $sheet['NPP_SELEVEL'])->first())->nama_karyawan }}
                                                    </p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                            @endisset
                            @if (count($staff_data) > 0)
                                <li class="nav-item {{ $page == 'MENILAI STAFF' ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link  {{ $page == 'MENILAI STAFF' ? 'active' : '' }}">
                                        <i class="nav-icon fas fas fa-file-alt"></i>
                                        <p>
                                            MENILAI STAFF
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview small">
                                        @foreach ($staff_data as $item)
                                            @if ($item['LINK_STAFF'] && $item['LINK_STAFF'] != '#N/A')
                                                <li class="nav-item">
                                                    <a href="{{ route('staff', ['page' => 'MENILAI STAFF', 'link' => $item['LINK_STAFF']]) }}"
                                                        class="LinkMenilai nav-link {{ $item['LINK_STAFF'] == $link ? 'active' : '' }}"
                                                        data-npp="{{ $item['NPP_STAFF'] }}"
                                                        onclick="checkstatus(`{{ $item['NPP_STAFF'] }}`)">
                                                        @if (App\Models\User::where('npp', $item['NPP_STAFF'])->first())
                                                            <img src="{{ asset('storage/' . App\Models\User::where('npp', $item['NPP_STAFF'])->first()->foto) }}"
                                                                alt="foto" width="32" height="32"
                                                                class="img-circle">
                                                        @else
                                                            <img src="dist/img/avatar.png" alt="foto"
                                                                width="32" height="32" class="img-circle">
                                                        @endif
                                                        <p class="LinkNilaiStaff">{{ $item['NPP_STAFF'] }} -
                                                            {{ optional(App\Models\RelasiKaryawan::where('npp_karyawan', $item['NPP_STAFF'])->first())->nama_karyawan }}
                                                        </p>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endif
                        @if (Auth::user()->level == 1)
                            <li class="nav-header">INTERFACE</li>
                            @include('templates.partials.sidebar-hc')
                        @endif
                        @if (Auth::user()->level != 1)
                            <li class="nav-header">NILAI</li>
                            <li class="nav-item">
                                <a href="{{ url('/nilai-rekap/' . Auth::user()->npp) }}"
                                    class="nav-link {{ Route::currentRouteName() == 'penilai-rekap-rekapitulasi' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book-open"></i>
                                    <p>Rekapitulasi</p>
                                </a>
                            </li>
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
                                <i class="fas fa-info-circle"></i> Bantuan
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

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <a href="https://pindadmedika.com">PT PINDAD MEDIKA UTAMA</a>.</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    @stack('modals')

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
    @stack('scripts')
</body>

</html>
