<x-guest-layout>
    <x-slot name="title">Create damage</x-slot>
    <h1 class="text-4xl mb-4 font-extrabold mr-5">Create new damage</h1>
    <h2 class="mb-6 font-normal">This page can only be accessed by admin users. Here you can create new damages by filling out the form.
        For each damage more cars can be attached. It's important that one car can only be attached to the damage once.
    </h2>
    <form action="{{ route('damages.store') }}" method="POST" class="bg-white border p-5 shadow-lg rounded-lg">
        @csrf
        <div class="mb-6">
            <label for="place" class="block mb-2 text-md font-medium text-gray-900">Place</label>
            @error('place')
                <div class="mb-2 bg-red-600 text-white p-1 rounded-sm">{{ $message }}</div>
            @enderror
            <input value="{{ old('place', '') }}" type="text" id="place" name="place" placeholder="*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div class="grid grid-cols-2 grid-rows-1">
            <div class="date-description-container">
                <div class="mb-6">
                    <label for="date" class="block mb-2 text-md font-medium text-gray-900">Date</label>
                    @error('date')
                        <div class="mb-2 bg-red-600 text-white p-1 rounded-sm">{{ $message }}</div>
                    @enderror
                    <input type="date" id="date" name="date" value="{{ old('date', date("Y-m-d"))}}" min="1950-01-01" max="{{ date("Y-m-d") }}">
                </div>
                <div class="mb-6">
                    <label for="description" class="block mb-2 text-md font-medium text-gray-900">Desecription (optional)</label>
                    @error('description')
                        <div class="mb-2 bg-red-600 text-white p-1 rounded-sm">{{ $message }}</div>
                    @enderror
                    <textarea style="resize: none;" id="description" name="description" rows="4" cols="50">
                        {{ old('description', '') }}
                    </textarea>
                </div>
            </div>
            <div class="z-10 rounded-lg shadow-lg w-60 h-100 border bg-gray-100 justify-self-center">
                @error('licenses')
                    <div class="mb-2 bg-red-600 text-white p-1 rounded-sm">{{ $message }}</div>
                @enderror
                @error('licenses.*')
                    <div class="mb-2 bg-red-600 text-white p-1 rounded-sm">{{ $message }}</div>
                @enderror
                <div class="p-3">
                    <h3>Choose vehicles!</h3>
                </div>
                <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButton">
                  @foreach ($licenses as $license)
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-200 ">
                            <input id="{{ $license }}" type="checkbox" name="licenses[]" value="{{ $license }}" @checked(in_array($license, old('licenses') ?? [])) class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                            <label for="{{ $license }}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded">{{ $license }}</label>
                        </div>
                    </li>
                  @endforeach
                </ul>
            </div>
        </div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
            Create!
        </button>
    </form>
</x-guest-layout>
