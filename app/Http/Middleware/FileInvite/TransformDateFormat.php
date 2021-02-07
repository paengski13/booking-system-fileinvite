<?php

namespace App\Http\Middleware\FileInvite;

use Carbon\Carbon;
use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class TransformDateFormat extends TransformsRequest
{
    /**
     * Transform all numeric values with comma separator
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        try {
            if (strpos($key, '_at') !== false) {
                return Carbon::createFromFormat(config('constants.datetime_format_display'), $value)->format('Y-m-d H:i:s');
            } elseif (strpos($key, '_date') !== false) {
                return Carbon::createFromFormat(config('constants.date_format_display'), $value)->format('Y-m-d');
            }

            return $value;
        } catch (\Exception $e) {
            // do nothing
        }
        return $value;
    }
}
