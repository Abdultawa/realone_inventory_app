<x-app-layout>
    <div class="container-xxl mt-10">
        <div class="card-header d-flex justify-content-between align-items-center mb-5">
            <h2 class="card-title">Invoices</h2>
            <div class="card-toolbar">
                <a href="{{ route('invoices.create') }}" class="btn btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i> Create Invoice
                </a>
            </div>
        </div>
        <div class="card card-flush h-xl-100">
            <!-- Card Header -->
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Product Orders</span>
                    <span class="text-gray-500 mt-1 fw-semibold fs-6">Total {{ $invoices->total() }} Invoices</span>
                </h3>

                <div class="card-toolbar">
                    <!-- Filters -->
                    <form method="GET" class="d-flex flex-stack flex-wrap gap-4">
                        <div class="d-flex align-items-center fw-bold">
                            <div class="text-gray-500 fs-7 me-2">Status</div>
                            <select name="status" class="form-select form-select-sm w-150px">
                                <option value="">Show All</option>
                                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="not-paid" {{ request('status') == 'not-paid' ? 'selected' : '' }}>Not Paid</option>
                            </select>
                        </div>
                        @if(auth()->user()->isAdmin())
                            <div class="d-flex align-items-center fw-bold">
                                <div class="text-gray-500 fs-7 me-2">Store</div>
                                <select name="store_id" class="form-select form-select-sm w-150px">
                                    <option value="">All Stores</option>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->id }}" {{ request('store_id') == $store->id ? 'selected' : '' }}>
                                            {{ $store->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="position-relative my-1">
                            <i class="ki-outline ki-magnifier fs-2 position-absolute top-50 translate-middle-y ms-4"></i>
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control w-150px fs-7 ps-12" placeholder="Search customer" />
                        </div>

                        <div>
                            <button class="btn btn-sm btn-light" type="submit">Filter</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body pt-2">
                <table class="table align-middle table-row-dashed fs-6 gy-3">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-100px">Invoice ID</th>
                            <th class="text-end min-w-100px">Date</th>
                            <th class="text-end min-w-150px">Customer</th>
                            <th class="text-end min-w-150px">Store</th>
                            <th class="text-end min-w-100px">Total</th>
                            <th class="text-end min-w-100px">Status</th>
                            <th class="text-end min-w-50px">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">
                        @forelse($invoices as $invoice)
                            <tr>
                                <td>
                                    <a href="{{ route('invoices.show', $invoice->id) }}" class="text-gray-800 text-hover-primary">
                                        {{ $invoice->invoice_number ?? 'INV-'.$invoice->id }}
                                    </a>
                                </td>
                                <td class="text-end">{{ $invoice->created_at->format('d M Y') }}</td>
                                <td class="text-end">{{ $invoice->customer_name }}</td>
                                <td class="text-end">{{ $invoice->store->name ?? '-' }}</td>
                                <td class="text-end">₦{{ number_format($invoice->total_amount, 2) }}</td>
                                <td class="text-end">
                                    @if ($invoice->status == 'paid')
                                        <span class="badge py-2 px-3 badge-light-success">Paid</span>
                                    @else
                                        <span class="badge py-2 px-3 badge-light-warning">Not Paid</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-light">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No invoices found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-5 d-flex justify-content-center">
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
