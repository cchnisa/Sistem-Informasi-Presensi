<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\User;
use App\ActivitiesOut;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Construct
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $activitiesOuts = ActivitiesOut::where('status', 1)->get();
        $fields = User::distinct('field')->pluck('field')->toArray();

        if ($request->ajax()) {
            $data = Attendance::with('user');
    
            // Filter
            if ($request->has('month') && $request->has('year')) {
                $month = $request->input('month');
                $year = $request->input('year');
                $data->whereYear('created_at', $year)->whereMonth('created_at', $month);
            }
    
            return DataTables::eloquent($data)
                ->addColumn('action', function ($data) {
                    return view('layouts._action', [
                        'model' => '',
                        'edit_url' => '',
                        'show_url' => route('attendance.show', $data->id),
                        'delete_url' => '',
                    ]);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->toJson();
        }

        // $users = User::paginate(5);
        return view('pages.attendance.index', compact('activitiesOuts', 'fields'));
    }

    public function show($id)
    {
        $activitiesOuts = ActivitiesOut::where('status', 1)->get();
        
        $attendance = Attendance::with(['user', 'detail'])->findOrFail($id);
        return view('pages.attendance.show', compact('attendance', 'activitiesOuts'));
    }
}
