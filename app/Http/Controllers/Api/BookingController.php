<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexBookingRequest;
use App\Http\Resources\BookingCollection;
use App\Http\Resources\BookingResource;
use Illuminate\Http\Request;
use App\Repositories\BookingRepository;

class BookingController extends Controller
{
    public $bookingRepo;

    /**
     * BookingRepository constructor.
     * @param BookingRepository $bookingRepo
     */
    public function __construct(BookingRepository $bookingRepo)
    {
        $this->bookingRepo = $bookingRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\IndexBookingRequest  $request
     * @return \App\Http\Resources\BookingCollection
     */
    public function index(IndexBookingRequest $request)
    {
        $collection = $this->bookingRepo->getBookings($request)->paginate(3);
        return new BookingCollection($collection, "");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookingRequest $request
     * @return \App\Http\Resources\BookingResource
     */
    public function store(StoreBookingRequest $request)
    {
        $booking = $this->bookingRepo->createBooking($request);
        return new BookingResource($booking);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\BookingResource
     */
    public function show($id)
    {
        $booking = $this->bookingRepo->getBooking($id);
        return new BookingResource($booking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookingRequest $request
     * @param  int  $id
     * @return \App\Http\Resources\BookingResource
     */
    public function update(Request $request, $id)
    {
        $booking = $this->bookingRepo->updateBooking($request, $id);
        return new BookingResource($booking);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \App\Http\Resources\BookingResource
     */
    public function destroy($id)
    {
        return $this->bookingRepo->deleteBooking($id);
    }
}
