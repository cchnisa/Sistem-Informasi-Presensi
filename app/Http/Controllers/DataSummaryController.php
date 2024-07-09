<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\User;
use App\Attendance;
use App\ActivitiesOut;
use Carbon\Carbon;

class DataSummaryController extends Controller
{
    // ... Constructor and other methods ...

    public function index()
    {
        $activitiesOuts = ActivitiesOut::where('status', 1)->get();

        // Load data summary for the current month and year
        $summary = $this->getUserSummary(date('m'), date('Y'));

        return view('pages.datasummary.index', compact('summary', 'activitiesOuts'));
    }

    public function getUserSummary($month, $year)
    {
        $summary = Attendance::select('users.name as user')
            ->selectRaw('SUM( CASE WHEN HOUR(attendances.created_at) <= 8 THEN 1 ELSE 0 END ) AS disiplin')
            ->selectRaw('SUM( CASE WHEN HOUR(attendances.created_at) > 8 THEN 1 ELSE 0 END ) AS terlambat')
            ->join('users', 'attendances.user_id', '=', 'users.id')
            ->whereYear('attendances.created_at', $year)
            ->whereMonth('attendances.created_at', $month)
            ->groupBy('users.name')
            ->get();

        return $summary;
    }

    public function filter(Request $request)
    {
        $activitiesOuts = ActivitiesOut::where('status', 1)->get();

        $month = $request->input('month');
        $year = $request->input('year');

        // Load data summary based on the selected month and year
        $summary = $this->getUserSummary($month, $year);

        return view('pages.datasummary.index', compact('summary', 'activitiesOuts'));
    }
}
