<div class="col-md-12 col-lg-5 col-xl-4 ps-0 theiaStickySidebar d-lg-flex">
    <aside class="product-order-list bg-secondary-transparent flex-fill">
        <div class="card">
            <div class="card-body">
                <div class="order-head d-flex align-items-center justify-content-between w-100">
                    <div>
                        <h3>Order List</h3>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a class="link-danger fs-16" href="javascript:void(0);"><i class="ti ti-trash-x-filled"></i></a>
                    </div>
                </div>

                <x:card-order-details />

            </div>
        </div>
        <div class="btn-row d-flex align-items-center justify-content-center gap-3 flex-row">
            <x:card-print-button />
            <x:order-button />
        </div>
    </aside>
</div>
