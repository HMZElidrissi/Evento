<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index()
    {
        $events = Event::with('organizer', 'category')->get();
        return response()->json($events);
    }

    /**
     * Approve the event.
     */
    public function approve(Event $event)
    {
        $event->update([
            'status' => 'approved'
        ]);
        return response()->json($event);
    }

    /**
     * Reject the event.
     */
    public function reject(Event $event)
    {
        $event->update([
            'status' => 'rejected'
        ]);
        return response()->json($event);
    }
}
