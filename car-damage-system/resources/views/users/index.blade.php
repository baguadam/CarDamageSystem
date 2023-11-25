<x-guest-layout>
    <x-slot name="title">Users</x-slot>
    <h1 class="text-4xl mb-4 font-extrabold mr-5">Members of the page</h1>
    <h2 class="mb-6 font-normal">This page can be only accessed by admin users. Here you can see everyone who is registered on the page.
        You can modify their rank by clicking on the related button at the bottom of each card.
    </h2>
    <div class="flex flex-wrap justify-center border rounded-md shadow-lg bg-stone-50 mt-4">
        @foreach ($users as $user)
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow m-4">
                <dl class="max-w-md text-gray-900 divide-y divide-gray-200 p-3">
                    <div class="flex flex-col pb-2">
                        <dt class="mb-1 text-gray-500 md:text-lg">Name</dt>
                        <dd class="text-md font-semibold">{{ $user->name }}</dd>
                    </div>
                    <div class="flex flex-col pb-2">
                        <dt class="mb-1 text-gray-500 md:text-lg">Email</dt>
                        <dd class="text-md font-semibold">{{ $user->email }}</dd>
                    </div>
                    <div class="flex flex-col pb-3">
                        <dt class="mb-1 text-gray-500 md:text-lg">Admin</dt>
                        <dd class="text-md font-semibold">{{ $user->isAdmin ? 'Yes' : 'No' }}</dd>
                    </div>
                </dl>
                <form action="{{ route('users.update', $user->id) }}" method="POST" class="flex justify-center">
                    @csrf
                    @method('PUT')
                    <button class="text-white font-bold py-2 px-4 rounded-md mb-2 {{ $user->isPremium ? 'bg-red-400' : 'bg-green-400'}} {{ $user->isPremium ? 'hover:bg-red-600' : 'hover:bg-green-600'}}">
                        {{ $user->isPremium ? 'Remove PREMIUM' : 'Add PREMIUM' }}
                    </button>
                </form>
            </div>
        @endforeach
        </div>
    <div class="mx-auto p-5 w-4/5">
        {{ $users->links() }}
    </div>
</x-guest-layout>
