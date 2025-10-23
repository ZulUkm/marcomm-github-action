@props(['id', 'image', 'category', 'name', 'price', 'qty'])
<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
    <div class="product-info card mb-0">
        <a href="javascript:void(0);" class="pro-img">
            <div style="aspect-ratio: 1/1; overflow: hidden; width: 100%;">
                <img src="{{ Storage::disk('public_raw')->url(ltrim($image, '/')) }}" alt="Products" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <span><i class="ti ti-circle-check-filled"></i></span>
        </a>

        <!-- Stock quantity indicator -->
        <div class="stock-indicator">
            @if ($qty > 0)
                <span class="badge bg-success">In Stock: {{ $qty }}</span>
            @endif
        </div>

        <h6 class="cat-name"><a href="javascript:void(0);">{{ $category }}</a></h6>
        <h6 class="product-name"><a href="javascript:void(0);">{{ $name }}</a></h6>

        @if ($qty > 0)
            <!-- Product Quantity Section -->
            <div class="d-flex flex-column align-items-center justify-content-center">

                <!-- Add to Order button - now below input with trolley icon -->
                <button class="btn btn-primary add-to-order w-100" data-id="{{ $id }}"
                    data-name="{{ $name }}" data-price="{{ $price }}" data-image="{{ $image }}">
                    <i class="ti ti-shopping-cart"></i> Add to Order
                </button>
            </div>
        @else
            <div class="stock-badge out-of-stock mt-3">
                <span>Out of Stock</span>
            </div>
        @endif
    </div>
</div>
