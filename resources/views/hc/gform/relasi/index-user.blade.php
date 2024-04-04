@extends('templates.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'User MGMT' }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="tabelUser">
                                    <thead>
                                        <th>No</th>
                                        <th>NPP</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @foreach($user_data as $user)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$user->npp}}</td>
                                                <td>{{$user->nama}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->no_hp}}</td>
                                                <td>
                                                    <button 
                                                        type="button"
                                                        class="btn btn-outline-info btn-sm editUser"
                                                        data-id="{{ $user->id }}"
                                                        data-npp="{{ $user->npp }}"
                                                        data-nama="{{ $user->nama }}"
                                                        data-email="{{ $user->email }}"
                                                        data-phone="{{ $user->no_hp }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editUser"
                                                        >
                                                        <i class="fas fa-edit"></i>Edit
                                                    </button>
                                                    <form action="{{route('relasi-user-reset-password', $user->id)}}" method="Post">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-outline-warning btn-sm"
                                                            onclick="return confirm('anda yakin password akan di reset?')">
                                                            <i class="fas fa-trash-alt p-1"></i>Reset Password
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    <tbody>
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

@push('modals')
<!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editListLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title fs-5" id="editSkorLabel">Edit User</h1>
            </div>
            <div class="modal-body">
                <form>
                    <!-- method('PATCH') -->
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="input_npp">NPP</label>
                            <input type="text" class="form-control edit_input_npp" id="input_npp" name="input_npp" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="input_nama">Nama</label>
                            <input type="text" class="form-control edit_input_nama" id="input_nama" name="input_nama" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="input_email">Email</label>
                            <input type="email" class="form-control edit_input_email" id="input_email" name="input_email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="input_phone">Phone</label>
                            <input type="email" class="form-control edit_input_phone" id="input_phone" name="input_phone" required>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="btnEditUser" type="submit"><i class="far fa-edit px-2"></i>Edit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeLihatEdit">tutup</button>
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
    
var request_aspek = null;
var request_indikator = null;
var request_edit = null;
$('#closeLihatEdit').on('click', function(e){
    e.preventDefault();
    $('#editUserModal').modal('hide');
})

$('.editUser').on('click', function(ev){
    ev.preventDefault();
    let id = $(this).attr('data-id');
    let npp = $(this).attr('data-npp');
    let nama = $(this).attr('data-nama');
    let email = $(this).attr('data-email');
    let np_hp = $(this).attr('data-phone');
    const idUser = $(this).attr('data-id');
    $('#editUserModal').modal('show');
    $('#editUserModal').on('shown.bs.modal', function(e){
        e.preventDefault();
        // $('.edit_select_aspek').children('option').text(aspek).val(aspek_id);
        $('#input_npp').val(npp);
        $('#input_nama').val(nama);
        $('#input_email').val(email);
        $('#input_phone').val(np_hp);
        $('#btnEditUser').on('click', function(ev){
            //alert('ok');
            ev.preventDefault();
            $('#editUserModal').modal('hide');
            let timerInterval;
            if(request_edit && request_edit.readyState != 2){
                request_edit.abort();
            }
            request_edit = $.ajax({
                url : '/relasi-karyawan/update-user/' + idUser,
                type : 'post',
                data : {
                    npp : $('#input_npp').val(),
                    nama : $('#input_nama').val(),
                    email : $('#input_email').val(),
                    no_hp : $('#input_phone').val(),
                    _method: 'PUT',
                    _token: '{{ csrf_token() }}',
                },
                dataType: 'json',
                success : function(response){
                    alertSwal(
                        response.data.title,
                        response.data.html,
                        response.data.icon
                    );
                    setTimeout(() => {
                        location.reload();
                    }, 2100);
                },
                error : function(response){
                    //console.log(response.data);
                    alertSwal(
                        'error',
                        'terjadi kesalahan',
                        'warning'
                    );
                    setTimeout(() => {
                        location.reload();
                    }, 2100);
                    
                }
            });
            // $('#dataTablesSkor').DataTable().ajax.reload();
        });
    });

    $('#editUserModal').on('hidden.bs.modal', function(e){
        $(this).data('bs.modal', null);
    });

});

var table = $('#tabelUser').DataTable({
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
$(document).ready(function(e){

    async function swalAjax()
    {
        const uri = '/relasi-karyawan/pull-level';
        return await $.ajax({
            url : uri,
            type : 'get',
            dataType: 'json',
            success : function (response){
                swalOk(response.title, response.text, 'success');
                setTimeout(() => {
                    location.reload()
                }, 3100);
            },
            error: function(response){
                swalOk(response.title, response.text, 'danger');
                setTimeout(() => {
                    location.reload()
                }, 10000)
            }
        });
    }

    async function swalOk(title, text, icon)
    {
        Swal.fire({
            title: title,
            text: text,
            icon: icon
        });
    }

    async function alertSwal(title, text, icon, confirmButtonText)
    {
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
                swalAjax();
            }
        }).catch((result) => {
            console.log(result);
        });
    }
});
</script>
@endpush