<x-app-layout>
    <div class="container-xxl mt-10">
        <div class="card card-flush">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="card-title">
                    Invoice Details – <span class="text-primary">{{ $invoice->invoice_number }}</span>
                </h2>

                @if (session('success'))
                    <div class="alert alert-success mb-0">{{ session('success') }}</div>
                @endif
            </div>

            <div class="card-body py-5">
                <!-- Customer Info -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="fw-bold text-gray-800">Customer Info</h5>
                        <div><strong>Name:</strong> {{ $invoice->customer_name }}</div>
                        <div><strong>Address:</strong> {{ $invoice->customer_address }}</div>
                        <div><strong>Date:</strong> {{ $invoice->created_at->format('d M Y, h:i A') }}</div>
                    </div>

                    <div class="col-md-6 text-md-end mt-4 mt-md-0">
                        <h5 class="fw-bold text-gray-800">Invoice Summary</h5>
                        <div><strong>Status:</strong>
                            @if ($invoice->status == 'paid')
                                <span class="badge bg-success">Paid</span>
                            @else
                                <span class="badge bg-warning text-dark">Not Paid</span>
                            @endif
                        </div>
                        <div><strong>Total:</strong> ₦{{ number_format($invoice->total_amount, 2) }}</div>
                    </div>
                </div>

                <!-- Products Table -->
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="bg-light fw-bold text-gray-800">
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th class="text-end">Qty</th>
                                <th class="text-end">Unit Price</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->product->name ?? 'Product deleted' }}</td>
                                    <td class="text-end">{{ $item->quantity }}</td>
                                    <td class="text-end">₦{{ number_format($item->price, 2) }}</td>
                                    <td class="text-end">₦{{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="fw-bold">
                            <tr>
                                <td colspan="4" class="text-end">Grand Total</td>
                                <td class="text-end">₦{{ number_format($invoice->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Notes -->
                <div class="mt-4">
                    <h6 class="fw-bold">Notes</h6>
                    <p>{{ $invoice->notes }}</p>
                </div>

                <!-- Update Status -->
                @if ($invoice->status === 'not-paid')
                    <form method="POST" action="{{ route('invoices.updateStatus', $invoice->id) }}" class="mt-4">
                        @csrf
                        @method('PUT')
                        <button type="submit" name="status" value="paid" class="btn btn-success">
                            Mark as Paid
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
