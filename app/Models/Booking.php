<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    const DATE_FORMAT = 'D jS M Y g:ia';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'room_id',
        'starts_at',
        'ends_at',
        'notes',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'starts_at' => 'datetime:' . self::DATE_FORMAT,
        'ends_at' => 'datetime:' . self::DATE_FORMAT,
    ];

    /**
     * Get the formatted start datetime
     *
     * @return string
     */
    public function getFormattedStartsAtAttribute()
    {
        if ($this->starts_at) {
            return $this->starts_at->format(self::DATE_FORMAT);
        }
    }

    /**
     * Get the formatted end datetime
     *
     * @return string
     */
    public function getFormattedEndsAtAttribute()
    {
        if ($this->ends_at) {
            return $this->ends_at->format(self::DATE_FORMAT);
        }
    }

    /**
     * Get the user who booked the room.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the room that was booked.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
