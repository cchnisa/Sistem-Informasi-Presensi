<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendance;
use App\User;
use PDF;

class PDFController extends Controller
{
    public function print(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        $field = $request->input('field');

        $fields = User::distinct('field')->pluck('field')->toArray();

        $query = Attendance::with('user')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month);

        // Tambahkan filter "bidang" jika ada nilai yang dipilih
        if ($field) {
            $query->whereHas('user', function ($q) use ($field) {
                $q->where('field', $field);
            });
        }

        // Hapus pemanggilan get() di sini
        $attendanceData = $query->get();

        $attendanceData->transform(function ($attendance) {
            $checkInTime = $attendance->created_at->setTimezone('Asia/Jakarta');
            $keterangan = $checkInTime->hour < 8 ? 'Disiplin' : 'Terlambat';
            $attendance->keterangan = $keterangan;

            return $attendance;
        });

        $pdf = PDF::loadView('pages.attendance.print', [
            'attendanceData' => $attendanceData,
            'month' => $month,
            'year' => $year,
            'fields' => $fields
        ]);

        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('attendance_report.pdf');
    }
}
