<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold fs-3 text-gray-800">Edit Store</h2>
    </x-slot>

    <div class="container-xxl mt-10">
        <form method="POST" action="{{ route('stores.update', $store) }}">
            @csrf
            @method('PUT')

            <x-form.input name="name" label="Store Name" :value="$store->name" required />
            <x-form.textarea name="description" label="Description" :value="$store->description" />

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('stores.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
