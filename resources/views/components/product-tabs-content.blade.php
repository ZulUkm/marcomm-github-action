<!-- Create a new component: x-product-tabs-content.blade.php -->
@props(['categories', 'products'])
<div class="tabs_container">
    <!-- "All" tab content -->
    <div class="tab_content active" data-tab="all">
        <div class="row g-3">
            @foreach ($products as $product)
                <x-card-container :id="$product->id" :image="$product->image_url" :category="$product->category->name" :name="$product->name"
                    :price="$product->price" :qty="$product->total_quantity" />
            @endforeach
        </div>
    </div>

    <!-- Category tabs content -->
    @foreach ($categories as $category)
        <div class="tab_content" data-tab="{{ $category->id }}">
            <div class="row g-3">
                @php
                    $categoryProducts = $products->where('category_id', $category->id);
                @endphp

                @if ($categoryProducts->count() > 0)
                    @foreach ($categoryProducts as $product)
                        {{-- <x-card-container :image="$product->attachments->count() > 0
                            ? asset('storage/' . $product->attachments->first()->path)
                            : 'build/img/products/pos-product-01.png'" :category="$category->name" :name="$product->name" :price="$product->price"
                            :qty="1" /> --}}

                        <x-card-container :id="$product->id" :image="$product->image_url" :category="$product->category->name" :name="$product->name"
                            :price="$product->price" :qty="$product->total_quantity" />
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-info">No products found in this category.</div>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
