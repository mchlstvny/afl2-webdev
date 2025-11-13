<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // Get events with pagination (9 events per page)
        $events = Event::with('tickets')->latest()->paginate(9);
        
        return view('events.index', compact('events'));
    }

    public function show($id)
    {
        $event = Event::with('tickets')->findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function home()
    {
        $latestEvents = Event::with('tickets')->latest()->take(6)->get();
        return view('home', compact('latestEvents'));
    }

     public function apiIndex(): JsonResponse
    {
        try {
            $events = Event::with('tickets')
                ->latest()
                ->paginate(12);

            return response()->json([
                'success' => true,
                'data' => $events,
                'message' => 'Events retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve events',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * API: Get single event
     */
    public function apiShow($id): JsonResponse
    {
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
                'data' => $event,
                'message' => 'Event retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve event',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * API: Get event tickets
     */
    public function apiTickets($id): JsonResponse
    {
        try {
            $tickets = Ticket::where('event_id', $id)
                ->where('quantity_available', '>', 0)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $tickets,
                'message' => 'Event tickets retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve event tickets',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
