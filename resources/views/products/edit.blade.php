<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold fs-3 text-gray-800">Edit Product</h2>
    </x-slot>

    <div class="container-xxl mt-10">
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <x-form.input name="name" label="Product Name" :value="$product->name" required />
            <x-form.input name="product_code" label="Product Code" :value="$product->product_code" required />
            <x-form.input name="price" label="Price" type="number" step="0.01" :value="$product->price" required />
            <x-form.input name="quantity" label="Quantity" type="number" :value="$product->quantity" required />
            <x-form.select name="store_id" label="Store" :options="$stores->pluck('name', 'id')" :selected="$product->store_id" required />
            <x-form.select name="category_id" label="Category" :options="$categorys->pluck('name', 'id')" :selected="$product->category_id" required />
            <x-form.textarea name="description" label="Description" :value="$product->description" />

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
