<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Charts\AttendanceChart;
use App\User;
use App\ActivitiesOut;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $activitiesOuts = ActivitiesOut::where('status', 1)->get();

        // Create the chart
        $chart = new AttendanceChart();
        $chart->labels(['Today']);
        $chart->dataset('In', 'bar', [Attendance::countAttendance(false)])->backgroundColor('#3490DC');
        $chart->dataset('Out', 'bar', [Attendance::countAttendance(true)])->backgroundColor('#E3342F');
        $chart->dataset('Total User', 'bar', [User::where('is_admin', false)->count()])->color('#38C172')->fill(false);

        // Count the user and attendance
        $userCount = User::where('is_admin', false)->whereNotIn('name', ['kepalaDinas'])->count();
        // Get the current date
        $today = Carbon::today();
        // Count the attendance for today
        $attendanceCount = Attendance::whereDate('created_at', $today)->count();
        // Get the early attendances
        $earlyAttendances = $this->getEarlyAttendances();

        $disiplin = Attendance::whereDate('created_at', $today)
            ->whereTime('created_at', '<', '08:00:00')
            ->count();

        $telat = Attendance::whereDate('created_at', $today)
            ->whereTime('created_at', '>', '08:00:00')
            ->count();

        $hadir = $telat + $disiplin;

        return view('home', compact('chart', 'userCount', 'attendanceCount', 'earlyAttendances', 'activitiesOuts', 'disiplin', 'telat', 'hadir'));
    }

    public function getEarlyAttendances()
    {
        $today = Carbon::today();
        $earlyAttendances = Attendance::whereDate('created_at', $today)
            ->orderBy('created_at')
            ->limit(5)
            ->get();

        return $earlyAttendances;
    }
}
