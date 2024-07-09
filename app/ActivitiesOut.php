<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivitiesOut extends Model
{
    protected $guarded = [];

    public function scopeCountActivities($query, $status)
    {
        return $query->whereDate('created_at', Carbon::today())
        ->where('status', $status)->count();
    }

    public function attendances()
    {
        return $this->belongsTo(Attendance::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
