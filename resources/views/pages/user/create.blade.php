@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Pegawai</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Data Pegawai</li>
                    <li class="breadcrumb-item active">Tambah Pegawai</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <!-- Attendance Chart -->
                <a href="{{ route('user.create') }}" class="btn btn-sm btn-info mb-2">Tambah Pegawai</a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Pegawai
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">e-Mail</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">NIP</label>
                                <input type="text" name="nip" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <select name="gender" class="form-control">
                                    <option value="male">Pria</option>
                                    <option value="female">Wanita</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Bidang</label>
                                <select name="field" class="form-control">
                                    <option value="Akuisisi dan Penyimpanan Arsip">Akuisisi dan Penyimpanan Arsip</option>
                                    <option value="Pelayanan Perpustakaan, Dokumentasi Dan Informasi">Pelayanan Perpustakaan, Dokumentasi Dan Informasi</option>
                                    <option value="Pembinaan Dan Pelayanan Arsip">Pembinaan Dan Pelayanan Arsip</option>
                                    <option value="Perpustakaan">Perpustakaan</option>
                                    <option value="Sekretariat">Sekretariat</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" style="display: block">Is Admin</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="is_admin" type="radio" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="is_admin" type="radio" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Photo</label>
                                <input type="file" name="image" class="form-control-file">
                            </div>
                            <button type="submit" class="btn btn-info">Simpan</button>
                        </form>

                    </div>
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
@endsection