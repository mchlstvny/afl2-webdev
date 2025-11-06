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
}