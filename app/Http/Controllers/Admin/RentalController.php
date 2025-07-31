<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    /**
     * Display a listing of all rental requests for admins.
     */
    public function index()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403);
        }
        $rentals = Rental::with('car', 'user')->get();
        return view('admin.rentals.index', compact('rentals'));
    }

    /**
     * Show the form for editing the specified rental request.
     */
    public function edit(Rental $rental)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }
        return view('admin.rentals.edit', compact('rental'));
    }

    /**
     * Update the specified rental request in storage.
     */
    public function update(Request $request, Rental $rental)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }
        $data = $request->validate([
            'duration' => 'required|string|max:10',
            'message' => 'nullable|string',
            'status'  => 'required|in:pending,accepted,rejected',
        ]);
        $rental->update($data);

        // If accepted, mark car rented and remove other requests
        if ($data['status'] === 'accepted') {
            $rental->car->update(['is_rented' => true]);
            Rental::where('car_id', $rental->car_id)
                ->where('id', '!=', $rental->id)
                ->delete();
        }

        return redirect()->route('admin.rentals.index')
            ->with('success', 'Rental request updated successfully.');
    }

    /**
     * Remove the specified rental request from storage.
     */
    public function destroy(Rental $rental)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }
        $rental->delete();
        return redirect()->route('admin.rentals.index')
            ->with('success', 'Rental request deleted successfully.');
    }
}
