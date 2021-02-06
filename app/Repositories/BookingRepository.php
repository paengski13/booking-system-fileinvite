<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class BookingRepository extends Model
{
    /**
     * The name of the corresponding model.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * BookingRepository constructor.
     * @param Booking $booking
     */
    public function __construct(Booking $booking)
    {
        $this->model = $booking;
    }

    /**
     * Get list of bookings based on user's search criteria and sort order
     *
     * @param Request $request
     * @return bool
     */
    public function getBookings($request)
    {
        $startDateSearch = $request->input('start_date');
        $endDateSearch = $request->input('end_date');
        $roomNameSearch = $request->input('room_name');
        $orderBy = $request->input('order_by', 'starts_at');
        $sortBy = $request->input('sort_by', 'desc');

        $query = $this->model
            ->when($roomNameSearch, function ($query, $roomNameSearch) {
                return $query->whereHas('room', function (Builder $query) use ($roomNameSearch) {
                    $query->where('name', 'like', '%' . $roomNameSearch . '%');
                });
            });

        if ($startDateSearch && $endDateSearch) {
            $query->whereBetween('starts_at', [$startDateSearch, $endDateSearch]);
        }

        $query = $query->orderBy($orderBy, $sortBy);

        return $query;
    }
}