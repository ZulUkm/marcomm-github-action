<!-- filepath: /Users/zulfaris/Desktop/ukm sistem/marcomm/resources/views/components/image-slider.blade.php -->
@props(['attachments' => [], 'placeholder' => 'build/img/products/product-placeholder.jpg'])

<div class="slider-product-details">
    <div class="owl-carousel owl-theme product-slide">
        @forelse($attachments as $attachment)
            <div class="slider-product">
                <img src="{{ Storage::disk('public_raw')->url(ltrim($attachment->path, '/')) }}"
                    alt="{{ $attachment->original_filename ?? 'Product Image' }}">
                <h4>{{ $attachment->original_filename ?? 'Product Image' }}</h4>
                <h6>{{ round($attachment->size / 1024, 2) }}kb</h6>
            </div>
        @empty
            <div class="slider-product">
                <img src="{{ URL::asset($placeholder) }}" alt="No image">
                <h4>No images available</h4>
            </div>
        @endforelse
    </div>
</div>
<!-- filepath: /Users/zulfaris/Desktop/ukm sistem/marcomm/resources/views/components/image-slider.blade.php -->

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".product-slide").owlCarousel({
                items: 1,
                loop: true,
                margin: 0,
                nav: true,
                navText: [
                    "<i class='fa fa-chevron-left'></i>",
                    "<i class='fa fa-chevron-right'></i>"
                ],
                dots: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true
            });
        });
    </script>
@endpush