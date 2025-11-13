<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\UserController;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Booking;

// Root API
Route::get('/', function () {
    return response()->json([
        'message' => 'Event Booking API is working!',
        'status' => 'OK',
        'endpoints' => [
            'GET /api/events' => 'Get all events',
            'GET /api/events/{id}' => 'Get single event', 
            'POST /api/bookings' => 'Create new booking',
            'GET /api/bookings/{booking_code}' => 'Get booking by code',
            'GET /api/users' => 'Get all users',
            'GET /api/users/{id}' => 'Get single user'
        ]
    ]);
});

// Events routes
Route::get('/events', function () {
    try {
        $events = Event::with('tickets')->latest()->take(10)->get();
        
        return response()->json([
            'success' => true,
            'data' => $events,
            'message' => 'Events retrieved successfully'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
});

Route::get('/events/{id}', function ($id) {
    try {
        $event = Event::with('tickets')->find($id);
        
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $event
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
});

// Bookings routes
Route::post('/bookings', function (Request $request) {
    try {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'ticket_id' => 'required|exists:tickets,id', 
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $ticket = Ticket::find($request->ticket_id);

        if ($ticket->quantity_available < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough tickets available. Only ' . $ticket->quantity_available . ' left.'
            ], 400);
        }

        $booking = Booking::create([
            'user_id' => $request->user_id,
            'ticket_id' => $request->ticket_id,
            'quantity' => $request->quantity,
            'total_price' => $ticket->price * $request->quantity,
            'booking_code' => 'BK-' . strtoupper(\Illuminate\Support\Str::random(8)),
            'status' => 'confirmed'
        ]);

        $ticket->decrement('quantity_available', $request->quantity);

        return response()->json([
            'success' => true,
            'message' => 'Booking created successfully!',
            'data' => [
                'booking_code' => $booking->booking_code,
                'event' => $ticket->event->name,
                'ticket_type' => $ticket->type,
                'quantity' => $booking->quantity,
                'total_price' => 'Rp ' . number_format($booking->total_price, 0, ',', '.'),
                'status' => $booking->status
            ]
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Server error: ' . $e->getMessage()
        ], 500);
    }
});

Route::get('/bookings/{booking_code}', function ($booking_code) {
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
            'data' => $booking
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
});

// Users routes 
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);