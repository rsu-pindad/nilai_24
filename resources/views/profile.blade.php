@extends('templates.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        {{-- <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td scope="row">NPP</td>
                                            <td>{{ Auth::user()->npp }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Nama</td>
                                            <td>{{ Auth::user()->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Penempatan</td>
                                            <td>{{ Auth::user()->penempatan }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Jabatan</td>
                                            <td>{{ Auth::user()->jabatan }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Level</td>
                                            <td>{{ Auth::user()->level }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- ./card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content --> --}}
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center ">
                                    <img class="img-circle" src="{{ asset('storage/' . Auth::user()->foto) }}"
                                        alt="User" height="150" width="150">
                                </div>

                                <h3 class="profile-username text-center">{{ Auth::user()->nama }}</h3>

                                <p class="text-muted text-center">{{ Auth::user()->npp }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Email</b>
                                        <span class="float-right text-lightblue">{{ Auth::user()->email }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>No HP</b>
                                        <span class="float-right text-lightblue">{{ Auth::user()->no_hp }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Penempatan</b>
                                        <span class="float-right text-lightblue">{{ Auth::user()->penempatan }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Jabatan</b>
                                        <span class="float-right text-lightblue">{{ Auth::user()->jabatan }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Level</b>
                                        <span class="float-right text-lightblue">{{ Auth::user()->level }}</span>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#settings"
                                            data-toggle="tab">Settings</a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="settings">
                                        <h5>Form Ubah Data</h5>
                                        <form class="form-horizontal" action="{{ route('profile/update', Auth::user()) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group row">
                                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        id="nama" name="nama" placeholder="Nama"
                                                        value="{{ old('nama') ? old('nama') : Auth::user()->nama }}">
                                                    @error('nama')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="email" name="email" placeholder="Email"
                                                        value="{{ old('email') ? old('email') : Auth::user()->email }}">
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                        class="form-control @error('no_hp') is-invalid @enderror"
                                                        id="no_hp" name="no_hp" placeholder="No HP"
                                                        value="{{ old('no_hp') ? old('no_hp') : Auth::user()->no_hp }}">
                                                    @error('no_hp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="penempatan" class="col-sm-2 col-form-label">Penempatan</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control @error('penempatan') is-invalid @enderror"
                                                        id="penempatan" name="penempatan">
                                                        <option value="">Pilih Penempatan</option>
                                                        <option value="PMU"
                                                            {{ Auth::user()->penempatan == 'PMU' ? 'selected' : '' }}>
                                                            PMU</option>
                                                        <option value="RSUP BANDUNG"
                                                            {{ Auth::user()->penempatan == 'RSUP BANDUNG' ? 'selected' : '' }}>
                                                            RSUP BANDUNG</option>
                                                        <option value="RSUP TUREN"
                                                            {{ Auth::user()->penempatan == 'RSUP TUREN' ? 'selected' : '' }}>
                                                            RSUP TUREN</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                        class="form-control @error('jabatan') is-invalid @enderror"
                                                        id="jabatan" name="jabatan" placeholder="Jabatan"
                                                        value="{{ old('jabatan') ? old('jabatan') : Auth::user()->jabatan }}">
                                                    @error('jabatan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="level" class="col-sm-2 col-form-label">Level</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control @error('level') is-invalid @enderror"
                                                        id="level" name="level">
                                                        <option value="">Pilih Level</option>
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <option value="{{ $i }}"
                                                                {{ Auth::user()->level == $i ? 'selected' : '' }}>
                                                                {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-primary"
                                                        onclick="return confirm('Yakin anda akan mengubah data?')">Ubah</button>
                                                </div>
                                            </div>
                                        </form>
                                        <h5>Form Ubah Foto</h5>
                                        <form class="form-horizontal"
                                            action="{{ route('profile/update_photo', Auth::user()) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Foto</label>
                                                <div class="col-sm-10">
                                                    <div class="custom-file">
                                                        <input type="file"
                                                            class="custom-file-input @error('foto') is-invalid @enderror"
                                                            id="customFile" name="foto" accept="image/jpeg, image/png"
                                                            value="{{ old('foto') }}">
                                                        <label class="custom-file-label" for="customFile">Pilih
                                                            Foto</label>
                                                        @error('foto')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-primary"
                                                        onclick="return confirm('Yakin anda akan mengubah foto?')">Ubah</button>
                                                </div>
                                            </div>
                                        </form>
                                        <h5>Form Ubah Password</h5>
                                        <form class="form-horizontal"
                                            action="{{ route('profile/update_password', Auth::user()) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group row">
                                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="password" name="password" placeholder="Password"
                                                        value="{{ old('password') }}">
                                                    @error('password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="password" class="col-sm-2 col-form-label">Konfirmasi
                                                    Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password"
                                                        class="form-control @error('confirm_password') is-invalid @enderror"
                                                        id="confirm_password" name="confirm_password"
                                                        placeholder="Konfirmasi Password" value="{{ old('password') }}">
                                                    @error('confirm_password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-primary"
                                                        onclick="return confirm('Yakin anda akan mengubah password?')">Ubah</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
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
