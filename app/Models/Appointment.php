<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
    use HasFactory;

public static function hasConflict(
    int $serviceId,
    string $date,
    string $startTime,
    string $endTime
): bool {
    return self::where('service_id', $serviceId)
        ->where('date', $date)
        ->whereIn('status', [
            self::STATUS_PENDING,
            self::STATUS_APPROVED,
        ])
        ->where(function ($query) use ($startTime, $endTime) {
            $query->where(function ($q) use ($startTime, $endTime) {
                $q->where('start_time', '<', $endTime)
                  ->where('end_time', '>', $startTime);
            });
        })
        ->exists();
}



    public const STATUS_PENDING   = 'pending';
    public const STATUS_APPROVED  = 'approved';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    public const STATUS_FLOW = [
        self::STATUS_PENDING   => [self::STATUS_APPROVED, self::STATUS_CANCELLED],
        self::STATUS_APPROVED  => [self::STATUS_COMPLETED, self::STATUS_CANCELLED],
        self::STATUS_COMPLETED => [],
        self::STATUS_CANCELLED => [],
    ];

    protected $fillable = [
        'user_id',
        'service_id',
        'date',
        'start_time',
        'end_time',
        'status',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeForDate($query, $date)
    {
        return $query->where('date', $date);
    }

    public function calculateEndTime()
    {
        $start = \Carbon\Carbon::parse($this->start_time);
        return $start->addMinutes($this->service->duration_minutes)->format('H:i');
    }
}