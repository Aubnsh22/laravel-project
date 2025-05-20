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

    // Cast date fields to Carbon instances
    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Calculate total hours worked for the day
    public function hoursWorked()
    {
        if (!$this->clock_in || !$this->clock_out) {
            return 0; // Return 0 if either clock_in or clock_out is missing
        }

        $clockIn = Carbon::parse($this->clock_in);
        $clockOut = Carbon::parse($this->clock_out);
        return $clockIn->diffInHours($clockOut);
    }

    // Check if the user is currently clocked in (no clock_out for today)
    public function isClockedIn()
    {
        return $this->clock_in && !$this->clock_out;
    }

    // Calculate expected hours (e.g., 8 hours per day)
    public function expectedHours()
    {
        return 8; // Example: 8 hours expected per day
    }
}