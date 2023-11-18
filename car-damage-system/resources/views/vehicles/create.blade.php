<x-guest-layout>
    <x-slot name="title">New vehicle</x-slot>
    <h1 class="text-4xl mb-4 font-extrabold mr-5">Create new vehicle</h1>
    <h2 class="mb-6 font-normal">This page can only be accessed by admin users. Here you can create a new vehicle by filling out the form and
        clicking on the button below. You can also upload a picture of the car. Please note that without an uploaded image, our default car photo will be related to
        the newly created vehicle.
    </h2>
    <form action="{{ route('vehicles.store') }}" method="POST" class="bg-white border p-5 shadow-lg rounded-lg" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <label for="license" class="block mb-2 text-md font-medium text-gray-900">License</label>
            @error('license')
                <div class="mb-2 bg-red-600 text-white p-1 rounded-sm">{{ $message }}</div>
            @enderror
            <input value="{{ old('license', '') }}" type="text" id="license" name="license" placeholder="*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div class="mb-6">
            <label for="model" class="block mb-2 text-md font-medium text-gray-900">Model</label>
            @error('model')
                <div class="mb-2 bg-red-600 text-white p-1 rounded-sm">{{ $message }}</div>
            @enderror
            <input value="{{ old('model', '') }}" type="text" id="model" name="model" placeholder="*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div class="mb-6">
            <label for="type" class="block mb-2 text-md font-medium text-gray-900">Type</label>
            @error('type')
                <div class="mb-2 bg-red-600 text-white p-1 rounded-sm">{{ $message }}</div>
            @enderror
            <input value="{{ old('type', '') }}" type="text" id="type" name="type" placeholder="*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div class="mb-6">
            <label for="year" class="block mb-2 text-md font-medium text-gray-900 ">Year</label>
            @error('year')
                <div class="mb-2 bg-red-600 text-white p-1 rounded-sm">{{ $message }}</div>
            @enderror
            <select id="year" value="{{ old('year', '') }}" name="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected>Choose a Year</option>
                @for ($i = 1950; $i <= 2023; $i++)
                <option value={{ $i }} {{ (old('year') == $i ? 'selected' : '') }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="mb-6">
            <label for="attach_image" class="block mb-2 text-md font-medium text-gray-900 ">Image of the car</label>
            @error('attach_image')
                <div class="mb-2 bg-red-600 text-white p-1 rounded-sm">{{ $message }}</div>
            @enderror
            <input type="file" name="attach_image" id="attach_image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
            Create!
        </button>
    </form>
</x-guest-layout>
