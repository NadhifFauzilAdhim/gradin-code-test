<x-layouts.app heading="Add Courier" title="Add Courier">
    <section class="rounded-md border border-zinc-200 bg-white p-6">
        <form method="POST" action="{{ route('couriers.store') }}">
            @include('couriers._form')
        </form>
    </section>
</x-layouts.app>
