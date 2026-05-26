<x-layouts.app heading="Edit Courier" title="Edit Courier">
    <section class="rounded-md border border-zinc-200 bg-white p-6">
        <form method="POST" action="{{ route('couriers.update', $courier) }}">
            @include('couriers._form', ['method' => 'PUT'])
        </form>
    </section>
</x-layouts.app>
