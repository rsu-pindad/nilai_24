@extends('templates.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'Rekap Skor Akhir DP3' }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex flex-row bd-highlight">
                                    <div class="px-2">
                                        <button type="button" class="btn btn-secondary mb-4" id="btnRekapPerilakuModal">
                                            <i class="far fa-plus-square"></i> Hitung Skor Akhir DP3
                                        </button>
                                    </div>
                                    <div class="px-2">
                                        <div class="btn-group mr-2" role="group" aria-label="Second group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-file-export px-1"></i>Export
                                            </button>
                                            <div class="dropdown-menu">
                                                <span class="dropdown-item-text">Raw Skor Akhir DP3</span>
                                                <form action="{{ route('penilai-rekap-personal-export-raw-xlsx') }}" method="post"
                                                    class="dropdown-item btn btn-outline-info"
                                                    enctype="multipart/form-data"
                                                    target="_blank">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">format (.xlsx)
                                                    </button>
                                                </form>
                                                <form action="{{ route('penilai-rekap-personal-export-raw-csv') }}" method="post"
                                                    class="dropdown-item btn btn-outline-info"
                                                    enctype="multipart/form-data"
                                                    target="_blank">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">format (.csv)
                                                    </button>
                                                </form>
                                                <div class="dropdown-divider"></div>
                                                <span class="dropdown-item-text">Group DP3</span>
                                                <form action="{{ route('penilai-rekap-personal-export-xlsx') }}" method="post"
                                                    class="dropdown-item btn btn-outline-info"
                                                    enctype="multipart/form-data"
                                                    target="_blank">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">format (.xlsx)
                                                    </button>
                                                </form>
                                                <form action="{{ route('penilai-rekap-personal-export-csv') }}" method="post"
                                                    class="dropdown-item btn btn-outline-info"
                                                    enctype="multipart/form-data"
                                                    target="_blank">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">format (.csv)
                                                    </button>
                                                </form>
                                                <span class="dropdown-item-text">Group DP3 + Missed Penilai</span>
                                                <form action="{{ route('penilai-rekap-personal-complete-export-xlsx') }}" method="post"
                                                    class="dropdown-item btn btn-outline-info"
                                                    enctype="multipart/form-data"
                                                    target="_blank">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">format (.xlsx)
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-2">
                                        <div class="btn-group mr-2" role="group" aria-label="Third group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-download px-1"></i>Template
                                            </button>
                                            <div class="dropdown-menu">
                                                <span class="dropdown-item-text">Format</span>
                                                <form action="{{ route('penilai-rekap-personal-word-doc') }}" method="post"
                                                    class="dropdown-item btn btn-outline-info"
                                                    enctype="multipart/form-data"
                                                    target="_blank">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">
                                                        <i class="fas fa-file-word"></i> Word (.docx)
                                                    </button>
                                                </form>
                                                <form action="{{ route('penilai-rekap-personal-template-pdf') }}" method="post"
                                                    class="dropdown-item btn btn-outline-info"
                                                    enctype="multipart/form-data"
                                                    target="_blank">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">
                                                        <i class="fas fa-file-pdf"></i> Pdf (.pdf)
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover table-bordered" id="dataTablesRekap2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Npp Dinilai</th>
                                            <th>Nama Dinilai</th>
                                            <th>Jabatan Dinilai</th>
                                            <th>Rata-rata Skor DP3</th>
                                            <th>Max Skor DP3 (Markup)</th>
                                            <th>Point Skor DP3 (Markup)</th>
                                            <th>Kriteria Skor DP3 (Markup)</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $object = (object) $personal;
                                        // dd($object);
                                        @endphp
                                        @forelse ($object as $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $p['npp_karyawan'] }}</td>
                                                <td>{{ $p['nama_karyawan'] }}</td>
                                                <td>{{ $p['level_jabatan'] }}</td>
                                                <td>{{ $p['total'] }}</td>
                                                <td>{{ $p['total_raspek'] }}</td>
                                                <td>{{ $p['point_dp3'] }}</td>
                                                <td>{{ $p['kriteria_dp3'] }}</td>
                                                <td class="px-2">
                                                    <div class="btn-toolbar d-flex justify-content-around" role="toolbar"
                                                        arua-label="grup satu">
                                                        <div class="btn-group mr-2" role="group" aria-label="group aksi">
                                                            <a href="/penilai-rekap/report?id={{ $p['npp_dinilai_id'] }}&npp={{ $p['npp_karyawan'] }}"
                                                                target="_blank" class="btn btn-sm btn-danger">
                                                                <i class="far fa-file-pdf"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@push('scripts')
    <script>
        $("#dataTablesRekap2").DataTable({
            ordering: true,
            scrollCollapse: true,
            searching: true,
            scrollX: false,
        });
    </script>
@endpush

@push('scripts')
    <script>
        $(document).ready(function(e) {
            async function swalAjax() {
                const uri = '/penilai-rekap/calculate-dp3';
                $.ajax({
                    url: uri,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response)
                        // let text = JSON.stringify(response.text)
                        let text = response.text;
                        var lastText = text[text.length - 1]
                        console.log(lastText);
                        swalOk(response.title, lastText, response.icon);
                        setTimeout(() => {
                            location.reload()
                        }, 10000);
                    },
                    error: function(response) {
                        // let text = JSON.stringify(response.text)
                        let text = response.text;
                        var lastText = text[text.length - 1]
                        swalOk(response.title, lastText, response.icon)
                        setTimeout(() => {
                            location.reload()
                        }, 10000);
                    }
                });
            }

            async function swalOk(title, text, icon) {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: icon
                });
            }

            async function alertswal(title, text, icon, confirmButtonText) {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: icon,
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: "batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(() => {
                            swalAjax();
                        }, 3000);
                        // swalOk();
                    }else {
                        $('#btnRekapPerilakuModal').prop("disabled", false);
                    }
                });
            }

            $('#btnRekapPerilakuModal').on('click', function(ev) {
                ev.preventDefault();
                $(this).prop("disabled", true);
                alertswal(
                    'anda yakin',
                    'anda melakukan rekap penilaian akhir',
                    'warning',
                    'iya'
                );
            });
        });
    </script>
@endpush
