<?php

namespace App\Rules;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class BookingExist implements Rule
{
    protected $bookingId;
    protected $startTime;
    protected $endTime;

    /**
     * SameDate constructor.
     * @param $bookingId
     * @param $startTime
     * @param $endTime
     */
    public function __construct($bookingId, $startTime, $endTime)
    {
        $this->bookingId = $bookingId;
        $this->startTime = Carbon::parse($startTime);
        $this->endTime = Carbon::parse($endTime);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !Booking::where('id', '!=', $this->bookingId)
            ->where(function($query) {
                $query->whereBetween('starts_at', [$this->startTime, $this->endTime])
                    ->orWhereBetween('ends_at', [$this->startTime, $this->endTime]);
            })
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This timeslot is no longer available';
    }
}
