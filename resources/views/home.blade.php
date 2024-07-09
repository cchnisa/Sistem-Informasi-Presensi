@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
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

                <!-- User and Attendance Summary -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $userCount }}</h3>
                                <p>Total Pegawai</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $attendanceCount }}</h3>
                                <p>Total Kehadiran</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-checkmark"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance Chart -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ion ion-clipboard mr-1"></i>
                                    Kehadiran
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="chart" style="height: 300px">
                                    {!! $chart->container() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

                    <!-- Pie Chart -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ion ion-pie-graph mr-1"></i>
                                    Disiplin vs. Terlambat
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <canvas id="pieChart" style="height: 200px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->

                <!-- Early Attendance Table -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-person-stalker mr-1"></i>
                            Top 5 Pegawai Tercepat
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Waktu Masuk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($earlyAttendances as $index => $attendance)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $attendance->user->name }}</td>
                                        <td>{{ $attendance->created_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@push('scripts')
{!! $chart->script() !!}

<script>
    // Hardcoded data for the Pie Chart
    const labels = ['Disiplin', 'Terlambat']    ;
    const data = [{{$disiplin}}, {{$telat}}, {{$attendanceCount}}]; // Values can be any numbers

    // Create the Pie Chart using Chart.js
    const pieChartCanvas = document.getElementById('pieChart').getContext('3d');
    const pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: ['#3490DC', '#E3342F', '#00000'],
            }],
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Discipline vs. Late',
                },
            },
        },
    });
</script>
@endpush