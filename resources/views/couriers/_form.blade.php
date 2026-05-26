@csrf

@if ($method ?? false)
    @method($method)
@endif

<div class="grid gap-5 sm:grid-cols-2">
    <label class="block">
        <span class="text-sm font-medium text-zinc-700">Name</span>
        <input name="name" value="{{ old('name', $courier->name) }}" class="mt-1 w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm focus:border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-100" required>
        @error('name') <span class="mt-1 block text-sm text-red-700">{{ $message }}</span> @enderror
    </label>

    <label class="block">
        <span class="text-sm font-medium text-zinc-700">Code</span>
        <input name="code" value="{{ old('code', $courier->code) }}" class="mt-1 w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm focus:border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-100" required>
        @error('code') <span class="mt-1 block text-sm text-red-700">{{ $message }}</span> @enderror
    </label>

    <label class="block">
        <span class="text-sm font-medium text-zinc-700">Email</span>
        <input type="email" name="email" value="{{ old('email', $courier->email) }}" class="mt-1 w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm focus:border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-100">
        @error('email') <span class="mt-1 block text-sm text-red-700">{{ $message }}</span> @enderror
    </label>

    <label class="block">
        <span class="text-sm font-medium text-zinc-700">Phone</span>
        <input name="phone" value="{{ old('phone', $courier->phone) }}" class="mt-1 w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm focus:border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-100">
        @error('phone') <span class="mt-1 block text-sm text-red-700">{{ $message }}</span> @enderror
    </label>

    <label class="block">
        <span class="text-sm font-medium text-zinc-700">Service Area</span>
        <input name="service_area" value="{{ old('service_area', $courier->service_area) }}" class="mt-1 w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm focus:border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-100">
        @error('service_area') <span class="mt-1 block text-sm text-red-700">{{ $message }}</span> @enderror
    </label>

    <label class="block">
        <span class="text-sm font-medium text-zinc-700">Registered At</span>
        <input type="date" name="registered_at" value="{{ old('registered_at', optional($courier->registered_at)->format('Y-m-d')) }}" class="mt-1 w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm focus:border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-100">
        @error('registered_at') <span class="mt-1 block text-sm text-red-700">{{ $message }}</span> @enderror
    </label>

    <label class="block">
        <span class="text-sm font-medium text-zinc-700">Level</span>
        <select name="level" class="mt-1 w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm focus:border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-100" required>
            @for ($level = 1; $level <= 5; $level++)
                <option value="{{ $level }}" @selected((int) old('level', $courier->level) === $level)>Level {{ $level }}</option>
            @endfor
        </select>
        @error('level') <span class="mt-1 block text-sm text-red-700">{{ $message }}</span> @enderror
    </label>

    <label class="flex items-center gap-3 self-end rounded-md border border-zinc-300 bg-white px-3 py-2">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $courier->is_active ?? true)) class="rounded border-zinc-300 text-teal-700 focus:ring-teal-600">
        <span class="text-sm font-medium text-zinc-700">Active courier</span>
    </label>
</div>

<div class="mt-6 flex items-center justify-end gap-3 border-t border-zinc-200 pt-6">
    <a href="{{ route('couriers.index') }}" class="rounded-md border border-zinc-300 px-4 py-2 text-sm font-medium hover:bg-zinc-50">Cancel</a>
    <button class="rounded-md bg-teal-700 px-4 py-2 text-sm font-semibold text-white hover:bg-teal-800">Save</button>
</div>
