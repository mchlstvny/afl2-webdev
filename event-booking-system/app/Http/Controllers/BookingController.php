<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'user_id' => auth()->id() ?? 1, // For demo, use user 1 if not authenticated
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
}