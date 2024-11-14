<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'service', 'serviceProvider'])->get();
        return response()->json($bookings);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'service_provider_id' => 'required|exists:service_providers,id',
            'booking_time' => 'required|date',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $booking = Booking::create($validatedData);

        return response()->json(['message' => 'Booking created successfully', 'booking' => $booking], 201);
    }
}
