<style>
    /* Hide the product table initially */
    .product-lists {
        display: none;
    }

    /* Make sure empty cart message is visible */
    .cart-empty {
        display: block;
    }

    /* Style for the checkout button */
    .btn-checkout {
        width: 100%;
        margin-top: 20px;
    }

    /* Disable checkout when cart is empty */
    .checkout-disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>
<form id="order-form" action="{{ route('orders.store') }}" method="POST">
    @csrf
    <div id="order-items-data">

        <div class="product-added block-section">
            <div class="head-text d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center">
                    <h5 class="me-2">Order Details</h5>
                    <div class="badge bg-light text-gray-9 fs-12 fw-semibold py-2 border rounded">
                        Items : <span class="text-teal">0</span>
                    </div>
                </div>
                <a href="javascript:void(0);" class="d-flex align-items-center clear-icon fs-10 fw-medium">Clear all</a>
            </div>
            <div class="product-wrap">
                <div class="cart-empty text-center py-4">
                    <div class="fs-24 mb-1">
                        <i class="ti ti-shopping-cart"></i>
                    </div>
                    <p class="fw-bold">No Products Selected</p>
                </div>
            </div>

            <!-- Remove the comment markers from around this section -->
            <div class="product-lists border-0 p-0">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th class="fw-bold bg-light">Item</th>
                                <th class="fw-bold bg-light">QTY</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Event information - OUTSIDE the order-items-data div -->
    <div class="event-info mt-4 border-top pt-3">
        <h5 class="mb-3">Event Information</h5>

        <div class="form-group mb-3">
            <x-form.text-input name="event_name" label="Event Name" placeholder="Enter event name" :value="$eventName ?? ''"
                required />
        </div>

        <div class="form-group mb-3">
            <x-form.date-input name="event_date" label="Event Date" required />
        </div>

        <div class="form-group mb-3">
            <x-form.date-input name="event_end_date" label="Event End Date" required />
        </div>

        <div class="form-group mb-3">
            <x-form.text-input name="event_location" label="Event Location" placeholder="Enter event location" />
        </div>

        <div class="form-group">
            <x-form.textarea id="notes" name="notes" rows="3" label="Additional Notes"
                placeholder="Any special instructions or requirements"></x-form.textarea>
        </div>
    </div>

</form>
