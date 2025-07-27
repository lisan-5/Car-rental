<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Car;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['car_id' => 'required|exists:cars,id']);
        /** @var User $user */
        $user = Auth::user();
        // prevent duplicates
        if (!$user->carts()->where('car_id', $request->car_id)->exists()) {
            $user->carts()->create(['car_id' => $request->car_id]);
        }
        return back()->with('success', 'Added to cart.');
    }

    public function index()
    {
        // Fetch carts for the authenticated user
        $carts = Cart::with('car')
            ->where('user_id', Auth::id())
            ->get();
        return view('mycart', compact('carts'));
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id === Auth::id()) {
            $cart->delete();
        }
        return back()->with('success', 'Removed from cart.');
    }
}
