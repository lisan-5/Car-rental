<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-purple-800 leading-tight">Cars</h2>
            <a href="{{ route('cars.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-400">Add Car</a>
        </div>
    </x-slot>

    <div class="py-6">
        @if(session('success'))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Form -->
            <form method="GET" action="{{ route('cars.index') }}" class="mb-6">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by make, model, year or description..."
                    class="w-full sm:w-1/2 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"
                />
            </form>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 ">
                @forelse($cars as $car)
                    <div class="relative bg-white shadow rounded-lg overflow-hidden flex flex-col cursor-pointer" onclick="window.location='{{ route('cars.show', $car) }}'">

                        <div class="absolute top-2 right-2 {{ auth()->id() === $car->user_id ? 'bg-blue-600 text-white' : 'bg-gray-800 text-white' }} text-xs px-2 py-1 rounded z-10">
                            {{ auth()->id() === $car->user_id ? 'You' : $car->user->name }}
                        </div>
                        @if($car->image_path)
                            <img src="{{ Storage::url($car->image_path) }}" alt="{{ $car->make }} {{ $car->model }}" class="h-48 w-full object-cover">
                        @else
                            <div class="h-48 w-full bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                        @endif
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-semibold">{{ $car->year }} {{ $car->make }} {{ $car->model }}</h3>
                                <p class="mt-2 text-gray-600 text-sm line-clamp-3">{{ $car->description }}</p>
                            </div>
                            <!-- Detailed info hidden on index; view full details on show page -->
                            <div class="mt-4 flex flex-wrap space-x-2">
                                <button type="button" onclick="event.stopPropagation(); window.location='{{ route('cars.show', $car) }}'" class="px-2 py-1 bg-blue-800 text-white text-sm rounded hover:bg-blue-500">More...</button>
                                @if(auth()->id() === $car->user_id)
                                    <button type="button" onclick="event.stopPropagation(); window.location='{{ route('cars.edit', $car) }}'" class="px-2 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-400">Edit</button>
                                @endif
                                @if(auth()->check() && auth()->id() !== $car->user_id && !in_array($car->id, $cartIds))
                                    <form action="{{ route('cart.store') }}" method="POST" class="inline" onclick="event.stopPropagation()">
                                        @csrf
                                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                                        <button type="submit" class="px-2 py-1 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-300">Add to Cart</button>
                                    </form>
                                @endif
                                @if(auth()->id() === $car->user_id)
                                    <button type="button"
                                            onclick="event.stopPropagation()"
                                            class="open-delete-modal px-2 py-1 text-white bg-red-600 text-sm rounded hover:bg-red-400"
                                            data-id="{{ $car->id }}"
                                            data-make="{{ $car->make }}"
                                            data-model="{{ $car->model }}"
                                            data-created="{{ $car->created_at->format('F j, Y') }}">
                                        Delete
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">No cars available.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg max-w-sm w-full">
        <h2 class="text-xl font-semibold mb-4">Confirm Deletion</h2>
        <p id="delete-modal-info" class="mb-4 text-gray-700"></p>
        <div class="flex justify-end space-x-3">
            <button id="cancel-delete" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
            <form id="delete-form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
            </form>
        </div>
    </div>
</div>
<!-- By JS -->

<script>
    document.querySelectorAll('.open-delete-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            const make = btn.dataset.make;
            const model = btn.dataset.model;
            const created = btn.dataset.created;
            // Set modal info
            document.getElementById('delete-modal-info').textContent =
                `Car: ${make} ${model} (Created: ${created})`;
            // Set form action
            document.getElementById('delete-form').action = `/cars/${id}`;
            // Show modal
            const modal = document.getElementById('delete-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });
    // Cancel button
    document.getElementById('cancel-delete').addEventListener('click', () => {
        const modal = document.getElementById('delete-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });
</script>
