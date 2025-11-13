<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $ticket = Ticket::with('event')->findOrFail($request->ticket_id);

        if ($ticket->quantity_available < $request->quantity) {
            return back()->with('error', 'Not enough tickets available.');
        }

        $booking = Booking::create([
            'user_id' => auth()->id() ?? 1, 
            'ticket_id' => $request->ticket_id,
            'quantity' => $request->quantity,
            'total_price' => $ticket->price * $request->quantity,
            'booking_code' => 'BK-' . strtoupper(Str::random(8)),
            'status' => 'confirmed'
        ]);

        // Update ticket quantity
        $ticket->decrement('quantity_available', $request->quantity);

        return redirect()->route('booking.confirmation', $booking)
            ->with('success', 'Booking confirmed!');
    }

    public function confirmation(Booking $booking)
    {
        $booking->load(['ticket.event', 'user']);
        return view('booking.confirmation', compact('booking'));
    }

    /**
     * API: Create new booking
     */
    public function apiStore(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'ticket_id' => 'required|exists:tickets,id',
                'quantity' => 'required|integer|min:1'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $ticket = Ticket::find($request->ticket_id);

            // Check ticket availability
            if ($ticket->quantity_available < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Not enough tickets available. Only ' . $ticket->quantity_available . ' tickets left.'
                ], 400);
            }

            $booking = Booking::create([
                'user_id' => $request->user_id,
                'ticket_id' => $request->ticket_id,
                'quantity' => $request->quantity,
                'total_price' => $ticket->price * $request->quantity,
                'booking_code' => 'API-' . strtoupper(Str::random(8)),
                'status' => 'confirmed'
            ]);

            // Update ticket quantity
            $ticket->decrement('quantity_available', $request->quantity);

            return response()->json([
                'success' => true,
                'data' => $booking->load(['ticket.event', 'user']),
                'message' => 'Booking created successfully'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * API: Get booking by booking code
     */
    public function apiShow($booking_code): JsonResponse
    {
        try {
            $booking = Booking::with(['ticket.event', 'user'])
                ->where('booking_code', $booking_code)
                ->first();

            if (!$booking) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $booking,
                'message' => 'Booking retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * API: Get user bookings
     */
    public function apiUserBookings($user_id): JsonResponse
    {
        try {
            $bookings = Booking::with(['ticket.event'])
                ->where('user_id', $user_id)
                ->latest()
                ->get();

            return response()->json([
                'success' => true,
                'data' => $bookings,
                'message' => 'User bookings retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve user bookings',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}