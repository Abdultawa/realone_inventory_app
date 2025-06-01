<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold fs-3 text-gray-800">Create Product</h2>
    </x-slot>

    <div class="container-xxl mt-10">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <x-form.input name="name" label="Product Name" required />
            <x-form.input name="product_code" label="Product Code" required />
            <x-form.input name="price" label="Price" type="number" step="0.01" required />
            <x-form.input name="quantity" label="Quantity" type="number" required />
            <x-form.select name="store_id" label="Store" :options="$stores->pluck('name', 'id')" required />
            <x-form.select name="category_id" label="Category" :options="$categorys->pluck('name', 'id')" required />
            <x-form.textarea name="description" label="Description" />

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
