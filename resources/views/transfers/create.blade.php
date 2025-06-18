<x-app-layout>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush">
                    <div class="card-header">
                        <h3 class="card-title">Transfer Product Between Stores</h3>
                    </div>
                    <div class="card-body pt-0">
                        <form id="kt_transfer_form" action="{{ route('transfers.store') }}" method="POST">
                            @csrf

                            <div class="row mb-6">
                                <div class="col-lg-6">
                                    <label class="col-form-label required fw-bold fs-6">Product</label>
                                    <select name="product_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Product" required>
                                        <option value=""></option>
                                        @foreach($products as $product)
                                        <option
                                            value="{{ $product->id }}"
                                            data-quantity="{{ $product->quantity }}"
                                        >
                                            {{ $product->name }} ({{ $product->product_code }}) - {{ $product->store->name }} (Qty: {{ $product->quantity }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label class="col-form-label required fw-bold fs-6">Quantity</label>
                                    <input type="number" name="quantity" class="form-control form-control-solid" placeholder="Enter quantity" min="1" required/>
                                    <small class="text-muted">Available: <span id="available_quantity">0</span></small>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <div class="col-lg-6">
                                    <label class="col-form-label fw-bold fs-6">Current Store</label>
                                     <select name="from_store_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Current Store" required>
                                        <option value=""></option>
                                        @foreach($stores as $store)
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label class="col-form-label required fw-bold fs-6">Destination Store</label>
                                    <select name="to_store_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Destination Store" required>
                                        <option value=""></option>
                                        @foreach($stores as $store)
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <div class="col-lg-12">
                                    <label class="col-form-label fw-bold fs-6">Reason (Optional)</label>
                                    <textarea name="reason" class="form-control form-control-solid" rows="3" placeholder="Enter transfer reason"></textarea>
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                                <button type="submit" class="btn btn-primary" id="kt_transfer_submit">
                                    <span class="indicator-label">Transfer Product</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize select2
            $('[data-control="select2"]').select2({
                dropdownParent: $('#kt_transfer_form')
            });

            // Simple form submission handler
            const form = document.getElementById('kt_transfer_form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const submitButton = document.getElementById('kt_transfer_submit');
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
