@extends('admin.layout.adminmaster')

@section('admincontent')
<main class="h-full pb-16 overflow-y-auto">
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Registered Users
        </h2>
        <!-- CTA -->
        {{-- <a
            class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
            href="{{ route('users.create') }}"
        >
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd"
                        fill-rule="evenodd"
                    ></path>
                </svg>
                <span>Add New User</span>
            </div>
            <span>Create &RightArrow;</span>
        </a> --}}

        <!-- User Table with Actions -->
        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            User Management
        </h4>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                        >
                            <th class="px-4 py-3">First Name</th>
                            <th class="px-4 py-3">Last Name</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3">Province</th>
                            <th class="px-4 py-3">City</th>
                            <th class="px-4 py-3">Postal Code</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
    @if (isset($users) && $users->count())
        @foreach ($users as $user)
            <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3 text-sm">{{ $user->first_name }}</td>
                <td class="px-4 py-3 text-sm">{{ $user->last_name }}</td>
                <td class="px-4 py-3 text-sm">{{ $user->email }}</td>
                <td class="px-4 py-3 text-sm">{{ $user->phone }}</td>
                <td class="px-4 py-3 text-sm">{{ $user->province }}</td>
                <td class="px-4 py-3 text-sm">{{ $user->city }}</td>
                <td class="px-4 py-3 text-sm">{{ $user->postal_code }}</td>
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-4 text-sm">
                        {{-- <a href="{{ route('users.edit', $user->id) }}" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                        </a> --}}
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete" type="submit">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8" class="px-4 py-3 text-sm text-center">No users found.</td>
        </tr>
    @endif
</tbody>                </table>
            </div>
            {{-- <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
            >
                <span class="flex items-center col-span-3">
                    Showing {{ $users->firstItem() }}-{{ $users->lastItem() }} of {{ $users->total() }}
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    {{ $users->links('pagination::tailwind') }}
                </span> --}}
            </div>
        </div>
    </div>
</main>
@endsection