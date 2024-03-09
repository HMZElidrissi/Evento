<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->where('role_id', '!=', 1)->get();
        return response()->json($users, 200);
    }

    /**
     * Revoke access to the application.
     */
    public function revokeAccess(User $user)
    {
        $user->is_active = false;
        $user->save();
        return response()->json($user, 200);
    }

    /**
     * Restore access to the application.
     */
    public function restoreAccess(User $user)
    {
        $user->is_active = true;
        $user->save();
        return response()->json($user, 200);
    }
}
