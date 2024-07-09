@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Kehadiran</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Data Kehadiran</li>
                    <li class="breadcrumb-item active">Detail</li>
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
                <!-- Attendance Chart -->
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-info mb-2">Kembali</a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Kehadiran
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table" id="datatable">
                            <tbody>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $attendance->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $attendance->status ? 'Check Out' : 'Check In' }}</td>
                                </tr>
                                <tr>
                                    <th>Waktu Masuk</th>
                                    <td>{{ $attendance->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Waktu Pulang</th>
                                    <td>{{ $attendance->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card -->

                @foreach ($attendance->detail as $detail)
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Check {{ $detail->type }}
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table" id="datatable">
                            <tbody>
                                <tr>
                                    <th>Waktu</th>
                                    <td>{{ $detail->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Long, lat</th>
                                    <td>{{ $detail->long }}, {{ $detail->lat }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $detail->address }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi</th>
                                    <td>
                                        <div style="width: 100%">
                                            <iframe width="100%" height="300" frameborder="0" scrolling="no"
                                                marginheight="0" marginwidth="0"
                                                src="https://maps.google.com/maps?q={{ $detail->long }},{{ $detail->lat }}&hl=en&z=14&amp;output=embed">
                                            </iframe>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Photo</th>
                                    <td><img width="350" src="{{ asset('/storage/attendance/' . $detail->photo) }}" alt=""></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
                @endforeach
            </section>
            <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
@endsection