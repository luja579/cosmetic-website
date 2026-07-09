@extends('admin.layout.adminmaster')

@section('admincontent')
<main class="h-full pb-16 overflow-y-auto">
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Orders Management
        </h2>
        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Manage Orders
        </h4>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                        >
                            {{-- <th class="px-4 py-3">#</th> --}}
                            <th class="px-4 py-3">User Name</th>
                            <th class="px-4 py-3">Product Name</th>
                            <th class="px-4 py-3">Amount</th>
                            {{-- <th class="px-4 py-3">Transaction ID</th> --}}
                            <th class="px-4 py-3">eSewa Status</th>
                            <th class="px-4 py-3">Order Date</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse ($orders as $order)
                            <tr class="text-gray-700 dark:text-gray-400">
                                {{-- <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td> --}}
                                <td class="px-4 py-3 text-sm">{{ $order->user->first_name . ' ' . $order->user->last_name ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-sm">{{ $order->product->name ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-sm">Rs. {{ number_format($order->amount, 2) }}</td>
                                {{-- <td class="px-4 py-3 text-sm">{{ $order->txn_id ?? 'N/A' }}</td> --}}
                                <td class="px-4 py-3 text-sm">
                                    <span class="badge 
                                        {{ $order->esewa_status === 'completed' ? 'bg-success' : 
                                           ($order->esewa_status === 'failed' ? 'bg-danger' : 'bg-warning') }}">
                                        {{ ucfirst($order->esewa_status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex items-center space-x-4">
                                        {{-- <a href="{{ route('admin.orders.edit', $order->id) }}"
                                           class="text-blue-600 hover:text-blue-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                        </a> --}}
                                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this order?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-3 text-sm text-center text-gray-700 dark:text-gray-400">
                                    No orders found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection