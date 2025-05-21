<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'status',
        'clock_in',
        'clock_out',
    ];

    protected $dates = ['date'];

    protected $casts = [
        'date' => 'date',
        'clock_in' => 'datetime',
        'clock_out' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hoursWorked()
    {
        if (!$this->clock_in || !$this->clock_out) {
            return 0;
        }

        return Carbon::parse($this->clock_in)->diffInHours(Carbon::parse($this->clock_out));
    }

    public function isClockedIn()
    {
        return $this->clock_in && !$this->clock_out;
    }

    public function expectedHours()
    {
        $weekStart = Carbon::parse($this->date)->startOfWeek(Carbon::MONDAY);
        $expectedHours = ExpectedHours::where('week_start_date', $weekStart->toDateString())->first();
        if (!$expectedHours) {
            return 8; // Default to 8 hours if no expected hours defined
        }
        $dayName = strtolower(Carbon::parse($this->date)->format('l'));
        return $expectedHours->expectedHoursForDay($dayName);
    }

    public function getStatusAttribute($value)
    {
        if ($this->clock_in && $this->clock_out) {
            return 'present';
        }
        if ($this->clock_in && !$this->clock_out) {
            return 'in_progress';
        }

        // Check for approved leave
        $leave = Leave_request::where('user_id', $this->user_id)
            ->where('status', 'approved')
            ->where('start_date', '<=', $this->date)
            ->where('end_date', '>=', $this->date)
            ->first();

        if ($leave) {
            return 'on_leave';
        }

        // Check if the day is a weekend
        $dayName = strtolower(Carbon::parse($this->date)->format('l'));
        if (in_array($dayName, ['saturday', 'sunday'])) {
            return 'weekend';
        }

        return 'absent';
    }
}