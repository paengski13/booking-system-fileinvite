<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

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
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getBookings($request)
    {
        $startDateSearch = $request->input('start_date');
        $endDateSearch = $request->input('end_date');
        $roomIdSearch = $request->input('room_id');
        $fulltextSearch = $request->input('full_text');
        $myBookingSearch = $request->input('my_bookings', null);
        $orderBy = $request->input('order_by', 'starts_at');
        $sortBy = $request->input('sort_by', 'desc');

        $query = $this->model
            ->when($myBookingSearch, function ($query, $myBookingSearch) {
                return $query->where('user_id', $myBookingSearch);
            })
            ->when($roomIdSearch, function ($query, $roomIdSearch) {
                return $query->where('room_id', $roomIdSearch);
            })
            ->when($fulltextSearch, function ($query, $fulltextSearch) {
                return $query->where(function($query) use ($fulltextSearch) {
                    $query->whereHas('room', function (Builder $query) use ($fulltextSearch) {
                        $query->where('name', 'like', '%' . $fulltextSearch . '%');
                    })->orWhereHas('user', function (Builder $query) use ($fulltextSearch) {
                        $query->where('name', 'like', '%' . $fulltextSearch . '%');
                    });
                });
            });

        if ($startDateSearch && $endDateSearch) {
            $query->whereBetween('starts_at', [$startDateSearch, $endDateSearch]);
        }

        $query = $query->orderBy($orderBy, $sortBy);

        return $query;
    }

    /**
     * Create a booking record
     *
     * @param Request $request
     * @return \App\Models\Booking
     */
    public function createBooking($request)
    {
        return $this->model->create([
            'user_id' => Auth::user()->id,
            'room_id' => $request->input('room_id'),
            'starts_at' => $request->input('starts_at'),
            'ends_at' => $request->input('ends_at'),
            'notes' => $request->input('notes'),
        ]);
    }

    /**
     * Create a booking record
     *
     * @param int $id
     * @return \App\Models\Booking
     */
    public function getBooking($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update a booking record
     *
     * @param Request $request
     * @param int $id
     * @return \App\Models\Booking
     */
    public function updateBooking($request, $id)
    {
        $booking = $this->getBooking($id);
        // TODO: check if auth user is the same as the one who booked it, otherwise, throw an authorizeException
        $booking->room_id = $request->input('room_id');
        $booking->starts_at = $request->input('starts_at');
        $booking->ends_at = $request->input('ends_at');
        $booking->notes = $request->input('notes');
        $booking->update();

        return $booking;
    }

    /**
     * Delete a booking record
     *
     * @param int $id
     * @return \App\Models\Booking
     */
    public function deleteBooking($id)
    {
        $booking = $this->getBooking($id);
        return $booking->delete();
    }
}