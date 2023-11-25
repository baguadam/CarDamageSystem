<x-guest-layout>
    <x-slot name="title">History</x-slot>
    <h1 class="text-4xl mb-4 font-extrabold mr-5">Search histories</h1>
    <h2 class="mb-6 font-normal">You can see your search histories below. Only searches with valid license plate format
        are listed here. In case of license plates that don't exist in the database, a default pictore is displayed. By clicking on a history,
        you can perform the search again.
    </h2>
    <div class="flex flex-wrap justify-center border rounded-md shadow-lg bg-stone-50 mt-4">
    @foreach ($histories as $history)
        <a href=" {{ route('damages.search', ['license_plate' => $history->license]) }} " class="max-w-sm bg-white border border-gray-200 rounded-lg shadow m-4">
            <div class="flex justify-center">
                <img class="max-w-20 max-h-20" src="{{ asset('storage/images/' . $history->image_hash_name) }}" alt="Picture of the related car" />
            </div>

            <dl class="max-w-md text-gray-900 divide-y divide-gray-200 p-3">
                <div class="flex flex-col pb-2">
                    <dt class="mb-1 text-gray-500 md:text-lg">License plate</dt>
                    <dd class="text-md font-semibold">{{ $history->license }}</dd>
                </div>

                <div class="flex flex-col pb-2">
                    <dt class="mb-1 text-gray-500 md:text-lg">Search date</dt>
                    <dd class="text-md font-semibold">{{ $history->search_time }}</dd>
                </div>
            </dl>
        </a>
    @endforeach
    </div>
    <div class="mx-auto p-5 w-4/5">
        {{ $histories->links() }}
    </div>
</x-guest-layout>
