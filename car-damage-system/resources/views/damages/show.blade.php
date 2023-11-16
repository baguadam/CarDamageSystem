<x-guest-layout>
    <x-slot name="title">Details</x-slot>
    <h1 class="text-4xl mb-4 font-extrabold mr-5 text-center">Damage details</h1>

    <table class="table-auto mt-4">
        <thead class="uppercase text-left bg-gray-500 text-white">
            <tr>
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">Place</th>
                <th class="px-6 py-3">Date</th>
                <th class="px-6 py-3">Description</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b">
                <td class="px-6 py-4">{{ $damage->id }}</td>
                <td class="px-6 py-4">{{ $damage->place }}</td>
                <td class="px-6 py-4">{{ $damage->date }}</td>
                <td class="px-6 py-4">{{ $damage->desc }}</td>
            </tr>
        </tbody>
    </table>
    <div class="flex flex-wrap justify-center">
        @foreach ($damage->vehicles()->get() as $vehicle)
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow m-4">
                @php
                    $img_name = $vehicle->img_hash_name ?? 'default.png';
                @endphp
                <img src="{{ asset('storage/images/' . $img_name) }}" alt="Picture of the related car" />

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
        @endforeach
    </div>
</x-guest-layout>
