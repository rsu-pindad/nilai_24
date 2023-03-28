<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PT PINDAD MEDIKA UTAMA | {{ $title }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
    <div class="register-box w-75">
        <div class="register-logo">
            <a href="../../index2.html"><b>PINDAD MEDIKA</b></a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Form Pendaftaran</p>

                <form action="{{ route('register/create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('npp') is-invalid @enderror"
                                    placeholder="NPP" name="npp">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-id-card"></span>
                                    </div>
                                </div>
                                @error('npp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Nama" name="nama">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <select class="form-control @error('penempatan') is-invalid @enderror"
                                    name="penempatan">
                                    <option value="">Pilih Penempatan</option>
                                    <option value="PMU">PMU</option>
                                    <option value="RSUP BANDUNG">RSUP BANDUNG</option>
                                    <option value="RSUP TUREN">RSUP TUREN</option>
                                </select>
                                @error('penempatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                    placeholder="Jabatan" name="jabatan">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user-tie"></span>
                                    </div>
                                </div>
                                @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <select class="form-control @error('level') is-invalid @enderror" name="level">
                                    <option value="">Pilih Level</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                    placeholder="No HP" name="no_hp">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fab fa-whatsapp"></span>
                                    </div>
                                </div>
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Email" name="email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- </div>
                        <div class="col-lg-6">
                            <div class="input-group mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password" name="password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group mb-3">
                                <input type="password"
                                    class="form-control @error('confirm_password') is-invalid @enderror"
                                    placeholder="Retype password" name="confirm_password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('confirm_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('foto') is-invalid @enderror"
                                        id="customFile" name="foto" accept="image/jpeg, image/png"
                                        value="{{ old('foto') }}">
                                    <label class="custom-file-label" for="customFile">Pilih Foto</label>
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                </form>


                <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-center">Masuk</a></p>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>

</html>
