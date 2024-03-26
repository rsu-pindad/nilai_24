@extends('templates.main')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'Form Google Form' }}</h1>
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
                                <button type="button" class="btn btn-secondary" id="btnFormModal">
                                    <i class="far fa-plus-square"></i> Form
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="px-4">
                                <table class="table table-striped table-bordered" id="dataTablesForm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Form</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data_nilai as $n)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $n->form_start }}</td>
                                            <td>{{ $n->active }}</td>
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
    <div class="modal fade" id="formTambahForm" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formTambahFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formTambahFormLabel">Set Form</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="form_start">Form Start / Blank</label>
                            <input type="text" class="form-control" id="form_start" name="form_start" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="segment1">Segment 1 / NPP Penilai</label>
                            <input type="text" class="form-control" id="segment1" name="segment1">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="segment2">Segment 2 / Nama Penilai</label>
                            <input type="text" class="form-control" id="segment2" name="segment2">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="segment3">Segment 3 / NPP Dinilai</label>
                            <input type="text" class="form-control" id="segment3" name="segment3">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="segment4">Segment 4 / Nama Dinilai</label>
                            <input type="text" class="form-control" id="segment4" name="segment4">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="segment5">Segment 5 / Level Jabatan Dinilai</label>
                            <input type="text" class="form-control" id="segment5" name="segment5">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="active">
                            <label class="form-check-label" for="active">
                                Aktif
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="btnTambahForm" type="submit">simpan</button>
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
$("#dataTablesForm").DataTable({
    responsive: true,
    ordering: false,
    // scrollX: false,
    // scrollY: '25vh',
    searching : false,
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

    $('#btnFormModal').click(function(e){
        //alert('ok');
        e.preventDefault();
        $('#formTambahForm').modal('show');
        $('#formTambahForm').on('shown.bs.modal', function(e){
            //alert('modal opened');
            e.preventDefault();
            
            $('#btnTambahForm').on('click', function(ev){
                //alert('ok');
                ev.preventDefault();
                let timerInterval;
                $.ajax({
                    url : '/link-nilai/store-ajax',
                    type : 'post',
                    data : {
                        form_start : $('#form_start').val(),
                        segment1 : $('#segment1').val(),
                        segment2 : $('#segment2').val(),
                        segment3 : $('#segment3').val(),
                        segment4 : $('#segment4').val(),
                        segment5 : $('#segment5').val(),
                        segment6 : $('#segment6').val(),
                        // active : $("input[type='checkbox']").val(),
                        active : $('#active:checked').val(),
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
        $('#formTambahForm').on('hidden.bs.modal', function(e){
            //alert('modal closed');
            $(this).data('bs.modal', null);
        });
    });
});
</script>
@endpush