<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $car->make }} {{ $car->model }}</h2>
            <a href="{{ route('cars.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded">Back</a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6 px-4 space-y-6">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($car->image_path)
                <img src="{{ Storage::url($car->image_path) }}" alt="{{ $car->make }} {{ $car->model }}" class="w-full h-auto object-contain">
            @endif
            <div class="p-6">
                <h3 class="text-2xl font-bold mb-4">{{ $car->year }} {{ $car->make }} {{ $car->model }}</h3>
                <p class="mb-4">{{ $car->description }}</p>
                <ul class="space-y-2">
                    <li><strong>Seats:</strong> {{ $car->seats }}</li>
                    @if($car->price_per_day > 0)
                        <li><strong>Price per Day:</strong> {{ $car->price_per_day }} ETB</li>
                    @endif
                    @if($car->price_per_week > 0)
                        <li><strong>Price per Week:</strong> {{ $car->price_per_week }} ETB</li>
                    @endif
                    @if($car->price_per_month > 0)
                        <li><strong>Price per Month:</strong> {{ $car->price_per_month }} ETB</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    @auth
        @if(auth()->id() !== $car->user_id)
            <div class="max-w-4xl mx-auto py-6 px-4">
                <a href="{{ route('cars.rent.create', $car) }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Rent this Car
                </a>
            </div>
        @endif
    @endauth
</x-app-layout>
