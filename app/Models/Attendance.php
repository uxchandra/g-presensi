<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;


class Attendance extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isLate()
    {
        $scheduleStartTime = Carbon::parse($this->schedule_start_time);
        $start_time = Carbon::parse($this->start_time);

        return $start_time->greaterThan($scheduleStartTime);
    }

    public function workDuration()
    {
        $startTime = Carbon::parse($this->start_time);
        $endTime = Carbon::parse($this->end_time);

        $duration = $startTime->diff($endTime);

        $hours = $duration->h;
        $minutes = $duration->i;

        return "{$hours} jam {$minutes} menit";
    }
}
