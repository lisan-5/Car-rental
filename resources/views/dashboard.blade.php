<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    @php
        // Initialize cars if not provided
        $cars = $cars ?? collect();
    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold">My Cars</h3>
                <a href="{{ route('cars.create') }}" class="px-4 py-2 text-white bg-blue-600  rounded">Add New Car</a>
            </div>
            @if($cars->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-600">
                    You have not posted any cars yet.
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($cars as $car)
                        <div class="bg-white shadow rounded-lg overflow-hidden flex flex-col">
                            @if($car->image_path)
                                <img src="{{ Storage::url($car->image_path) }}" alt="{{ $car->make }} {{ $car->model }}" class="h-40 w-full object-cover">
                            @else
                                <div class="h-40 w-full bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                            @endif
                            <div class="p-4 flex-1 flex flex-col justify-between">
                                <div>
                                    <h4 class="text-md font-semibold">{{ $car->year }} {{ $car->make }} {{ $car->model }}</h4>
                                </div>
                                <div class="mt-4 flex space-x-2">
                                    <a href="{{ route('cars.edit', $car) }}" class="px-2 py-1 bg-green-600 text-white text-sm rounded">Edit</a>
                                    <form action="{{ route('cars.destroy', $car) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-600 text-white text-sm rounded">Delete</button>
                                    </form>
                                    <form action="{{ route('cars.toggleRent', $car) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="px-2 py-1 bg-yellow-500  text-white text-sm rounded">
                                            {{ $car->is_rented ? 'Mark Available' : 'Mark Rented' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <!-- Rental Requests Section -->
            <div class="mt-12">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Rental Requests</h3>
                </div>
                @if(isset($requests) && $requests->isEmpty())
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-600">
                        No rental requests at this time.
                    </div>
                @elseif(isset($requests))
                    <div class="space-y-4">
                        @foreach($requests as $request)
                            @php($status = $request->status)
                            <div class="bg-white shadow rounded-lg p-4 flex justify-between items-start {{ $status != 'pending' ? 'opacity-50 pointer-events-none' : '' }}">
                                <div class="flex-1">
                                    <p><strong>Car:</strong> {{ $request->car->make }} {{ $request->car->model }}</p>
                                    <p><strong>From:</strong> {{ $request->name }} ({{ $request->email }})</p>
                                    <p><strong>Duration:</strong> {{ $request->duration }}</p>
                                    @if($request->message)
                                        <p><strong>Message:</strong> {{ $request->message }}</p>
                                    @endif
                                    <p class="text-xs text-gray-500">Requested on {{ $request->created_at->format('F j, Y') }}</p>
                                </div>
                                <div class="ml-4 flex flex-col space-y-2">
                                    @if($status == 'accepted')
                                        <span class="px-3 py-1 bg-green-600  text-sm rounded">Accepted</span>
                                    @elseif($status == 'rejected')
                                        <span class="px-3 py-1 bg-red-600 text-white text-sm rounded">Rejected</span>
                                    @else
                                        <a href="{{ route('cars.show', $request->car) }}" class="px-3 py-1 bg-blue-600 text-sm rounded">View Car</a>
                                        <form action="{{ route('rentals.accept', $request) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-3 py-1 bg-green-600 text-sm rounded hover:bg-green-700">
                                                Accept
                                            </button>
                                        </form>
                                        <form action="{{ route('rentals.reject', $request) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                                Reject
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
        </div>
    </div>
</x-app-layout>
