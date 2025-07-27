<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Rent {{ $car->make }} {{ $car->model }}</h2>
            <a href="{{ route('cars.show', $car) }}" class="px-4 py-2 bg-gray-600 text-white rounded">Back</a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6 px-4">
        <div class="bg-white rounded-lg shadow p-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('cars.rent', $car) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name"
                           value="{{ old('name', auth()->user()->name) }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email"
                           value="{{ old('email', auth()->user()->email) }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>
                <div class="mb-4">
                    <label for="duration" class="block text-sm font-medium text-gray-700">Duration of Rent</label>
                    <input type="text" name="duration" id="duration"
                           value="{{ old('duration') }}"
                           placeholder="e.g., 3 days, 1 week"
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium text-gray-700">Your Message (optional)</label>
                    <textarea name="message" id="message" rows="3"
                              class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                              placeholder="Any special requests or notes">{{ old('message') }}</textarea>
                </div>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 rounded text-white hover:bg-blue-700">
                    Submit Request
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
