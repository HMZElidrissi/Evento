<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\EventController as ClientEventController;
use App\Http\Controllers\Client\ReservationController as ClientReservationController;
use App\Http\Controllers\Organizer\EventController as OrganizerEventController;
use App\Http\Controllers\Organizer\ReservationController as OrganizerReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('jwt')->group(function () {
    // Profile
    Route::get('/me', [AuthController::class, 'me']);

    // Organizer Events
    Route::get('/my-events', [OrganizerEventController::class, 'index']);
    Route::post('/my-events', [OrganizerEventController::class, 'store']);
    Route::get('/my-events/{event}', [OrganizerEventController::class, 'show']);
    Route::put('/my-events/{event}', [OrganizerEventController::class, 'update']);
    Route::delete('/my-events/{event}', [OrganizerEventController::class, 'destroy']);

    // Admin Events
    Route::get('/events', [EventController::class, 'index']);
    Route::put('/events/{event}/approve', [EventController::class, 'approve']);
    Route::put('/events/{event}/reject', [EventController::class, 'reject']);

    // Clients Events
    Route::post('/events/{event}/register', [ClientEventController::class, 'register']);

    // Clients Reservations
    Route::get('/my-reservations', [ClientReservationController::class, 'index']);
    Route::get('/my-reservations/{reservation}/download', [ClientReservationController::class, 'download']);

    // Organizer Reservations
    Route::get('/reservations', [OrganizerReservationController::class, 'index']);
    Route::put('/reservations/{reservation}/approve', [OrganizerReservationController::class, 'approve']);
    Route::put('/reservations/{reservation}/reject', [OrganizerReservationController::class, 'reject']);
    Route::put('/reservations/config', [OrganizerReservationController::class, 'updateReservationConfig']);
    Route::get('/reservations/config', [OrganizerReservationController::class, 'getReservationConfig']);

    // Categories
    Route::get('/categories/{category}', [CategoryController::class, 'show']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    // Users
    Route::get('/users', [UserController::class, 'index']);
    Route::put('/users/{user}/revoke-access', [UserController::class, 'revokeAccess']);
    Route::put('/users/{user}/restore-access', [UserController::class, 'restoreAccess']);
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Clients Events
Route::get('/available-events', [ClientEventController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
