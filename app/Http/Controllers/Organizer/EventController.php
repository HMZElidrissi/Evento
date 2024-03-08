<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\JWTService;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = JWTService::getUser();
        $events = Event::with('category')->where('organizer_id', $user->id)->get();
        return response()->json($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $attributes = $request->validated();
        $user = JWTService::getUser();
        $attributes['organizer_id'] = $user->id;
        $event = Event::create($attributes);
        return response()->json($event, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::with('category')->find($id);
        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, string $id)
    {
        $event = Event::with('category')->find($id);
        $attributes = $request->validated();
        $event->update($attributes);
        return response()->json($event, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::find($id);
        $event->delete();
        return response()->json(null, 204);
    }
}
