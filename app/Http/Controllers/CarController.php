<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Only show cars that are not marked as rented
        $cars = Car::where('is_rented', false)->with('user')->get();
        $cartIds = [];
        if (Auth::check()) {
            // Retrieve cart car IDs directly via Cart model
            $cartIds = \App\Models\Cart::where('user_id', Auth::id())
                ->pluck('car_id')
                ->toArray();
        }
        return view('cars.index', compact('cars', 'cartIds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'price_type' => 'required|in:per_day,per_week,per_month',
            'price' => 'required|numeric',
            'seats' => 'required|integer|min:1',
            'description' => 'required|string',
        ]);
        // Associate car with the authenticated user
        $validated['user_id'] = Auth::id();
        // Assign single price to appropriate column
        $type = $validated['price_type'];
        $value = $validated['price'];
        $validated['price_per_day'] = $type === 'per_day' ? $value : 0;
        $validated['price_per_week'] = $type === 'per_week' ? $value : 0;
        $validated['price_per_month'] = $type === 'per_month' ? $value : 0;
        unset($validated['price_type'], $validated['price']);
        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('images/cars', 'public');
        }
        Car::create($validated);
        return redirect()->route('cars.index')->with('success', 'Car added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        // Only owner can edit
        if ($car->user_id !== Auth::id()) {
            abort(403);
        }
        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        // Only owner can update
        if ($car->user_id !== Auth::id()) {
            abort(403);
        }
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'price_type' => 'required|in:per_day,per_week,per_month',
            'price' => 'required|numeric',
            'seats' => 'required|integer|min:1',
            'description' => 'required|string',
        ]);
        // Assign single price to appropriate column
        $type = $validated['price_type'];
        $value = $validated['price'];
        $validated['price_per_day'] = $type === 'per_day' ? $value : 0;
        $validated['price_per_week'] = $type === 'per_week' ? $value : 0;
        $validated['price_per_month'] = $type === 'per_month' ? $value : 0;
        unset($validated['price_type'], $validated['price']);
        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('images/cars', 'public');
        }
        $car->update($validated);
        return redirect()->route('cars.index')->with('success', 'Car updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        // Only owner can delete
        if ($car->user_id !== Auth::id()) {
            abort(403);
        }
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car deleted.');
    }

    /**
     * Toggle the rented status of a car.
     */
    public function toggleRent(Car $car)
    {
        // Only owner can toggle
        if ($car->user_id !== Auth::id()) {
            abort(403);
        }
        // Toggle rented status
        $newStatus = !$car->is_rented;
        $car->update(['is_rented' => $newStatus]);
        // If now available, reset all rental request statuses to pending
        if (!$newStatus) {
            Rental::where('car_id', $car->id)->update(['status' => 'pending']);
        }
        return back()->with('success', $newStatus ? 'Car marked as rented.' : 'Car marked as available.');
    }
}
