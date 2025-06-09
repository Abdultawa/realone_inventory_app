<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold fs-3 text-gray-800">Edit Category</h2>
    </x-slot>

    <div class="container-xxl mt-10">
        <form method="POST" action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PUT')

            <x-form.input name="name" label="Category Name" :value="$category->name" required />

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
