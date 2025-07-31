<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of all users for admins.
     */
    public function index()
    {
        // Only allow admins
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403);
        }
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'is_admin' => 'sometimes|boolean',
        ]);
        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
