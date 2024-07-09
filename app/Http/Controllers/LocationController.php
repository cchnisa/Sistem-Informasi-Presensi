<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\ActivitiesOut;

class LocationController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'is_admin']);
    }

    public function index(Request $request)
    {
        $activitiesOuts = ActivitiesOut::where('status', 1)->get();

        $lastLocation = Location::latest()->first();
        return view('pages.kelolajarak.index', compact('lastLocation', 'activitiesOuts'));
    }

    public function store(Request $request)
    {
        $location = $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'maxdistance' => 'required',
        ]);

        Location::create($location);

        $lastLocation = Location::latest()->first(); // Ambil lokasi terakhir setelah menyimpan

        if ($request->expectsJson()) {
            return response()->json(['lastLocation' => $lastLocation], 201);
        } else {
            return redirect()->route('pages.kelolajarak.index')->with('status', 'Location added successfully');
        }
    }
}
