@extends('templates.main')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'Tabel Skor' }}</h1>
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
                                <button type="button" class="btn btn-secondary" id="btnSkorModal">
                                    <i class="far fa-plus-square"></i> Skor
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="px-4">
                                <table class="table table-striped table-bordered" id="dataTablesSkor">
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
                                            <td>
                                            Aksi
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
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

{{-- Modal Skor --}}
@push('modals')
    <!-- Modal -->
    <div class="modal fade" id="formTambahSkor" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formTambahSkorLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formTambahSkorLabel">Tambah Skor</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="select_aspek">Pilih Aspek</label>
                            <select class="form-control" id="select_aspek" name="select_aspek" required>
                                <option disabled selected>pilih aspek</option>
                                @foreach($data_aspek as $aspek)
                                <option value="{{$aspek->id}}">{{$aspek->nama_aspek}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                        <label for="aspek">Tambah</label>
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#formTambahAspek">
                                <i class="far fa-plus-square px-2"></i> Aspek
                            </button>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="select_indikator">Pilih indikator</label>
                            <select class="form-control" id="select_indikator" name="select_indikator" required>
                            <option disabled selected>pilih aspek dahulu</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                        <label for="indikator">Tambah</label>
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#formTambahIndikator">
                                <i class="far fa-plus-square px-2"></i>Indikator
                            </button>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="input_jawaban">Jawaban</label>
                            <textarea class="form-control" rows="6" id="input_jawaban" name="input_jawaban" required></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="input_skor">Skor</label>
                            <input type="number" class="form-control" id="input_skor" name="input_skor" required>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="btnTambahSkor" type="submit"><i class="far fa-save px-2"></i>Simpan</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>
@endpush

{{-- Modal Aspek --}}
@push('modals')
<!-- Modal -->
    <div class="modal fade" id="formTambahAspek" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formTambahAspekLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formTambahAspekLabel">Tambah Aspek</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('aspek-store', Auth::user()) }}" method="post">
                @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="nama_aspek">Nama Aspek</label>
                            <textarea id="nama_aspek" name="nama_aspek" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">simpan aspek</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>
@endpush

{{-- Modal Indikator --}}
@push('modals')
<!-- Modal -->
    <div class="modal fade" id="formTambahIndikator" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formTambahIndikatorLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formTambahIndikatorLabel">Tambah Indikator</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('indikator-store', Auth::user()) }}" method="post">
                @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_aspek">Nama Aspek</label>
                            <select class="form-control" name="aspek_id">
                                @foreach($data_aspek as $aspek)
                                <option value="{{$aspek->id}}">{{$aspek->nama_aspek}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_indikator">Nama Indikator</label>
                            <input type="text" class="form-control" name="nama_indikator" id="nama_indikator">
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">simpan indikator</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@push('scripts')
<script>
$("#dataTablesSkor").DataTable({
    responsive: true,
    ordering: false,
    scrollX: false,
    scrollY: '50vh',
    searching : true,
});
</script>
@endpush

@push('scripts')
<script>
$(document).ready(function(){
    async function alertSwal(Title = null, Html = null, Icon = null)
    {
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

    $('#btnSkorModal').click(function(e){
        //alert('ok');
        e.preventDefault();
        $('#formTambahSkor').modal('show');
        $('#formTambahSkor').on('shown.bs.modal', function(e){
            //alert('modal opened');
            e.preventDefault();
            $('#select_aspek').on('change',function(ev){
                //alert('ok changed');
                ev.preventDefault();
                var id = $(this).val();
                $('#select_indikator').find('option').not(':first').remove();
                $.ajax({
                    url : '/indikator/getajax/' + id,
                    type : 'get',
                    dataType: 'json',
                    success : function (response){
                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                        }
                        if(len > 0){
                            for(var i=0; i<len;i++){
                                var id = response['data'][i].id;
                                var name = response['data'][i].nama_indikator;
                                var option = `<option value=${id}>${name}</option>`;
                                $('#select_indikator').append(option);
                            }
                        }
                    }
                });

            });

            $('#btnTambahSkor').on('click', function(ev){
                //alert('ok');
                ev.preventDefault();
                let timerInterval;
                $.ajax({
                    url : '/skor/store-ajax',
                    type : 'post',
                    data : {
                        aspek_id : $('#select_aspek').val(),
                        indikator_id : $('#select_indikator').val(),
                        jawaban : $('#input_jawaban').val(),
                        skor : $('#input_skor').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success : function(response){
                        //console.log(response.data);
                        alertSwal(
                            response.data.title,
                            response.data.html,
                            response.data.icon
                            );
                    },
                    error : function(response){
                        //console.log(response.data);
                        alertSwal(
                            response.data.title,
                            response.data.html,
                            response.data.icon
                            );
                    }
                });
            });

        });
        $('#formTambahSkor').on('hidden.bs.modal', function(e){
            //alert('modal closed');
            $(this).data('bs.modal', null);
        });
    });
});
</script>
@endpush