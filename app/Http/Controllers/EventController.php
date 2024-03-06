<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return Event::with('category')->get();
    }

    public function store(StoreEventRequest $request)
    {
        $attributes = $request->validated();
        $event = Event::create($attributes);
        return response()->json($event, 201);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $attributes = $request->validated();
        $event->update($attributes);
        return response()->json($event, 200);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(null, 204);
    }

    /*public function search(Request $request)
    {
        $search = $request->input('search');
        return Event::where('title', 'like', "%$search%")->get();
    }*/
}
