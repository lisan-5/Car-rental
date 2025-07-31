<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Car</h2>
            <a href="{{ route('cars.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded">Back</a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto py-6 px-4">
        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <!-- Make -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Make</label>
                <input type="text" name="make" value="{{ old('make') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <!-- Model -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Model</label>
                <input type="text" name="model" value="{{ old('model') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <!-- Year -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Year</label>
                <input type="number" name="year" value="{{ old('year') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <!-- Rate Option -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Rate Option</label>
                <select name="price_type" id="price_type" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    <option value="per_day" {{ old('price_type')=='per_day'?'selected':'' }}>Per Day</option>
                    <option value="per_week" {{ old('price_type')=='per_week'?'selected':'' }}>Per Week</option>
                    <option value="per_month" {{ old('price_type')=='per_month'?'selected':'' }}>Per Month</option>
                </select>
            </div>
            <!-- Price -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Price</label>
                <input type="text" name="price" value="{{ old('price') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <!-- Seats -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Seats</label>
                <input type="number" name="seats" value="{{ old('seats') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Description (optional)</label>
                <textarea name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description') }}</textarea>
            </div>
            <!-- Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="image" class="mt-1 block w-full" accept="image/*">
            </div>
            <!-- Submit -->
            <div>
                <button type="submit" class="px-4 py-2 text-white  bg-blue-800 rounded-md">Save Car</button>
            </div>
        </form>
    </div>
</x-app-layout>
