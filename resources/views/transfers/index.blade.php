<x-app-layout>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <h2>Product Transfers</h2>
                        </div>
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <a href="{{ route('transfers.create') }}" class="btn btn-primary">
                                <i class="ki-duotone ki-swap fs-2"></i> New Transfer
                            </a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_transfers_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px">ID</th>
                                        <th class="min-w-150px">Product</th>
                                        <th class="min-w-150px">From Store</th>
                                        <th class="min-w-150px">To Store</th>
                                        <th class="min-w-100px">Qty</th>
                                        <th class="min-w-150px">Transferred By</th>
                                        <th class="min-w-150px">Date</th>
                                        <th class="min-w-100px text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach($transfers as $transfer)
                                    <tr>
                                        <td>{{ $transfer->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($transfer->product->image)
                                                <div class="symbol symbol-50px me-5">
                                                    <img src="{{ asset($transfer->product->image) }}" class="" alt="{{ $transfer->product->name }}"/>
                                                </div>
                                                @endif
                                                <div class="d-flex justify-content-start flex-column">
                                                    <span class="text-dark fw-bold">{{ $transfer->product->name }}</span>
                                                    <span class="text-muted">{{ $transfer->product->sku }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-primary">{{ $transfer->fromStore->name }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-success">{{ $transfer->toStore->name }}</span>
                                        </td>
                                        <td>{{ $transfer->quantity }}</td>
                                        <td>{{ $transfer->transferredBy->name }}</td>
                                        {{-- <td>{{ $transfer->transferred_at->now() }}</td> --}}
                                        <td class="text-end">
                                            <a href="{{ route('transfers.show', $transfer) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <i class="ki-duotone ki-eye fs-2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-5">
                            <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                {{ $transfers->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Initialize Metronic datatable if needed
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('kt_transfers_table');
            if (table) {
                // Datatable initialization code here
            }
        });
    </script>
    @endpush
</x-app-layout>
