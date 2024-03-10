<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Services\JWTService;

class DashboardController extends Controller
{
    public function index()
    {
        $user = JWTService::getUser();
        $numberOfOrganizerEvents = $user->events->count();
        $numberOfReservations = $user->events->pluck('reservations')->flatten()->count();
        $numberOfCategories = $user->events->pluck('category')->flatten()->unique()->count();
        return response()->json([
            'numberOfOrganizerEvents' => $numberOfOrganizerEvents, 'numberOfReservations' => $numberOfReservations,
            'numberOfCategories' => $numberOfCategories
        ]);
    }
}
