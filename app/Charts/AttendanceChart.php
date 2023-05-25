<?php

namespace App\Charts;

use App\Attendance;
use App\User;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Http\Request;

class AttendanceChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    
    public function handler(Request $request): Chart
    {
        return Chart::build()
            ->labels(['Today'])
            ->dataset('In', [Attendance::countAttendance(false)])
            ->dataset('Out', [Attendance::countAttendance(true)])
            ->dataset('Total User', [User::where('is_admin', false)->count()]);
    }
}
