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
                @if (session('error'))
                    <div class="alert alert-danger mb-0">{{ session('error') }}</div>
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
                            @if($invoice->status === 'not-paid')
                            <th class="text-end">Actions</th>
                            @endif
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
                                @if($invoice->status === 'not-paid')
                                <td class="text-end">
                                    <form method="POST" action="{{ route('invoices.returnItem') }}" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                        <input type="hidden" name="quantity" value="{{ $item->quantity }}">
                                        <input type="hidden" name="reason" value="returned">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to return this item?')">
                                            <i class="fas fa-undo"></i> Return
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                        <tfoot class="fw-bold">
                            <tr>
                                <td colspan="{{ $invoice->status === 'not-paid' ? 4 : 5 }}" class="text-end">Grand Total</td>
                                <td class="text-end">₦{{ number_format($invoice->total_amount, 2) }}</td>
                                @if($invoice->status === 'not-paid')
                                <td></td>
                                @endif
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Notes -->
                <div class="mt-4">
                    <h6 class="fw-bold">Notes</h6>
                    <p>{{ $invoice->notes }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 d-flex justify-content-between">
                    @if ($invoice->status === 'not-paid')
                        <form method="POST" action="{{ route('invoices.updateStatus', $invoice->id) }}" class="me-2">
                            @csrf
                            @method('PUT')
                            <button type="submit" name="status" value="paid" class="btn btn-success">
                                <i class="fas fa-check-circle"></i> Mark as Paid
                            </button>
                        </form>
                    @endif

                    <div>
                        <a href="{{ route('invoices.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-arrow-left"></i> Back to Invoices
                        </a>
                        <a href="{{ route('invoices.print', $invoice->id) }}" class="btn btn-primary" target="_blank">
                            <i class="fas fa-print"></i> Print Invoice
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

       @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simple confirmation before submitting return
            document.querySelectorAll('.return-item-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Are you sure you want to return this item?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
    @endpush

</x-app-layout>
