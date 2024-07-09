@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Summary List</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Summary</li>
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

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Data Summary
                        </h3>
                    </div>

                    <div class="card-body">
                        <!-- Filter Form -->
                        <form id="filter-form" action="{{ route('datasummary.filter') }}" method="POST">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <select class="form-control" id="month" name="month">
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="year" name="year">
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-info">Filter</button>
                                </div>
                            </div>
                        </form>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Data Summary Table -->
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jumlah Kehadiran</th>
                                        <th>Jumlah Keterlambatan</th>
                                        <!-- <th>Tidak Hadir</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($summary as $index => $data)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $data->user }}</td>
                                        <td>{{ $data->disiplin + $data->terlambat }}</td>
                                        <td>{{ $data->terlambat }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            // DataTables configuration, see previous code
        });

        // Load the options for month and year selection
        loadMonthOptions();
        loadYearOptions();
    });

    // Function to load the options for month selection
    function loadMonthOptions() {
        var currentMonth = new Date().getMonth() + 1;
        var selectMonth = $('#month');
        for (var i = 1; i <= 12; i++) {
            var option = new Option(monthNames[i - 1], i);
            if (i === currentMonth) {
                $(option).prop('selected', true);
            }
            selectMonth.append(option);
        }
    }

    // Function to load the options for year selection
    function loadYearOptions() {
        var currentYear = new Date().getFullYear();
        var selectYear = $('#year');
        for (var i = currentYear - 2; i <= currentYear + 2; i++) {
            var option = new Option(i, i);
            if (i === currentYear) {
                $(option).prop('selected', true);
            }
            selectYear.append(option);
        }
    }

    // Add your custom scripts here
</script>
@endpush