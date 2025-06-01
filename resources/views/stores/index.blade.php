<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold fs-3 text-gray-800">My Stores</h2>
    </x-slot>

    <div class="container-xxl mt-10">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <a href="{{ route('stores.create') }}" class="btn btn-primary mb-4">+ Add Store</a>

        <div class="card p-5">
            <div class="card-body p-0">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stores as $store)
                            <tr>
                                <td>{{ $store->id }}</td>
                                <td>{{ $store->name }}</td>
                                <td>{{ $store->description ?? '—' }}</td>
                                <td>
                                    <a href="{{ route('stores.edit', $store) }}" class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('stores.destroy', $store) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No stores found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $stores->links() }}
        </div>
    </div>
</x-app-layout>
