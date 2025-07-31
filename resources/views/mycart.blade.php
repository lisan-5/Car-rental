<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight">
            {{ __('My Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if($carts->isEmpty())
                    <p class="text-gray-600">Your cart is empty.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($carts as $cart)
                            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg shadow">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $cart->car->make }} {{ $cart->car->model }}</h3>
                                    <p class="text-sm text-gray-600">Added on {{ $cart->created_at->format('F j, Y') }}</p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('cars.show', $cart->car) }}"
                                       class="px-3 py-1 bg-blue-500  text-white text-sm rounded hover:bg-blue-700">
                                        Show
                                    </a>
                                    <form action="{{ route('cart.destroy', $cart) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-700">Remove</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
