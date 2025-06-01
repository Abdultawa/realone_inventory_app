<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold fs-3 text-gray-800">Add New Store</h2>
    </x-slot>

    <div class="container-xxl mt-10">
        <form method="POST" action="{{ route('stores.store') }}">
            @csrf

            <x-form.input name="name" label="Store Name" required />
            <x-form.textarea name="description" label="Description" />

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Create Store</button>
                <a href="{{ route('stores.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
