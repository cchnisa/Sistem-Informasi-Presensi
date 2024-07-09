@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Kehadiran</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Kehadiran</li>
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

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Kehadiran
                        </h3>
                        <a href="{{ route('attendance.print') }}" id="print-pdf" class="btn btn-info float-right" target="_blank">Cetak ke PDF</a>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3">
                            <select class="form-control" id="field">
                                <option value="">Pilih Bidang</option>
                                @foreach ($fields as $field)
                                <option value="{{ $field }}">{{ $field }}</option>
                                <!-- Tambahkan opsi bidang lainnya sesuai kebutuhan -->
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" id="month">
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
                                <!-- Tambahkan opsi bulan lainnya -->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" id="year">
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <!-- Tambahkan opsi tahun lainnya -->
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-info" id="filter">Filter</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Waktu Masuk</th>
                                    <th>Keterangan</th>
                                    <th>Waktu Pulang</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>

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

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ url("attendance") }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id',
                    orderable: false
                },
                {
                    data: 'user.name',
                    name: 'user.name'
                },
                {
                    data: function(row) {
                        return row.status ? "Check Out" : "Check In"
                    },
                    name: 'status'
                },
                {
                    data: function(row) {
                        let date = new Date(row.created_at);
                        return date.toLocaleString();
                    },
                    name: 'created_at'
                },

                {
                    data: function(row) {
                        var checkInTime = new Date(row.created_at);
                        var keterangan = checkInTime.getHours() < 8 ? 'Disiplin' : 'Terlambat';
                        return keterangan;
                    },
                    name: 'keterangan'
                },
                {
                    data: function(row) {
                        let date = new Date(row.updated_at);
                        return date.toLocaleString();
                    },
                    name: 'updated_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            columnDefs: [{
                targets: 0,
                createdRow: function(row, data, dataIndex) {
                    $('td', row).eq(0).text(dataIndex + 1);
                }
            }]
        });

        $(document).ready(function() {
            $('#print-pdf').on('click', function(e) {
                e.preventDefault();
                var month = $('#month').val();
                var year = $('#year').val();
                var field = $('#field').val();
                var url = $(this).attr('href') + '?field=' + field + '&month=' + month + '&year=' + year;
                window.location.href = url;
            });
        });

        $('#filter').click(function() {
            var month = $('#month').val();
            var year = $('#year').val();
            var field = $('#field').val();
            $('#datatable').DataTable().ajax.url('{{ url("attendance") }}?month=' + month + '&year=' + year + '&field=' + field).load();
        });
    });
</script>
@endpush