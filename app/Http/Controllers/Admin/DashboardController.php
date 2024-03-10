<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $numberOfOrganizers = User::where('role_id', 2)->count();
        $numberOfEvents = Event::all()->count();
        $numberOfCategories = Category::all()->count();
        return response()->json([
            'numberOfOrganizers' => $numberOfOrganizers, 'numberOfEvents' => $numberOfEvents,
            'numberOfCategories' => $numberOfCategories
        ]);
    }
}
