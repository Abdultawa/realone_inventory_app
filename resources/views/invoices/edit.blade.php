<x-app-layout>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush py-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2>Edit Invoice #{{ $invoice->id }}</h2>
                    </div>
                    <div class="card-body pt-0">
                        <!-- Flash Messages -->
                        @if(session('success'))
                        <div id="flash-message-success" class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if(session('error'))
                        <div id="flash-message-error" class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif

                        <form id="invoiceForm" action="{{ route('invoices.update', $invoice->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Customer Details -->
                            <div class="row mb-5">
                                <div class="col-lg-6">
                                    <label class="form-label fs-6 fw-bold">Customer Name</label>
                                    <input type="text" class="form-control" name="customer_name" value="{{ $invoice->customer_name }}" required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label fs-6 fw-bold">Customer Address</label>
                                    <textarea name="customer_address" class="form-control" rows="3" required>{{ $invoice->customer_address }}</textarea>
                                </div>
                            </div>

                            <!-- Items Table -->
                            <div class="table-responsive mb-10">
                                <table class="table g-5 gs-0 mb-0 fw-bold text-gray-700" data-kt-element="items">
                                    <thead>
                                        <tr class="border-bottom fs-7 fw-bold text-gray-700 text-uppercase">
                                            <th class="min-w-300px">Product</th>
                                            <th class="min-w-100px">QTY</th>
                                            <th class="min-w-150px">Price</th>
                                            <th class="min-w-200px">Description</th>
                                            <th class="min-w-150px text-end">Total</th>
                                            <th class="min-w-75px text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($invoice->items as $item)
                                            <tr class="border-bottom border-bottom-dashed" data-kt-element="item">
                                                <td>
                                                    <select name="product_id[]" class="form-select form-select-solid product-select" required>
                                                        <option value="" disabled>Select a product</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}"
                                                                data-price="{{ $product->price }}"
                                                                data-description="{{ $product->description }}"
                                                                {{ $product->id == $item->product_id ? 'selected' : '' }}>
                                                                {{ $product->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-solid quantity-input" type="number" min="1" name="quantity[]" value="{{ $item->quantity }}" required>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-solid text-end price-input" type="number" min="0" step="0.01" name="price[]" value="{{ $item->price }}" required>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-solid description-input" type="text" name="description[]" value="{{ $item->description }}" placeholder="Item description" required>
                                                </td>
                                                <td class="text-end">
                                                    ₦<span class="item-total">{{ number_format($item->quantity * $item->price, 2) }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-kt-element="remove-item">
                                                        <i class="fas fa-trash fs-3"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-end">Total</th>
                                            <th class="text-end">₦<span id="grand-total">0.00</span></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <button type="button" class="btn btn-light-primary" data-kt-element="add-item">Add Item</button>
                            </div>

                            <!-- Discount Dropdown -->
                            <div class="row mb-5">
                                <div class="col-lg-6">
                                    <label class="form-label fs-6 fw-bold">Apply Discount</label>
                                    <select name="discount" id="discount-select" class="form-select form-select-solid">
                                        <option value="0" {{ $invoice->discount == 0 ? 'selected' : '' }}>No Discount</option>
                                        <option value="2" {{ $invoice->discount == 2 ? 'selected' : '' }}>2% Discount</option>
                                        <option value="4" {{ $invoice->discount == 4 ? 'selected' : '' }}>4% Discount</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label fs-6 fw-bold">Status</label>
                                    <select name="status" class="form-select form-select-solid">
                                        <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="not-paid" {{ $invoice->status == 'not-paid' ? 'selected' : '' }}>Not Paid</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div>
                                <label class="form-label fs-6 fw-bold">Notes</label>
                                <textarea name="notes" class="form-control" rows="3" required>{{ $invoice->notes }}</textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-end mt-5">
                                <button type="submit" id="createInvoiceBtn" class="btn btn-primary">
                                    <span class="indicator-label">Update Invoice</span>
                                    <span class="indicator-progress" style="display: none;">
                                        Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Same JS Logic as Create Page -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const itemsTable = document.querySelector("[data-kt-element='items']");
            const addItemButton = document.querySelector("[data-kt-element='add-item']");
            const grandTotalElement = document.getElementById("grand-total");
            const discountSelect = document.getElementById("discount-select");

            const updateTotals = () => {
                let grandTotal = 0;
                const discount = parseFloat(discountSelect.value) || 0;

                itemsTable.querySelectorAll("[data-kt-element='item']").forEach(row => {
                    const quantity = parseFloat(row.querySelector(".quantity-input").value) || 0;
                    const price = parseFloat(row.querySelector(".price-input").value) || 0;
                    const total = quantity * price;
                    row.querySelector(".item-total").textContent = total.toFixed(2);
                    grandTotal += total;
                });

                const discountedTotal = grandTotal - (grandTotal * (discount / 100));
                grandTotalElement.textContent = discountedTotal.toFixed(2);
            };

            $(document).ready(function () {
                function initSelect2() {
                    $('.product-select').select2({
                        placeholder: "Select a product",
                        allowClear: true,
                        width: '100%'
                    });
                }

                $(document).on('change', '.product-select', function () {
                    const row = $(this).closest('tr');
                    const selectedOption = $(this).find(':selected');
                    const price = selectedOption.data('price');
                    const description = selectedOption.data('description');
                    row.find('.price-input').val(parseFloat(price).toFixed(2));
                    row.find('.description-input').val(description);
                    updateTotals();
                });

                $(document).on('input', '.quantity-input, .price-input', updateTotals);

                $(document).on('click', '[data-kt-element="remove-item"]', function () {
                    $(this).closest('tr').remove();
                    updateTotals();
                });

                addItemButton.addEventListener("click", (e) => {
                    e.preventDefault();
                    const firstRow = $("[data-kt-element='items'] tbody tr:first");
                    const newRow = firstRow.clone();
                    newRow.find('.product-select').val('').trigger('change');
                    newRow.find('.price-input').val('0.00');
                    newRow.find('.description-input').val('');
                    newRow.find('.quantity-input').val('1');
                    newRow.find('.item-total').text('0.00');
                    $("[data-kt-element='items'] tbody").append(newRow);
                    initSelect2();
                });

                $('#discount-select').on('change', updateTotals);

                updateTotals();
            });
        });

        document.getElementById('invoiceForm').addEventListener('submit', function() {
            let btn = document.getElementById('createInvoiceBtn');
            btn.disabled = true;
            btn.querySelector('.indicator-label').style.display = 'none';
            btn.querySelector('.indicator-progress').style.display = 'inline-block';
        });
    </script>
</x-app-layout>
