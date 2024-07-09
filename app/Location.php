<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['latitude', 'longitude', 'maxdistance'];

    // public function attendances()
    // {
    //     return $this->hasMany(Attendance::class);
    // }
}
