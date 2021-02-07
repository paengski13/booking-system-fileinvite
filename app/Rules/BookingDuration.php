<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class BookingDuration implements Rule
{
    protected $time;

    /**
     * SameDate constructor.
     * @param $time
     */
    public function __construct($time)
    {
        $this->time = Carbon::parse($time);
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
        $value = Carbon::parse($value);
        $duration = $value->diffInMinutes($this->time);
        return in_array($duration, config('constants.allowed_booking_duration'));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The booking duration can be one on the following: '
            . implode(", ", config('constants.allowed_booking_duration')) . ' minutes';
    }
}
