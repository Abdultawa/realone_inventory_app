<!-- Add Quantity Modal -->
<div class="modal fade" id="addQuantityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <div class="modal-content">
            <form id="addQuantityForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h2 class="fw-bold">Add Quantity</h2>
                    <button type="button" class="btn btn-sm btn-icon btn-active-light-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="addQuantityProductId">

                    <div class="mb-3">
                        <label for="quantityAmount" class="form-label">Quantity to Add</label>
                        <input type="number" name="quantity" id="quantityAmount" class="form-control" min="1" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="submitAddQuantity" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('scripts')
<script>
    $(document).ready(function () {
        $('.open-add-quantity-modal').on('click', function () {
            const productId = $(this).data('id');
            const actionUrl = `/products/${productId}/add-quantity`;

            $('#addQuantityProductId').val(productId);
            $('#addQuantityForm').attr('action', actionUrl);
        });
    });
</script>
@endpush

