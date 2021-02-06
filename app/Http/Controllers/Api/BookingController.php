<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexBookingRequest;
use App\Http\Resources\BookingCollection;
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
        return new BookingCollection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
