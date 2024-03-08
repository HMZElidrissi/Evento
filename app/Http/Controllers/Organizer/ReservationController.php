<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Services\JWTService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = JWTService::getUser();
        $events = $user->events;
        $reservations = Reservation::with('event', 'user')->whereIn('event_id', $events->pluck('id'))->get();
        return response()->json($reservations);
    }

    /**
     * Approve the reservation
     */
    public function approve(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = 'approved';
        $reservation->save();
        return response()->json($reservation);
    }

    /**
     * Reject the reservation
     */
    public function reject(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = 'rejected';
        $reservation->save();
        return response()->json($reservation);
    }

    /**
     * Change the settings of how the reservations are accepted
     */
    public function updateReservationConfig()
    {
        $user = JWTService::getUser();
        $user->auto_approve = !$user->auto_approve;
        $user->save();
        return response()->json(['auto_approve' => $user->auto_approve]);
    }

    public function getReservationConfig()
    {
        $user = JWTService::getUser();
        return response()->json(['auto_approve' => $user->auto_approve]);
    }
}
