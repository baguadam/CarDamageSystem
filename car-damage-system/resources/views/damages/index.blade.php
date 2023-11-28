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
        <h1 class="text-4xl mb-4 font-extrabold mr-5 ml-2">Car Damage System</h1>
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

    @error('license_plate')
        <div class="mt-4 bg-red-600 text-white uppercase p-3">Bad license plate format!</div>
    @enderror

    @if ($displayMessage)
        <div class="mt-4 text-white uppercase p-3 {{ $isSuccess ? 'bg-green-600' : 'bg-red-600' }}">{{ $displayMessage }}</div>
    @endif

    @if (!$errors->has('license_plate'))
        @if ($vehicle ?? null)
            <div id="search-result-container" class="flex border rounded-md shadow-lg bg-stone-50 justify-center items-center">
                <img class="max-w-sm max-h-sm p-7" src="{{ asset('storage/images/' . $img_name) }}" alt="Image of the vehicle">
                <div class="h-60 max-w-md bg-white border border-gray-200 rounded-lg shadow m-7">
                    <dl class="max-w-md text-gray-900 divide-y divide-gray-200 p-3">
                        <div class="flex flex-col pb-2">
                            <dt class="mb-1 text-gray-500 md:text-lg">License plate</dt>
                            <dd class="text-md font-semibold">{{ $vehicle->license }}</dd>
                        </div>

                        <div class="flex flex-col pb-2">
                            <dt class="mb-1 text-gray-500 md:text-lg">Model/Type</dt>
                            <dd class="text-md font-semibold">{{ $vehicle->model }} - {{ $vehicle->type }}</dd>
                        </div>

                        <div class="flex flex-col pb-2">
                            <dt class="mb-1 text-gray-500 md:text-lg">Year</dt>
                            <dd class="text-md font-semibold">{{ $vehicle->year }}</dd>
                        </div>
                    </dl>
                </div>
                <div class="flex flex-col items-center justify-center m-7">
                    <a href="{{ route('vehicles.edit', $vehicle) }}"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit vehicle
                    </a>
                </div>
            </div>

            @if (!$vehicle->damages->isEmpty())
                <div class="border rounded-md shadow-lg mt-4 flex justify-center">
                    <table class="table-auto mt-1">
                        <thead class="uppercase text-left bg-stone-50 text-white">
                        <tr>
                            <th class="px-6 py-3 text-gray-900">ID</th>
                            <th class="px-6 py-3 text-gray-900">Place</th>
                            <th class="px-6 py-3 text-gray-900">Date</th>
                            <th class="px-6 py-3 text-gray-900">Description</th>
                            <th class="px-6 py-3 text-gray-900">More</th>
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
                </div>
            @endif
        @endif
    @endif
</x-guest-layout>
