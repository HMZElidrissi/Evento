<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Reservation;
use App\Services\JWTService;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Event::query()->with('category', 'organizer')->where('status', 'approved');
        if (request()->has('category')) {
            $query->where('category_id', request('category'));
        }
        if (request()->has('search')) {
            $query->where('title', 'like', '%'.request('search').'%');
        }
        $events = $query->paginate(3);
        return response()->json($events);
    }

    /**
     * Register in an event.
     */
    public function register(Event $event)
    {
        $reservation = Reservation::create([
            'event_id' => $event->id,
            'user_id' => JWTService::getUser()->id
        ]);
        if ($event->organizer->auto_approve) {
            $reservation->status = 'approved';
            $reservation->save();
        }
        return response()->json($reservation, 201);
    }
}
