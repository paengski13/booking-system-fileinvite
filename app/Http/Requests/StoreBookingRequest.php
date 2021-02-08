<?php

namespace App\Http\Requests;

use App\Rules\BookingDuration;
use App\Rules\BookingExist;
use App\Rules\SameDate;
use App\Rules\TimePeriod;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'room_id' => ['required', 'integer', 'exists:rooms,id'],
            'starts_at' => ['required', 'date', 'date_format:Y-m-d H:i:s',
                new SameDate($this->input('ends_at')),
                new BookingDuration($this->input('ends_at')),
                new TimePeriod(),
                new BookingExist($this->route('id'), $this->input('starts_at'), $this->input('ends_at')),
            ],
            'ends_at' => ['required', 'date', 'after:starts_at', 'date_format:Y-m-d H:i:s', new TimePeriod()],
        ];
    }
}
