<x-layouts.app heading="Courier Detail" title="{{ $courier->name }}">
    <section class="rounded-md border border-zinc-200 bg-white p-6">
        <div class="flex flex-col gap-4 border-b border-zinc-200 pb-6 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold">{{ $courier->name }}</h2>
                <p class="mt-1 text-sm text-zinc-600">{{ $courier->code }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('couriers.edit', $courier) }}" class="rounded-md border border-zinc-300 px-4 py-2 text-sm font-medium hover:bg-zinc-50">Edit</a>
                <form method="POST" action="{{ route('couriers.destroy', $courier) }}">
                    @csrf
                    @method('DELETE')
                    <button class="rounded-md bg-red-700 px-4 py-2 text-sm font-semibold text-white hover:bg-red-800">Delete</button>
                </form>
            </div>
        </div>

        <dl class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div>
                <dt class="text-sm font-medium text-zinc-500">Email</dt>
                <dd class="mt-1 text-sm font-semibold">{{ $courier->email ?: '-' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Phone</dt>
                <dd class="mt-1 text-sm font-semibold">{{ $courier->phone ?: '-' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Service Area</dt>
                <dd class="mt-1 text-sm font-semibold">{{ $courier->service_area ?: '-' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Level</dt>
                <dd class="mt-1 text-sm font-semibold">Level {{ $courier->level }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Status</dt>
                <dd class="mt-1 text-sm font-semibold">{{ $courier->is_active ? 'Active' : 'Inactive' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Registered At</dt>
                <dd class="mt-1 text-sm font-semibold">{{ $courier->registered_at?->format('d M Y') ?: '-' }}</dd>
            </div>
        </dl>
    </section>
</x-layouts.app>
