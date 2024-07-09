<!DOCTYPE html>
<html>

<head>
    <title>Laporan Kehadiran - {{ $month }}/{{ $year }}</title>
    <style>
        @page {
            margin: 1cm;
            /* Atur margin halaman */
        }

        h1 {
            text-align: center;
            /* Pusatkan judul */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead th {
            background-color: #f5835d;
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tbody td {
            border: 1px solid #ddd;
            padding: 8px;
            word-break: break-all;
        }

        table tbody tr:nth-child(even) {
            background-color: #ffe0b2;
            /* Atur warna latar belakang baris genap */
        }

        table tbody tr:first-child {
            background-color: #fff;
            /* Atur warna latar belakang baris pertama */
        }
    </style>
</head>

<body>
    <h1>Laporan Kehadiran Pegawai Dinas Perpustakaan dan Kearsipan Provinsi Riau - Bulan {{ $month }} Tahun {{ $year }}</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Bidang</th>
                <th>Waktu Masuk</th>
                <th>Keterangan</th>
                <th>Waktu Pulang</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendanceData as $attendance)
            @foreach ($attendance->detail as $detail)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $attendance->user->name }}</td>
                <td>{{ $attendance->user->nip }}</td>
                <td>{{ $attendance->user->field }}</td>
                <td>{{ $attendance->created_at->setTimezone('Asia/Jakarta') }}</td>
                <td>{{ $attendance->keterangan }}</td>
                <td>{{ $attendance->updated_at->setTimezone('Asia/Jakarta') }}</td>
                <td>{{ $detail->lat }}</td>
                <td>{{ $detail->long }}</td>
                <td>{{ $detail->address }}</td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>