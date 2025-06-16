<x-app-layout>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush py-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2>Create Invoice</h2>
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
                        <form id="kt_invoice_form" action="{{ route('invoices.store') }}" method="POST">
                            @csrf
                            <!-- Customer Details -->
                            <div class="row mb-5">
                                <div class="col-lg-6">
                                    <label class="form-label fs-6 fw-bold">Customer Name</label>
                                    <input type="text" class="form-control" name="customer_name" required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label fs-6 fw-bold">Customer Address</label>
                                    <textarea name="customer_address" class="form-control" rows="3" required></textarea>
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
                                        @if(isset($orderProducts) && count($orderProducts) > 0)
                                            @foreach($orderProducts as $product)
                                                <tr class="border-bottom border-bottom-dashed" data-kt-element="item">
                                                    <td>
                                                       <select name="product_id[]" class="form-select form-select-solid product-select" required>
                                                            <option value="" disabled>Select a product</option>
                                                            @foreach ($products as $prod)
                                                                <option value="{{ $prod->id }}"
                                                                    data-price="{{ $prod->price }}"
                                                                    data-description="{{ $prod->description }}"
                                                                    {{ $prod->id == $product->id ? 'selected' : '' }}>
                                                                    {{ $prod->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input class="form-control form-control-solid quantity-input" type="number" min="1" name="quantity[]" value="{{ $product->pivot->quantity }}" required>
                                                    </td>
                                                    <td>
                                                        <input class="form-control form-control-solid text-end price-input" type="number" min="0" step="0.01" name="price[]" value="{{ $product->price }}" required>
                                                    </td>
                                                    <td>
                                                        <input class="form-control form-control-solid description-input" type="text" name="description[]" value="{{ $product->description }}" placeholder="Item description" required>
                                                    </td>
                                                    <td class="text-end">
                                                        ₦<span class="item-total">{{ number_format($product->pivot->quantity * $product->price, 2) }}</span>
                                                    </td>
                                                    <td class="text-end">
                                                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-kt-element="remove-item">
                                                        <i class="fas fa-trash fs-3"></i>
                                                    </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="border-bottom border-bottom-dashed" data-kt-element="item">
                                                <td>
                                                    <select name="product_id[]" class="form-select form-select-solid product-select" required>
                                                        <option value="" disabled selected>Select a product</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}"
                                                                data-price="{{ $product->price }}"
                                                                data-description="{{ $product->description }}">
                                                                {{ $product->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-solid quantity-input" type="number" min="1" name="quantity[]" value="1" required>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-solid text-end price-input" type="number" min="0" step="0.01" name="price[]" value="0.00" required>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-solid description-input" type="text" name="description[]" placeholder="Item description" required>
                                                </td>
                                                <td class="text-end">
                                                    ₦<span class="item-total">0.00</span>
                                                </td>
                                                <td class="text-end">
                                                <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-kt-element="remove-item">
                                                    <i class="fas fa-trash fs-3"></i>
                                                </button>
                                                </td>
                                            </tr>
                                        @endif
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
                                        <option value="0">No Discount</option>
                                        <option value="2">2% Discount</option>
                                        <option value="4">4% Discount</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label fs-6 fw-bold">Status</label>
                                    <select name="status" id="" class="form-select form-select-solid">
                                        <option value="" disabled>Show Option</option>
                                        <option value="paid">Paid</option>
                                        <option value="not-paid">Not Paid</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div>
                                <label class="form-label fs-6 fw-bold">Notes</label>
                                <textarea name="notes" class="form-control" rows="3" placeholder="Thanks for your business" required>Thanks for your business</textarea>
                            </div>
                            <!-- Submit Button -->
                            <div class="text-end mt-5">
                                <button type="submit" class="btn btn-primary">Create Invoice</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JS for Dynamic Logic -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const itemsTable = document.querySelector("[data-kt-element='items']");
            const addItemButton = document.querySelector("[data-kt-element='add-item']");
            const grandTotalElement = document.getElementById("grand-total");
            const discountSelect = document.getElementById("discount-select");

            // Update totals
            const updateTotals = () => {
                let grandTotal = 0;
                const discount = parseFloat(discountSelect.value) || 0;

                itemsTable.querySelectorAll("[data-kt-element='item']").forEach(row => {
                    const quantityInput = row.querySelector(".quantity-input");
                    const priceInput = row.querySelector(".price-input");
                    const itemTotalElement = row.querySelector(".item-total");

                    const quantity = parseFloat(quantityInput.value) || 0;
                    const price = parseFloat(priceInput.value) || 0;
                    const total = quantity * price;

                    itemTotalElement.textContent = total.toFixed(2);
                    grandTotal += total;
                });

                // Apply discount
                const discountedTotal = grandTotal - (grandTotal * (discount / 100));
                grandTotalElement.textContent = discountedTotal.toFixed(2);
            };

            // Add new item row
            const addItem = () => {
                const newRow = itemsTable.querySelector("tbody tr").cloneNode(true);
                newRow.querySelector(".product-select").value = "";
                newRow.querySelector(".price-input").value = "0.00";
                newRow.querySelector(".description-input").value = "";
                newRow.querySelector(".quantity-input").value = "1";
                newRow.querySelector(".item-total").textContent = "0.00";

                newRow.querySelector("[data-kt-element='remove-item']").addEventListener("click", () => {
                    newRow.remove();
                    updateTotals();
                });

                newRow.querySelector(".product-select").addEventListener("change", (e) => {
                    const selectedOption = e.target.options[e.target.selectedIndex];
                    const price = selectedOption.getAttribute("data-price");
                    const description = selectedOption.getAttribute("data-description");
                    newRow.querySelector(".price-input").value = parseFloat(price).toFixed(2);
                    newRow.querySelector(".description-input").value = description;
                    updateTotals();
                });

                newRow.querySelector(".quantity-input").addEventListener("input", updateTotals);
                newRow.querySelector(".price-input").addEventListener("input", updateTotals);

                itemsTable.querySelector("tbody").appendChild(newRow);
            };

            // Attach event listeners
            addItemButton.addEventListener("click", (e) => {
                e.preventDefault();
                addItem();
            });

            discountSelect.addEventListener("change", updateTotals);

            itemsTable.querySelectorAll("[data-kt-element='item']").forEach(row => {
                row.querySelector("[data-kt-element='remove-item']").addEventListener("click", () => {
                    row.remove();
                    updateTotals();
                });

                row.querySelector(".product-select").addEventListener("change", (e) => {
                    const selectedOption = e.target.options[e.target.selectedIndex];
                    const price = selectedOption.getAttribute("data-price");
                    const description = selectedOption.getAttribute("data-description");
                    row.querySelector(".price-input").value = parseFloat(price).toFixed(2);
                    row.querySelector(".description-input").value = description;
                    updateTotals();
                });

                row.querySelector(".quantity-input").addEventListener("input", updateTotals);
                row.querySelector(".price-input").addEventListener("input", updateTotals);
            });

            updateTotals();
        });
    </script>
</x-app-layout>
