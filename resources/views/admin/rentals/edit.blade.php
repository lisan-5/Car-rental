<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Rental Request</h2>
            <a href="{{ route('admin.rentals.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Back</a>
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

        <form action="{{ route('admin.rentals.update', $rental) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                <input type="text" name="duration" id="duration" value="{{ old('duration', $rental->duration) }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="4" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('message', $rental->message) }}</textarea>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    <option value="pending" {{ old('status', $rental->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="accepted" {{ old('status', $rental->status) === 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="rejected" {{ old('status', $rental->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('admin.rentals.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save Changes</button>
            </div>
        </form>
    </div>
</x-app-layout>
