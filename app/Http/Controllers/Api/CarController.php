<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $cars = Car::where('user_id', Auth::id())->get();
        return response()->json($cars);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'price_per_day' => 'required|numeric',
            'price_per_week' => 'required|numeric',
            'price_per_month' => 'required|numeric',
            'seats' => 'required|integer|min:1',
            'description' => 'required|string',
        ]);
        $validated['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('images/cars', 'public');
        }

        $car = Car::create($validated);

        return response()->json($car, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $car = Car::findOrFail($id);
        if ($car->user_id !== Auth::id()) {
            return response()->json(['error' => 'Forbidden'], Response::HTTP_FORBIDDEN);
        }
        return response()->json($car);
    }

    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);
        if ($car->user_id !== Auth::id()) {
            return response()->json(['error' => 'Forbidden'], Response::HTTP_FORBIDDEN);
        }

        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'price_per_day' => 'required|numeric',
            'price_per_week' => 'required|numeric',
            'price_per_month' => 'required|numeric',
            'seats' => 'required|integer|min:1',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('images/cars', 'public');
        }

        $car->update($validated);

        return response()->json($car);
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        if ($car->user_id !== Auth::id()) {
            return response()->json(['error' => 'Forbidden'], Response::HTTP_FORBIDDEN);
        }

        $car->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
