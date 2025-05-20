<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpectedHours extends Model
{
protected $fillable = [
        'week_start_date',
        'monday_hours',
        'tuesday_hours',
        'wednesday_hours',
        'thursday_hours',
        'friday_hours',
        'saturday_hours',
        'sunday_hours',
    ];

    protected $casts = [
        'week_start_date' => 'date',
    ];
}
