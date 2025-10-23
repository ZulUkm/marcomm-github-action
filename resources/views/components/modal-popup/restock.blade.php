    <!-- Restock Product -->
    <div class="modal fade" id="restockModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="page-title">
                        <h4>Restock Product</h4>
                    </div>
                    <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true" class="fs-16">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.restock') }}" method="POST">
                    @csrf
                    <div class="modal-body pb-0">

                        <x-form-input type="hidden" name="product_id" id="product_id" />

                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">Product name<span class="text-danger ms-1">*</span></label>
                                <x-form-input type="text" name="product_name" id="product_name" readonly />
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">Category<span class="text-danger ms-1">*</span></label>
                                <x-form-input type="text" name="category" id="category" readonly />
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">Restock Quantity<span
                                        class="text-danger ms-1">*</span></label>
                                <x-form-input name="quantity" type="number" required />
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">Reference Number (Optional)</label>
                                <x-form-input name="reference_number" value="{{ old('reference_number') }}" />
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label class="form-label">Notes (Optional)</label>
                                <x-form-textarea name="notes" placeholder="Enter your notes here"
                                    rows="4">{{ old('notes', $existingNotes ?? '') }}</x-form-textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn me-2 btn-secondary"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / Edit Low Stock -->
