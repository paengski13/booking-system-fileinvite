<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class TimePeriod implements Rule
{
    /**
     * SameDate constructor.
     */
    public function __construct()
    {
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
        $from = Carbon::createFromFormat('Y-m-d H:i:s', $value->format('Y-m-d 08:00:00'));
        $to = Carbon::createFromFormat('Y-m-d H:i:s', $value->format('Y-m-d 17:00:00'));
        return $value->isBetween($from, $to);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The first booking start time at 8:00 AM, the last one (start time) at 5:00 PM';
    }
}
