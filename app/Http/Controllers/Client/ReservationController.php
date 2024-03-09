<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Services\JWTService;
use Barryvdh\DomPDF\Facade\Pdf;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = JWTService::getUser()->id;
        $reservations = Reservation::with('user', 'event')
            ->where('status', 'approved')
            ->where('user_id', $userId)
            ->get();
        return response()->json($reservations);
    }

    /**
     * Download the ticket for the specified reservation.
     */
    public function download($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        $event = $reservation->event->title;
        $user = JWTService::getUser()->name;
        $pdf = PDF::loadView('ticket', ['event' => $event, 'user' => $user]);

        return $pdf->download('ticket.pdf');
    }
}
