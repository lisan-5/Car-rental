<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of all cars for admins.
     */
    public function index()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403);
        }
        $cars = Car::with('user')->get();
        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Show the form for editing the specified car.
     */
    public function edit(Car $car)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }
        return view('admin.cars.edit', compact('car'));
    }

    /**
     * Update the specified car in storage.
     */
    public function update(Request $request, Car $car)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }
        $data = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'price_type' => 'required|in:per_day,per_week,per_month',
            'price' => 'required|numeric',
            'seats' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'is_rented' => 'sometimes|boolean',
        ]);
        // assign prices
        $type = $data['price_type'];
        $price = $data['price'];
        $data['price_per_day'] = $type === 'per_day' ? $price : 0;
        $data['price_per_week'] = $type === 'per_week' ? $price : 0;
        $data['price_per_month'] = $type === 'per_month' ? $price : 0;
        unset($data['price_type'], $data['price']);
        // handle image
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('images/cars', 'public');
        }
        $car->update($data);
        return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified car from storage.
     */
    public function destroy(Car $car)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully.');
    }
}
