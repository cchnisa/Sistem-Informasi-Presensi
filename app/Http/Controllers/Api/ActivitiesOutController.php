<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class ActivitiesOutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'status' => ['required'],
            'longitude' => ['required'],
            'latitude' => ['required']
        ]);

        $userOutToday = $request->user()
            ->activitiesout()
            ->whereDate('created_at', Carbon::today())
            ->first();

        $attendToday = $request->user()
            ->attendances()
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($userOutToday == null && $request->status) {
            $request->user()
                ->activitiesout()
                ->create([
                    'status' => true,
                    'longitude' => $request->longitude,
                    'latitude' => $request->latitude,
                    'attendance_id' => $attendToday->id
                ]);

            return response()->json(
                [
                    'message' => 'User has been out'
                ],
                Response::HTTP_CREATED
            );
        }

        if ($userOutToday != null && $userOutToday->status && !$request->status) {
            $userOutToday->update(
                [
                    'status' => false
                ]
            );

            return response()->json(
                [
                    'message' => 'User has been in',
                ],
                Response::HTTP_OK
            );
        }

        return response()->json(
            [
                'message' => 'no action',
            ],
            Response::HTTP_OK
        );
    }
}
