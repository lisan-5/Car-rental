<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Car</h2>
            <a href="{{ route('admin.cars.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                Back
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto py-6 px-4">
        @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="make" class="block text-sm font-medium text-gray-700">Make</label>
                <input type="text" name="make" id="make" value="{{ old('make', $car->make) }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                <input type="text" name="model" id="model" value="{{ old('model', $car->model) }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                <input type="number" name="year" id="year" value="{{ old('year', $car->year) }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="price_type" class="block text-sm font-medium text-gray-700">Rate Option</label>
                <select name="price_type" id="price_type" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    <option value="per_day" {{ (old('price_type', $car->price_per_day > 0 ? 'per_day' : ( $car->price_per_week>0 ? 'per_week' : 'per_month'))) === 'per_day' ? 'selected' : '' }}>Per Day</option>
                    <option value="per_week" {{ (old('price_type', $car->price_per_day > 0 ? 'per_day' : ( $car->price_per_week>0 ? 'per_week' : 'per_month'))) === 'per_week' ? 'selected' : '' }}>Per Week</option>
                    <option value="per_month" {{ (old('price_type', $car->price_per_day > 0 ? 'per_day' : ( $car->price_per_week>0 ? 'per_week' : 'per_month'))) === 'per_month' ? 'selected' : '' }}>Per Month</option>
                </select>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="text" name="price" id="price" value="{{ old('price', $car->price_per_day ?: ($car->price_per_week ?: $car->price_per_month)) }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="seats" class="block text-sm font-medium text-gray-700">Seats</label>
                <input type="number" name="seats" id="seats" value="{{ old('seats', $car->seats) }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description', $car->description) }}</textarea>
            </div>

            @if($car->image_path)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Current Image</label>
                    <img src="{{ Storage::url($car->image_path) }}" class="h-48 w-full object-cover rounded-md">
                </div>
            @endif

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Upload New Image (optional)</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full" accept="image/*">
            </div>

            <div class="flex items-center">
                <input id="is_rented" name="is_rented" type="checkbox" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" {{ old('is_rented', $car->is_rented) ? 'checked' : '' }}>
                <label for="is_rented" class="ml-2 block text-sm text-gray-700">Mark as Rented</label>
            </div>

            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('admin.cars.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save Changes</button>
            </div>
        </form>
    </div>
</x-app-layout>
