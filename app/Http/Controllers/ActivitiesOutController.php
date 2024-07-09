<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivitiesOut;
use Carbon\Carbon;

class ActivitiesOutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $today = Carbon::today();

        $activitiesOuts = ActivitiesOut::where('status', 1)->whereDate('created_at', $today)->get();
        $activitiesOutAll = ActivitiesOut::all();
        return view('pages.activitiesout.index', compact('activitiesOuts', 'activitiesOutAll'));
    }
}
