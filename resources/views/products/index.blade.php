<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold fs-3 text-gray-800">Stock Report</h2>
    </x-slot>

    <div class="container-xxl mt-10">
        @if(auth()->user()->isAdmin())
        <div class="mb-4">
            <a href="{{route('products.create')}}" class="btn btn-primary">+ Add Product</a>
        </div>
        @endif
        <div class="card card-flush h-xl-100">
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-900">Stock Report</span>
                    <span class="text-gray-500 mt-1 fw-semibold fs-6">
                        Total {{ $products->count() }} Items in Stock
                    </span>
                </h3>
                <div class="card-toolbar">
                    <form method="GET" action="{{ route('products.index') }}" class="d-flex gap-4 flex-wrap">
                        @if(auth()->user()->isAdmin())
                        <div class="d-flex align-items-center fw-bold">
                            <div class="text-muted fs-7 me-2">Store</div>
                            <select name="store" class="form-select form-select-sm w-150px">
                                <option value="">All Stores</option>
                                @foreach($stores as $store)
                                    <option value="{{ $store->id }}" {{ request('store') == $store->id ? 'selected' : '' }}>
                                        {{ $store->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        {{-- Category --}}
                        <div class="d-flex align-items-center fw-bold">
                            <div class="text-muted fs-7 me-2">Category</div>
                            <select name="category" class="form-select form-select-sm w-150px" onchange="this.form.submit()">
                                <option value="">Show All</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex align-items-center fw-bold">
                            <div class="text-muted fs-7 me-2">Status</div>
                            <select name="status" class="form-select form-select-sm w-150px">
                                <option value="">Show All</option>
                                <option value="In Stock" {{ request('status') == 'In Stock' ? 'selected' : '' }}>In Stock</option>
                                <option value="Out of Stock" {{ request('status') == 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                                <option value="Low Stock" {{ request('status') == 'Low Stock' ? 'selected' : '' }}>Low Stock</option>
                            </select>
                        </div>

                        <div class="d-flex align-items-center">
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="form-control form-control-sm" placeholder="Search product...">
                        </div>

                        <div>
                            <button class="btn btn-sm btn-light" type="submit">Filter</button>
                        </div>
                        <div>
                            <a href="{{route('products.index')}}" class="btn btn-sm btn-light-primary" type="submit">clear</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <table class="table align-middle table-row-dashed fs-6 gy-3">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-150px">Item</th>
                            <th class="text-end pe-3 min-w-100px">Product Code</th>
                            <th class="text-end pe-3 min-w-100px">Store</th>
                            <th class="text-end pe-3 min-w-150px">Date Added</th>
                            <th class="text-end pe-3 min-w-100px">Price</th>
                            <th class="text-end pe-3 min-w-100px">Status</th>
                            <th class="text-end pe-0 min-w-75px">Qty</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="text-gray-900 text-hover-primary">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td class="text-end">#{{ $product->product_code ?? 'N/A' }}</td>
                                <td class="text-end">{{ $product->store->name ?? 'N/A' }}</td>
                                <td class="text-end">{{ $product->created_at->format('d M, Y') }}</td>
                                <td class="text-end">₦{{ number_format($product->price, 2) }}</td>
                                <td class="text-end">
                                    @php
                                        $status = $product->status;
                                        $statusClass = match($status) {
                                            'In Stock' => 'badge-light-primary',
                                            'Out of Stock' => 'badge-light-danger',
                                            'Low Stock' => 'badge-light-warning',
                                            default => 'badge-light-secondary',
                                        };
                                    @endphp
                                    <span class="badge py-3 px-4 fs-7 {{ $statusClass }}">{{ $product->status }}</span>
                                </td>
                                <td class="text-end">
                                    <span class="text-gray-900 fw-bold">{{ $product->quantity }} PCS</span>
                                </td>
                                @if(auth()->user()->isAdmin())
                                <td class="text-end">
                                <!--begin::Dropdown-->
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light btn-active-light-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <!-- Edit -->
                                        <li>
                                            <a class="dropdown-item" href="{{ route('products.edit', $product->id) }}">
                                                <i class="ki-outline ki-pencil fs-5 me-1"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <!-- Add Quantity -->
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#addQuantityModal-{{ $product->id }}">
                                            <i class="ki-outline ki-plus fs-5 me-1"></i>Add Quantity</a>
                                        </li>
                                        <!-- Delete -->
                                        <li>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="ki-outline ki-trash fs-5 me-1"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <!--end::Dropdown-->
                                </td>
                                @endif
                            </tr>
                            <div class="modal fade" id="addQuantityModal-{{ $product->id }}" tabindex="-1"
                                        aria-labelledby="addQuantityModalLabel-{{ $product->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="addQuantityModalLabel-{{ $product->id }}">Add Quantity to
                                                        {{ $product->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('products.store_quantity', $product) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p><strong>Current Quantity:</strong> {{ $product->quantity }}
                                                        </p>

                                                        <div class="form-group">
                                                            <label for="added_quantity_{{ $product->id }}">Quantity
                                                                to Add</label>
                                                            <input type="number" name="added_quantity"
                                                                id="added_quantity_{{ $product->id }}"
                                                                class="form-control" required min="1">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Add
                                                            Quantity</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
