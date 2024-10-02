<x-layout>

  <div class="mb-4 h-auto rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600">
    <div class="inline-flex p-4">
      <button id="btnSkorModal"
              type="button"
              class="dark:focus:ring-[#3b5998]/55 mb-2 me-2 inline-flex items-center rounded-lg bg-[#3b5998] px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-[#3b5998]/90 focus:outline-none focus:ring-4 focus:ring-[#3b5998]/50">
        <svg class="me-2 h-4 w-4"
             aria-hidden="true"
             xmlns="http://www.w3.org/2000/svg"
             fill="currentColor"
             viewBox="0 0 8 19">
          <path fill-rule="evenodd"
                d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                clip-rule="evenodd" />
        </svg>
        Skor
      </button>
    </div>
    <div class="p-4">

      <table id="dataTablesSkor"
             class="table-striped table-bordered table">
        <thead>
          <tr>
            <th>No</th>
            <th>Aspek</th>
            <th>Indikator</th>
            <th>Jawaban</th>
            <th>Skor</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data_skor as $skor)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $skor->aspek->nama_aspek }}</td>
              <td>{{ $skor->indikator->nama_indikator }}</td>
              <td>{{ $skor['jawaban'] }}</td>
              <td>{{ $skor['skor'] }}</td>
              <td class="px-2">
                <div class="btn-toolbar d-flex justify-content-around"
                     role="toolbar"
                     arua-label="grup satu">
                  <div class="btn-group mr-2"
                       role="group"
                       aria-label="group aksi">
                    <button type="button"
                            class="btn btn-outline-secondary btn-sm lihatSkor"
                            data-id="{{ $skor->id }}"
                            data-aspek="{{ $skor->aspek->nama_aspek }}"
                            data-indikator="{{ $skor->indikator->nama_indikator }}"
                            data-jawaban="{{ $skor['jawaban'] }}"
                            data-skors="{{ $skor['skor'] }}"
                            data-bs-toggle="modal"
                            data-bs-target="#lihatSkor">
                      <i class="fas fa-eye"></i>Lihat
                    </button>
                    <button type="button"
                            class="btn btn-outline-info btn-sm editSkor"
                            data-id="{{ $skor->id }}"
                            data-aspek="{{ $skor->aspek->nama_aspek }}"
                            data-aspek-id="{{ $skor->aspek->id }}"
                            data-indikator="{{ $skor->indikator->nama_indikator }}"
                            data-indikator-id="{{ $skor->indikator->id }}"
                            data-jawaban="{{ $skor['jawaban'] }}"
                            data-skors="{{ $skor['skor'] }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editSkor">
                      <i class="fas fa-edit"></i>Edit
                    </button>
                    <form action="{{ route('skor-destroy', $skor->id) }}"
                          method="Post">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                              class="btn btn-outline-warning btn-sm"
                              onclick="return confirm('Yakin akan menghapus data ini?')">
                        <i class="fas fa-trash-alt"></i>Hapus
                      </button>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <x-slot:styles>
    <link rel="stylesheet"
          href="https://cdn.datatables.net/2.1.7/css/dataTables.tailwindcss.css">
  </x-slot:styles>

  <x-slot:modals>
    <!-- Modal -->
    <div id="formTambahSkor"
         class="modal fade"
         data-backdrop="static"
         data-keyboard="false"
         tabindex="-1"
         aria-labelledby="formTambahSkorLabel"
         aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="formTambahSkorLabel"
                class="modal-title">Tambah Skor</h5>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="select_aspek">Pilih Aspek</label>
                  <select id="select_aspek"
                          class="form-control"
                          name="select_aspek"
                          required>
                    <option disabled
                            selected>pilih aspek</option>
                    @foreach ($data_aspek as $aspek)
                      <option value="{{ $aspek->id }}">{{ $aspek->nama_aspek }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-2 mb-3">
                  <label for="aspek">Tambah</label>
                  <button type="button"
                          class="btn btn-secondary"
                          data-toggle="modal"
                          data-target="#formTambahAspek">
                    <i class="far fa-plus-square px-2"></i> Aspek
                  </button>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="select_indikator">Pilih indikator</label>
                  <select id="select_indikator"
                          class="form-control"
                          name="select_indikator"
                          required>
                    <option disabled
                            selected>pilih aspek dahulu</option>
                  </select>
                </div>
                <div class="col-md-2 mb-3">
                  <label for="indikator">Tambah</label>
                  <button type="button"
                          class="btn btn-secondary"
                          data-toggle="modal"
                          data-target="#formTambahIndikator">
                    <i class="far fa-plus-square px-2"></i>Indikator
                  </button>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label for="input_jawaban">Jawaban</label>
                  <textarea id="input_jawaban"
                            class="form-control"
                            rows="6"
                            name="input_jawaban"
                            required></textarea>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-3 mb-3">
                  <label for="input_skor">Skor</label>
                  <input id="input_skor"
                         type="number"
                         class="form-control"
                         name="input_skor"
                         required>
                </div>
              </div>
              <button id="btnTambahSkor"
                      class="btn btn-primary"
                      type="submit"><i class="far fa-save px-2"></i>Simpan</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

    {{-- Modal Aspek --}}
    <div id="formTambahAspek"
         class="modal fade"
         data-backdrop="static"
         data-keyboard="false"
         tabindex="-1"
         aria-labelledby="formTambahAspekLabel"
         aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="formTambahAspekLabel"
                class="modal-title">Tambah Aspek</h5>
          </div>
          <div class="modal-body">
            <form action="{{ route('aspek-store', Auth::user()) }}"
                  method="post">
              @csrf
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label for="nama_aspek">Nama Aspek</label>
                  <textarea id="nama_aspek"
                            name="nama_aspek"
                            class="form-control"
                            rows="3"></textarea>
                </div>
              </div>
              <button class="btn btn-primary"
                      type="submit">simpan aspek</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

    {{-- Modal Indikator --}}
    <!-- Modal -->
    <div id="formTambahIndikator"
         class="modal fade"
         data-backdrop="static"
         data-keyboard="false"
         tabindex="-1"
         aria-labelledby="formTambahIndikatorLabel"
         aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="formTambahIndikatorLabel"
                class="modal-title">Tambah Indikator</h5>
          </div>
          <div class="modal-body">
            <form action="{{ route('indikator-store', Auth::user()) }}"
                  method="post">
              @csrf
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="nama_aspek">Nama Aspek</label>
                  <select class="form-control"
                          name="aspek_id">
                    @foreach ($data_aspek as $aspek)
                      <option value="{{ $aspek->id }}">{{ $aspek->nama_aspek }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="nama_indikator">Nama Indikator</label>
                  <input id="nama_indikator"
                         type="text"
                         class="form-control"
                         name="nama_indikator">
                </div>
              </div>
              <button class="btn btn-primary"
                      type="submit">simpan indikator</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div id="lihatSkorModal"
         class="modal fade"
         tabindex="-1"
         aria-labelledby="editListLabel"
         aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <p id="lihatSkorModalLabel"
               class="modal-title fs-5 h4">Detail Jawaban</p>
          </div>
          <div class="modal-body">
            <dl class="row">
              <dt class="col-sm-3">Aspek</dt>
              <dd class="col-sm-9 lihatAspek"></dd>

              <dt class="col-sm-3">Indikator</dt>
              <dd class="col-sm-9 lihatIndikator"></dd>

              <dt class="col-sm-3">Jawaban</dt>
              <dd class="col-sm-9 lihatJawaban"></dd>

              <dt class="col-sm-3">Skor</dt>
              <dd class="col-sm-9 lihatSkors"></dd>
            </dl>
          </div>
          <div class="modal-footer">
            <button id="closeLihat"
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">tutup</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div id="editSkorModal"
         class="modal fade"
         tabindex="-1"
         aria-labelledby="editListLabel"
         aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <p id="editSkorLabel"
               class="modal-title fs-5">Edit Skor</h1>
          </div>
          <div class="modal-body">
            <form>
              <!-- method('PATCH') -->
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="select_aspek">Pilih Aspek</label>
                  <select id="select_aspek"
                          class="form-control edit_select_aspek"
                          name="select_aspek"
                          required>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="select_indikator">Pilih indikator</label>
                  <select id="select_indikator"
                          class="form-control edit_select_indikator"
                          name="select_indikator"
                          required>
                    <option disabled
                            selected>pilih aspek dahulu</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label for="input_jawaban">Jawaban</label>
                  <textarea id="input_jawaban"
                            class="form-control edit_input_jawaban"
                            rows="6"
                            name="input_jawaban"
                            required></textarea>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-3 mb-3">
                  <label for="input_skor">Skor</label>
                  <input id="input_skor"
                         type="number"
                         class="form-control edit_input_skor"
                         name="input_skor"
                         required>
                </div>
              </div>
              <button id="btnEditSkor"
                      class="btn btn-primary"
                      type="submit"><i class="far fa-edit px-2"></i>Edit</button>
            </form>
          </div>
          <div class="modal-footer">
            <button id="closeLihatEdit"
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">tutup</button>
          </div>
        </div>
      </div>
    </div>
  </x-slot:modals>

  <x-slot:scripts>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.tailwindcss.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", (event) => {
        // alert('content loaded')
        event.preventDefault();
        async function alertSwal(Title = null, Html = null, Icon = null) {
          Swal.fire({
            title: Title,
            html: Html,
            icon: Icon,
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading();
              const timer = Swal.getPopup().querySelector("b");
              timerInterval = setInterval(() => {
                timer.textContent = `${Swal.getTimerLeft()}`;
              }, 100);
            },
            willClose: () => {
              clearInterval(timerInterval);
            }
          }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
              console.log("I was closed by the timer");
            }
          });
        }

        $('.lihatSkor').on('click', function(ev) {
          ev.preventDefault();
          let id = $(this).attr('data-id');
          let aspek = $(this).attr('data-aspek');
          let indikator = $(this).attr('data-indikator');
          let jawaban = $(this).attr('data-jawaban');
          let skors = $(this).attr('data-skors');
          $('#lihatSkorModal').modal('show');
          $('#lihatSkorModal').on('shown.bs.modal', function(e) {
            e.preventDefault();
            $('.lihatAspek').text(aspek);
            $('.lihatIndikator').text(indikator);
            $('.lihatJawaban').text(jawaban);
            $('.lihatSkors').text(skors);
          });
          $('#lihatSkorModal').on('hidden.bs.modal', function(e) {
            $(this).data('bs.modal', null);
          });
        })

        $('#closeLihat').on('click', function(e) {
          e.preventDefault();
          $('#lihatSkorModal').modal('hide');
        })

        $('#closeLihatEdit').on('click', function(e) {
          e.preventDefault();
          $('#editSkorModal').modal('hide');
        })

        var request_aspek = null;
        var request_indikator = null;
        var request_edit = null;
        $('.editSkor').on('click', function(ev) {
          ev.preventDefault();
          let id = $(this).attr('data-id');
          let aspek = $(this).attr('data-aspek');
          let aspek_id = $(this).attr('data-aspek-id');
          let indikator = $(this).attr('data-indikator');
          let indikator_id = $(this).attr('data-indikator-id');
          let jawaban = $(this).attr('data-jawaban');
          let skors = $(this).attr('data-skors');
          const idSkor = $(this).attr('data-id');
          $('#editSkorModal').modal('show');
          $('#editSkorModal').on('shown.bs.modal', function(e) {
            e.preventDefault();
            // $('.edit_select_aspek').children('option').text(aspek).val(aspek_id);
            $('.edit_input_jawaban').val(jawaban);
            $('.edit_input_skor').val(skors);
            var options = `<option value=${aspek_id} selected>${aspek}</option>`;
            $('.edit_select_aspek').append(options);
            var options_indikator = `<option value=${indikator_id} selected>${indikator}</option>`;
            $('.edit_select_indikator').append(options_indikator);
            $('.edit_select_aspek').find('option').not(':first').remove();
            if (request_aspek && request_aspek.readyState != 2) {
              request_aspek.abort();
            }
            request_aspek = $.ajax({
              url: '/aspek/getajax/' + aspek_id,
              type: 'get',
              dataType: 'json',
              success: function(response) {
                var len = 0;
                if (response['data'] != null) {
                  len = response['data'].length;
                }
                if (len > 0) {
                  for (var i = 0; i < len; i++) {
                    var id = response['data'][i].id;
                    var name = response['data'][i].nama_aspek;
                    var option = `<option value=${id}>${name}</option>`;
                    $('.edit_select_aspek').append(option);
                  }
                }
              }
            });
            $('.edit_select_aspek').on('change', function(ev) {
              // alert('ok changed');
              ev.preventDefault();
              var id = $(this).val();
              $('.edit_select_indikator').find('option').not(':first').remove();
              if (request_indikator && request_indikator.readyState != 2) {
                request_indikator.abort();
              }
              request_indikator = $.ajax({
                url: '/indikator/getajax/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                  var len = 0;
                  if (response['data'] != null) {
                    len = response['data'].length;
                  }
                  if (len > 0) {
                    for (var i = 0; i < len; i++) {
                      var id = response['data'][i].id;
                      var name = response['data'][i].nama_indikator;
                      var option = `<option value=${id}>${name}</option>`;
                      $('.edit_select_indikator').append(option);
                    }
                  }
                }
              });

            });
            $('#btnEditSkor').on('click', function(ev) {
              //alert('ok');
              ev.preventDefault();
              $('#editSkorModal').modal('hide');
              let timerInterval;
              if (request_edit && request_edit.readyState != 2) {
                request_edit.abort();
              }
              request_edit = $.ajax({
                url: '/skor/update-ajax/' + idSkor,
                type: 'post',
                data: {
                  aspek_id: $('.edit_select_aspek').val(),
                  indikator_id: $('.edit_select_indikator').val(),
                  jawaban: $('.edit_input_jawaban').val(),
                  skor: $('.edit_input_skor').val(),
                  _method: 'PUT',
                  _token: '{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(response) {
                  alertSwal(
                    response.data.title, response.data.html, response.data.icon
                  );
                  setTimeout(() => {
                    location.reload();
                  }, 2100);
                },
                error: function(response) {
                  //console.log(response.data);
                  alertSwal(
                    'error', 'terjadi kesalahan', 'warning'
                  );
                  setTimeout(() => {
                    location.reload();
                  }, 2100);

                }
              });
              // $('#dataTablesSkor').DataTable().ajax.reload();
            });
          });

          $('#editSkorModal').on('hidden.bs.modal', function(e) {
            $(this).data('bs.modal', null);
          });

        });

        let table = $("#dataTablesSkor").DataTable({
          responsive: true,
          ordering: false,
          scrollX: false,
          scrollY: '50vh',
          searching: true,
          stateSave: true
        });

        $('#dataTablesSkor tbody').on('click', 'tr', function() {
          var data = table.row(this).data();
          console.log('You clicked on ' + data[0] + "'s row");
        });
      });
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", (event) => {

        $('#btnSkorModal').click(function(e) {
          //alert('ok');
          e.preventDefault();
          $('#formTambahSkor').modal('show');
          $('#formTambahSkor').on('shown.bs.modal', function(e) {
            //alert('modal opened');
            e.preventDefault();
            $('#select_aspek').on('change', function(ev) {
              //alert('ok changed');
              ev.preventDefault();
              var id = $(this).val();
              $('#select_indikator').find('option').not(':first').remove();
              $.ajax({
                url: '/indikator/getajax/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                  var len = 0;
                  if (response['data'] != null) {
                    len = response['data'].length;
                  }
                  if (len > 0) {
                    for (var i = 0; i < len; i++) {
                      var id = response['data'][i].id;
                      var name = response['data'][i]
                        .nama_indikator;
                      var option =
                        `<option value=${id}>${name}</option>`;
                      $('#select_indikator').append(option);
                    }
                  }
                }
              });

            });

            $('#btnTambahSkor').on('click', function(ev) {
              // alert('ok');
              ev.preventDefault();
              let timerInterval;
              $.ajax({
                url: '/skor/store-ajax',
                type: 'post',
                data: {
                  aspek_id: $('#select_aspek').val(),
                  indikator_id: $('#select_indikator').val(),
                  jawaban: $('#input_jawaban').val(),
                  skor: $('#input_skor').val(),
                  _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                  //console.log(response.data);
                  alertSwal(
                    response.data.title, response.data.html, response.data.icon
                  );
                },
                error: function(response) {
                  //console.log(response.data);
                  alertSwal(
                    response.data.title, response.data.html, response.data.icon
                  );
                }
              });
            });

          });

          $('#formTambahSkor').on('hidden.bs.modal', function(e) {
            //alert('modal closed');
            $(this).data('bs.modal', null);
          });

        });

      });
    </script>
  </x-slot>

</x-layout>
