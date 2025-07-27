<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    /**
     * Show the rental request form for a specific car.
     */
    public function create(Car $car)
    {
        return view('cars.rent', compact('car'));
    }

    /**
     * Store a rental request.
     */
    public function store(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'duration' => 'required|string|max:100',
            'message' => 'nullable|string',
        ]);

        $validated['car_id'] = $car->id;
        $validated['user_id'] = Auth::id();

        Rental::create($validated);
        // Redirect to cars listing after successful rental request
        return redirect()->route('cars.index')
            ->with('success', 'Your rental request has been submitted.');
    }
    /**
     * Accept a rental request (mark car as rented).
     */
    public function accept(Rental $rental)
    {
        // Only owner of the car can accept
        if ($rental->car->user_id !== Auth::id()) {
            abort(403);
        }
        // Mark this rental as accepted
        $rental->update(['status' => 'accepted']);
        // Delete any other rental requests for this car
        Rental::where('car_id', $rental->car_id)
            ->where('id', '!=', $rental->id)
            ->delete();
        // Mark car as rented
        $car = $rental->car;
        $car->update(['is_rented' => true]);
        return back()->with('success', 'Rental request accepted; other requests rejected.');
    }

    /**
     * Reject a rental request (delete it).
     */
    public function reject(Rental $rental)
    {
        // Only owner of the car can reject
        if ($rental->car->user_id !== Auth::id()) {
            abort(403);
        }
        // Mark this rental as rejected
        $rental->update(['status' => 'rejected']);
        return back()->with('success', 'Rental request rejected.');
    }
}
