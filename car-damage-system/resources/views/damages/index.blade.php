@php
   use Illuminate\Support\Facades\Session;

   $displayMessage = $message ?? session('message'); // megfelelő error message
   $isSuccess = session('success') ?? false;

   $sortedDamages = null;
    if ($vehicle ?? null && !$vehicle->damages->isEmpty()) {
        $sortedDamages = $vehicle->damages->sortByDesc('date');
    }
@endphp
<x-guest-layout>
    <x-slot name="title">Landing page</x-slot>
    <div class="inline-flex justify-center items-center">
        <h1 class="text-4xl mb-4 font-extrabold mr-5">Car Damage System</h1>
        <h2 class="mb-6 font-normal">Welcome to Car Damage System. Are you looking for damages related to a car? Are you here to report a new accident?
            You are at the right place!</h2>
    </div>

    <form method="GET" action="{{ route('damages.search') }}" class="mb-4">
        @csrf
        <label for="license-plate" class="mb-2 text-sm font-medium text-white">Search for license plate:</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input value="{{ old('license_plage', '') }}" type="search" id="license-plate" name="license_plate" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for license plate..." required>
            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
        </div>
    </form>
    @auth
        <a href="{{ route('histories.index') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            Search history
        </a>
        <a href="{{ route('vehicles.create') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full ml-4">
            Create new vehicle
        </a>
        <a href="{{ route('damages.create') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full ml-4">
            Create new damage
        </a>
    @endauth
    @error('license_plate')
        <div class="mt-4 bg-red-600 text-white uppercase p-3">Bad license plate format!</div>
    @enderror

    @if ($displayMessage)
        <div class="mt-4 text-white uppercase p-3 {{ $isSuccess ? 'bg-green-600' : 'bg-red-600' }}">{{ $displayMessage }}</div>
    @endif

    @if (!$errors->has('license_plate'))
        @if ($vehicle ?? null)
            <h2 class="text-xl mt-4 font-extrabold mr-5">Search result: </h2>

            <div class="mb-4">
                <h3>{{ $vehicle->license }}, {{ $vehicle->model }} {{ $vehicle->type }} ({{ $vehicle->year }})</h3>
                <img class="max-w-md max-h-md" src="{{ asset('storage/images/' . $img_name) }}" alt="Image of the vehicle">
            </div>

            <a href="{{ route('vehicles.edit', $vehicle) }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                Edit vehicle
            </a>

            @if (!$vehicle->damages->isEmpty())
                <table class="table-auto mt-4">
                    <thead class="uppercase text-left bg-gray-500 text-white">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Place</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Description</th>
                        <th class="px-6 py-3">More</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($sortedDamages as $damage)
                            <tr class="border-b">
                                <td class="px-6 py-4">{{ $damage->id }}</td>
                                <td class="px-6 py-4">{{ $damage->place }}</td>
                                <td class="px-6 py-4">{{ $damage->date }}</td>
                                <td class="px-6 py-4">{{ $damage->desc }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('damages.show', $damage) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                        +
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endif
    @endif
</x-guest-layout>
