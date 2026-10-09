<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'package', 'photographer'])
            ->latest('booking_date')
            ->latest('start_time')
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,confirmed,completed,cancelled'],
        ]);

        $booking->update($data);

        return redirect()->route('admin.bookings.index')->with('status', 'Status booking diperbarui.');
    }
}