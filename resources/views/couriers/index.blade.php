<x-layouts.app heading="Courier Directory" title="Couriers">
    <section class="mb-6 rounded-md border border-zinc-200 bg-white p-4">
        <form method="GET" action="{{ route('couriers.index') }}" class="grid gap-4 lg:grid-cols-[1fr_160px_180px_140px_auto] lg:items-end">
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Search</span>
                <input name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Budi Agung" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2 text-sm focus:border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-100">
            </label>

            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Level</span>
                <input name="level" value="{{ $filters['level'] ?? '' }}" placeholder="2,3" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2 text-sm focus:border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-100">
            </label>

            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Sort</span>
                <select name="sort" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2 text-sm focus:border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-100">
                    <option value="name" @selected(($filters['sort'] ?? 'name') === 'name')>Name</option>
                    <option value="registered_at" @selected(($filters['sort'] ?? '') === 'registered_at')>Registered At</option>
                </select>
            </label>

            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Direction</span>
                <select name="direction" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2 text-sm focus:border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-100">
                    <option value="asc" @selected(($filters['direction'] ?? 'asc') === 'asc')>Asc</option>
                    <option value="desc" @selected(($filters['direction'] ?? '') === 'desc')>Desc</option>
                </select>
            </label>

            <button class="rounded-md bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-700">Apply</button>
        </form>
    </section>

    <section class="overflow-hidden rounded-md border border-zinc-200 bg-white">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 text-sm">
                <thead class="bg-zinc-100 text-left text-xs font-semibold uppercase tracking-wide text-zinc-600">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Code</th>
                        <th class="px-4 py-3">Level</th>
                        <th class="px-4 py-3">Area</th>
                        <th class="px-4 py-3">Registered</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($couriers as $courier)
                        <tr class="hover:bg-zinc-50">
                            <td class="px-4 py-3 font-medium text-zinc-950">{{ $courier->name }}</td>
                            <td class="px-4 py-3 text-zinc-600">{{ $courier->code }}</td>
                            <td class="px-4 py-3">Level {{ $courier->level }}</td>
                            <td class="px-4 py-3 text-zinc-600">{{ $courier->service_area ?: '-' }}</td>
                            <td class="px-4 py-3 text-zinc-600">{{ $courier->registered_at?->format('d M Y') ?: '-' }}</td>
                            <td class="px-4 py-3">
                                <span class="rounded-full px-2 py-1 text-xs font-semibold {{ $courier->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-zinc-200 text-zinc-700' }}">
                                    {{ $courier->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('couriers.show', $courier) }}" class="rounded-md border border-zinc-300 px-3 py-1.5 font-medium hover:bg-white">View</a>
                                    <a href="{{ route('couriers.edit', $courier) }}" class="rounded-md border border-zinc-300 px-3 py-1.5 font-medium hover:bg-white">Edit</a>
                                    <form method="POST" action="{{ route('couriers.destroy', $courier) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-md border border-red-300 px-3 py-1.5 font-medium text-red-700 hover:bg-red-50">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-10 text-center text-zinc-500">No couriers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <div class="mt-5">
        {{ $couriers->links() }}
    </div>
</x-layouts.app>
