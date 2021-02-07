<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class SameDate implements Rule
{
    protected $date;

    /**
     * SameDate constructor.
     * @param $comparisonDate
     */
    public function __construct($comparisonDate)
    {
        $this->date = Carbon::parse($comparisonDate);
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
        return $value->isSameDay($this->date);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Both dates has to be on the same day.';
    }
}
