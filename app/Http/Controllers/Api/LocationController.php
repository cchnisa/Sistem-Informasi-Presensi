<?php

namespace App\Http\Controllers\Api;

use App\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocationController extends Controller
{
    public function getLocation()
{
    $lastLocation = Location::latest()->first();

    return response()->json(['lastLocation' => $lastLocation], 200);
}
}

