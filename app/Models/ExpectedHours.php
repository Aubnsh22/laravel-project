<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ExpectedHours extends Model
{
    protected $fillable = [
        'week_start_date',
        'monday_start_time', 'monday_end_time',
        'tuesday_start_time', 'tuesday_end_time',
        'wednesday_start_time', 'wednesday_end_time',
        'thursday_start_time', 'thursday_end_time',
        'friday_start_time', 'friday_end_time',
        'saturday_start_time', 'saturday_end_time',
        'sunday_start_time', 'sunday_end_time',
    ];

    protected $casts = [
        'week_start_date' => 'date',
        'monday_start_time' => 'datetime:H:i',
        'monday_end_time' => 'datetime:H:i',
        'tuesday_start_time' => 'datetime:H:i',
        'tuesday_end_time' => 'datetime:H:i',
        'wednesday_start_time' => 'datetime:H:i',
        'wednesday_end_time' => 'datetime:H:i',
        'thursday_start_time' => 'datetime:H:i',
        'thursday_end_time' => 'datetime:H:i',
        'friday_start_time' => 'datetime:H:i',
        'friday_end_time' => 'datetime:H:i',
        'saturday_start_time' => 'datetime:H:i',
        'saturday_end_time' => 'datetime:H:i',
        'sunday_start_time' => 'datetime:H:i',
        'sunday_end_time' => 'datetime:H:i',
    ];

    // Helper method to get the start and end times for a given day
    public function getTimesForDay($day)
    {
        $day = strtolower($day);
        return [
            'start_time' => $this->{$day . '_start_time'},
            'end_time' => $this->{$day . '_end_time'},
        ];
    }

    // Calculate expected hours for a given day
    public function expectedHoursForDay($day)
    {
        $times = $this->getTimesForDay($day);
        if (!$times['start_time'] || !$times['end_time']) {
            return 0;
        }

        $start = Carbon::parse($times['start_time']);
        $end = Carbon::parse($times['end_time']);
        return $start->diffInHours($end);
    }
}