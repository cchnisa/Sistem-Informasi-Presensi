@php
use Carbon\Carbon;
@endphp
<!-- index.blade.php -->
@extends('layouts.app')

@section('content')
<!-- ... Your content header and section ... -->

<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="card-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Waktu Masuk</th>
                                <th>Waktu Pulang</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            // Mendapatkan tanggal hari ini
                            $today = Carbon::today();
                            @endphp

                            @foreach ($activitiesOutAll as $index => $activityOut)
                            @php
                            // Cek apakah data activityOut dibuat pada tanggal hari ini
                            $isToday = $activityOut->created_at->isToday();
                            @endphp

                            @if ($isToday)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $activityOut->user->name }}</td>
                                <td>{{ $activityOut->status ? 'Keluar Kantor' : 'Masuk Kantor' }}</td>
                                <td>{{ $activityOut->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $activityOut->updated_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
@endsection