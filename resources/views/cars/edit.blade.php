<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Car</h2>
            <a href="{{ route('cars.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition">Back</a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto py-6 px-4">
        <form action="{{ route('cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <!-- Make -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Make</label>
                <input type="text" name="make" id="make" value="{{ $car->make }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <!-- Model -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Model</label>
                <input type="text" name="model" id="model" value="{{ $car->model }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <!-- Year -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Year</label>
                <input type="number" name="year" id="year" value="{{ $car->year }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <!-- Rate Option -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Rate Option</label>
                <select name="price_type" id="price_type" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    <option value="per_day" {{ ($car->price_per_day>0) ? 'selected' : '' }}>Per Day</option>
                    <option value="per_week" {{ ($car->price_per_week>0) ? 'selected' : '' }}>Per Week</option>
                    <option value="per_month" {{ ($car->price_per_month>0) ? 'selected' : '' }}>Per Month</option>
                </select>
            </div>
            <!-- Price -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Price</label>
                <input type="text" name="price" id="price" value="{{ $car->price_per_day ?: ($car->price_per_week ?: $car->price_per_month) }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <!-- Seats -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Seats</label>
                <input type="number" name="seats" id="seats" value="{{ $car->seats }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md" >{{ $car->description }}</textarea>
            </div>
            <!-- Current Image Preview -->
            @if($car->image_path)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Current Image</label>
                    <img src="{{ Storage::url($car->image_path) }}" class="h-48 w-full object-cover rounded-md">
                </div>
            @endif
            <!-- New Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Upload New Image (optional)</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full" accept="image/*">
            </div>
            <!-- Submit -->
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Save changes</button>
            </div>
        </form>
    </div>

</x-app-layout>
