@extends('templates.main')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title ?? 'Tabel Perhitungan Skor Karyawan' }}</h1>
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
                <div class="btn-toolbar"
                     role="toolbar"
                     aria-label="Toolbar with button groups">
                  <div class="btn-group mr-2"
                       role="group"
                       aria-label="First group">
                    <button id="btnSkorPoolModal"
                            type="button"
                            class="btn btn-warning">
                      <i class="fas fa-calculator px-1"></i>Hitung
                    </button>
                  </div>
                  <div class="btn-group mr-2"
                       role="group"
                       aria-label="Second group">
                    <button type="button"
                            class="btn btn-secondary dropdown-toggle"
                            data-toggle="dropdown"
                            aria-expanded="false">
                      <i class="fas fa-file-export px-1"></i>Export
                    </button>
                    <div class="dropdown-menu">
                      <form action="{{ route('skor-export', ['sort' => 'penilai']) }}"
                            method="post"
                            class="dropdown-item btn btn-outline-info"
                            enctype="multipart/form-data"
                            target="_blank">
                        @csrf
                        <button type="submit"
                                class="btn btn-sm">format (.xlsx) sort by penilai
                        </button>
                      </form>
                      <form action="{{ route('skor-export', ['sort' => 'dinilai']) }}"
                            method="post"
                            class="dropdown-item btn btn-outline-info"
                            enctype="multipart/form-data"
                            target="_blank">
                        @csrf
                        <button type="submit"
                                class="btn btn-sm">format (.xlsx) sort by dinilai
                        </button>
                      </form>
                      <div class="dropdown-divider"></div>
                      <form action="{{ route('skor-export-csv', ['sort' => 'penilai']) }}"
                            method="post"
                            class="dropdown-item btn btn-outline-info"
                            enctype="multipart/form-data"
                            target="_blank">
                        @csrf
                        <button type="submit"
                                class="btn btn-sm">format (.csv) sort by penilai
                        </button>
                      </form>
                      <form action="{{ route('skor-export-csv', ['sort' => 'dinilai']) }}"
                            method="post"
                            class="dropdown-item btn btn-outline-info"
                            enctype="multipart/form-data"
                            target="_blank">
                        @csrf
                        <button type="submit"
                                class="btn btn-sm">format (.csv) sort by dinilai
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <table id="dataTablesPoolSkor"
                       class="table-striped table-hover table-bordered table">
                  <thead>
                    {{-- <tr>
                                            <th></th>
                                            <th colspan="3">Penilai</th>
                                            <th colspan="5">Dinilai</th>
                                            <th colspan="16"></th>
                                        </tr> --}}
                    <tr>
                      <th>No</th>
                      <th>Npp Penilai</th>
                      <th>Nama Penilai</th>
                      <th>Jabatan Penilai</th>
                      <th>Npp Dinilai</th>
                      <th>Nama Dinilai</th>
                      <th>Jabatan Dinilai</th>
                      <th>Relasi</th>
                      <th>Jumlah</th>
                      <th>K1</th>
                      <th>K2</th>
                      <th>K3</th>
                      <th>K4</th>
                      <th>K5</th>
                      <th>K6</th>
                      <th>P1</th>
                      <th>P2</th>
                      <th>P3</th>
                      <th>P4</th>
                      <th>P5</th>
                      <th>S1</th>
                      <th>S2</th>
                      <th>S3</th>
                      <th>S4</th>
                      <th>S5</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_pool_skor as $pool)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pool->karyawan->npp_karyawan }}<br />
                          <div class="btn-group-vertical"
                               role="group">
                            <button data-id="{{ $pool->id }}"
                                    data-npp-penilai="{{ $pool->karyawan->npp_karyawan }}"
                                    data-npp-dinilai="{{ $pool->karyawan_dinilai->npp_karyawan }}"
                                    type="button"
                                    class="btn btn-sm btn-primary btnFollowUp">
                              <i class="fab fa-whatsapp-square"></i>
                              Follow Up
                            </button>
                            <button data-id="{{ $pool->id }}"
                                    type="button"
                                    class="btn btn-sm btn-danger btnDeleteNilai">
                              <i class="fas fa-trash-alt"></i>
                              Hapus
                            </button>
                          </div>
                        </td>
                        <td>{{ $pool->karyawan->nama_karyawan }}</td>
                        <td>{{ $pool->karyawan->level_jabatan }}</td>
                        <td>
                          {{ $pool->karyawan_dinilai->npp_karyawan ?? 'mohon tarik relasi karyawan' }}
                        </td>
                        <td>
                          {{ $pool->karyawan_dinilai->nama_karyawan ?? 'mohon tarik relasi karyawan' }}
                        </td>
                        <td>{{ $pool['jabatan_dinilai'] }}</td>
                        <td>
                          @if ($pool['relasi'] == 'self')
                            <p>
                              <span class="badge badge-warning">
                                {{ $pool['relasi'] }}
                              </span>
                            </p>
                          @elseif($pool['relasi'] == 'atasan')
                            <p>
                              <span class="badge badge-primary">
                                {{ $pool['relasi'] }}
                              </span>
                            </p>
                          @elseif($pool['relasi'] == 'rekanan')
                            <p>
                              <span class="badge badge-secondary">
                                {{ $pool['relasi'] }}
                              </span>
                            </p>
                          @else
                            <p>
                              <span class="badge badge-success">
                                {{ $pool['relasi'] }}
                              </span>
                            </p>
                          @endif
                        </td>
                        <td>{{ $pool['sum_nilai'] }}</td>
                        <td>{{ $pool['strategi_perencanaan'] }}</td>
                        <td>{{ $pool['strategi_pengawasan'] }}</td>
                        <td>{{ $pool['strategi_inovasi'] }}</td>
                        <td>{{ $pool['kepemimpinan'] }}</td>
                        <td>{{ $pool['membimbing_membangun'] }}</td>
                        <td>{{ $pool['pengambilan_keputusan'] }}</td>
                        <td>{{ $pool['kerjasama'] }}</td>
                        <td>{{ $pool['komunikasi'] }}</td>
                        <td>{{ $pool['absensi'] }}</td>
                        <td>{{ $pool['integritas'] }}</td>
                        <td>{{ $pool['etika'] }}</td>
                        <td>{{ $pool['goal_kinerja'] }}</td>
                        <td>{{ $pool['error_kinerja'] }}</td>
                        <td>{{ $pool['proses_dokumen'] }}</td>
                        <td>{{ $pool['proses_inisiatif'] }}</td>
                        <td>{{ $pool['proses_polapikir'] }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Npp</th>
                      <th>Nama</th>
                      <th>Jabatan</th>
                      <th>Npp</th>
                      <th>Nama</th>
                      <th>Jabatan</th>
                      <th>Relasi</th>
                      <th>Jumlah</th>
                      <th>K1</th>
                      <th>K2</th>
                      <th>K3</th>
                      <th>K4</th>
                      <th>K5</th>
                      <th>K6</th>
                      <th>P1</th>
                      <th>P2</th>
                      <th>P3</th>
                      <th>P4</th>
                      <th>P5</th>
                      <th>S1</th>
                      <th>S2</th>
                      <th>S3</th>
                      <th>S4</th>
                      <th>S5</th>
                    </tr>
                  </tfoot>
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

@pushOnce('styles')
  <link rel="stylesheet"
        href="{{ asset('vendor/datatables/datatables.min.css') }}">
@endPushOnce

@pushOnce('scripts')
  <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    async function swalAjax() {
      const uri = '/gform/pull';
      await $.ajax({
        url: uri,
        type: 'get',
        dataType: 'json',
        success: function(response) {
          // return response;
          swalOk(response.info, response.data_sama, 'data baru ' + response.data_baru, 'success');
          setTimeout(() => {
            location.reload();
          }, 3100);
        },
        error: function(response) {
          swalOk(response.info, response.data_sama, 'data gagal ' + response
            .data_gagal, 'warning');
          // setTimeout(() => {
          // location.reload();
          // }, 3100);
        }
      });
    }

    $('.btnDeleteNilai').on('click', function(e) {
      e.preventDefault();
      var id = $(this).attr('data-id');
      const uri = '/skor/delete-nilai';
      Swal.fire({
        title: 'anda yakin',
        text: 'hapus data ini',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#cc0000",
        cancelButtonColor: "#21ff00",
        confirmButtonText: 'Iya',
        cancelButtonText: "batal"
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: uri,
            type: 'delete',
            dataType: 'json',
            data: {
              _token: "{{ csrf_token() }}",
              id: id,
            },
            success: function(response) {
              // console.log(response)
              if (response.status == true) {
                Swal.fire({
                  title: "success",
                  text: "berhasil menghapus data",
                  icon: "success"
                });
                setTimeout(() => {
                  location.reload();
                }, 1500);
              } else {
                Swal.fire({
                  title: "warning",
                  text: `gagal menghapus data ${response.detail}`,
                  icon: "warning"
                });
              }
            },
            error: function(response) {
              console.log(response);
            }
          });
        } else {
          $(this).prop("disabled", false);
        }
      });
    });

    $('.btnFollowUp').on('click', function(e) {
      e.preventDefault();
      // alert('ok');

      var id = $(this).attr('data-id');
      var npp_penilai = $(this).attr('data-npp-penilai');
      var npp_dinilai = $(this).attr('data-npp-dinilai');
      const uri = '/skor/follow-up-nilai';

      Swal.fire({
        title: 'anda yakin',
        text: 'melakukan follow up',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: 'Iya',
        cancelButtonText: "batal"
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: uri,
            type: 'post',
            dataType: 'json',
            data: {
              _token: "{{ csrf_token() }}",
              id: id,
              npp_penilai: npp_penilai,
              npp_dinilai: npp_dinilai,
            },
            success: function(response) {
              // console.log(response)
              if (response.status == true) {
                Swal.fire({
                  title: "success",
                  text: "berhasil melakukan follow up",
                  icon: "success"
                });
              } else {
                Swal.fire({
                  title: "warning",
                  text: `gagal melakukan follow up ${response.detail}`,
                  icon: "warning"
                });
              }
              // swalOk(response.title, response.text, response.icon);
              // setTimeout(() => {
              //     location.reload();
              // }, 3100);
            },
            error: function(response) {
              console.log(response);
              // swalOk(response.title, response.text, response.icon);
              // setTimeout(() => {
              // location.reload();
              // }, 10000);
            }
          });
        } else {
          $(this).prop("disabled", false);
        }
      });

      // console.log(id,npp_penilai,npp_dinilai);
    });

    var table = $("#dataTablesPoolSkor").DataTable({
      fixedColumns: {
        start: 2
        // , end: 17
      },
      ordering: false,
      scrollCollapse: true,
      scroller: true,
      scrollY: 300
        // , scrollX: true
        // , stateSave: true
        // , responsive: false
        ,
      searching: true,
      lengthChange: false
        // scrollX: false,
        // scrollY: '60vh',
        // searchable: false,
        ,
      columnDefs: [{
            visible: true,
            targets: 0
          },
          {
            visible: true,
            targets: 1
          },
          {
            visible: true,
            targets: 2
          },
          {
            visible: true,
            targets: 3
          },
          {
            visible: true,
            targets: 4
          },
          {
            visible: true,
            targets: 5
          },
          {
            visible: true,
            targets: 6
          },
          {
            visible: true,
            targets: 7
          },
          {
            visible: true,
            targets: 8
          },

          // { visible: false, targets: 9 },
          // { visible: false, targets: 10 },
          // { visible: false, targets: 11 },
          // { visible: false, targets: 12 },
          // { visible: false, targets: 13 },
          // { visible: false, targets: 14 },
          // { visible: false, targets: 15 },
          // { visible: false, targets: 16 },
          // { visible: false, targets: 17 },
          // { visible: false, targets: 18 },
          // { visible: false, targets: 19 },
          // { visible: false, targets: 20 },
          // { visible: false, targets: 21 },
          // { visible: false, targets: 22 },
          // { visible: false, targets: 23 },
          // { visible: false, targets: 24 },

          // {responsivePriority:0,targets:0},
          // {responsivePriority:1,targets:1},
          // {responsivePriority:2,targets:2},
          // {responsivePriority:3,targets:3},
          // {responsivePriority:4,targets:4},
          // {responsivePriority:5,targets:5},
          // {responsivePriority:6,targets:6},
          // {responsivePriority:7,targets:7},
        ]
        // , responsive: {
        //     details: {
        //         // display: DataTable.Responsive.display.childRowImmediate
        //         // , target: ''
        //         type: 'column'
        //     }

        // }
        // , rowGroup: {
        //     dataSrc: 2
        // }
        ,
      responsive: {
        details: {
          display: DataTable.Responsive.display.modal({
            header: function(row) {
              var data = row.data();
              return 'Detil nilai sdr.' + data[2];
            }
          }),
          renderer: DataTable.Responsive.renderer.listHiddenNodes()
        }
      },
      language: {
        // searchPlaceholder: 'CARI PENILAI...'
        searchPlaceholder: 'Cari Global'
      },
      // columnDefs: [
      //     // { searchable: true, targets: 5 },
      //     // { searchable: false, targets: '_all' },
      //     { searchable: false, targets: [0,1,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24] },
      // ],
      order: [
        [7, 'asc'],
        [8, 'desc'],
      ],
      initComplete: function() {
        this.api()
          .columns([1, 2, 4, 5, 7])
          .every(function() {
            var column = this;
            var title = column.footer().textContent;
            $('<input type="text" placeholder="Cari ' + title + '" />')
              .appendTo($(column.footer()).empty())
              .on('keyup change clear', function() {
                if (column.search() !== this.value) {
                  column.search(this.value).draw();
                }
              });
          });
      }
    });
  </script>
  <script>
    $(document).ready(function(e) {

      async function swalAjax() {
        const clears = true;
        const uri = '/skor-pool-all?refresh=';
        $.ajax({
          url: uri + clears,
          type: 'get',
          dataType: 'json',
          success: function(response) {
            // console.log(response)
            swalOk(response.title, response.text, response.icon);
            setTimeout(() => {
              location.reload();
            }, 3100);
          },
          error: function(response) {
            swalOk(response.title, response.text, response.icon);
            setTimeout(() => {
              location.reload();
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
          } else {
            $('#btnSkorPoolModal').prop("disabled", false);
          }
        });
      }

      $('#btnSkorPoolModal').on('click', function(ev) {
        ev.preventDefault();
        $(this).prop("disabled", true);
        alertswal(
          'anda yakin ?', 'anda akan melakukan kalkulasi skor', 'info', 'iya'
        );
      });

    });
  </script>
@endPushOnce
