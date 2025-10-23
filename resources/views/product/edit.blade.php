<!-- filepath: /Users/zulfaris/Desktop/ukm sistem/marcomm/resources/views/product/edit.blade.php -->
<?php $page = 'edit-product'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4 class="fw-bold">Create Product</h4>
                        <h6>Create new product</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <x:card-refresh />
                    <x:card-collapse />
                </ul>
                <x:card-back-button />
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="add-product">
                    <div class="accordions-items-seperate" id="accordionSpacingExample">
                        <div class="accordion-item border mb-4">
                            <h2 class="accordion-header" id="headingSpacingOne">
                                <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                                    data-bs-target="#SpacingOne" aria-expanded="true" aria-controls="SpacingOne">
                                    <div class="d-flex align-items-center justify-content-between flex-fill">
                                        <h5 class="d-flex align-items-center"><i data-feather="info"
                                                class="text-primary me-2"></i><span>Product Name</span></h5>
                                    </div>
                                </div>
                            </h2>
                            <div id="SpacingOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingSpacingOne">
                                <div class="accordion-body border-top">

                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <x-form-input name="name" label="Product Name" :value="old('name', $product->name)" />
                                            {{ $product->name }}
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <x-form-input name="description" label="Details Product" :value="old('description', $product->description)" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="mb-3">
                                                <x-form-select name=category_id label="Category" :options="$categories->pluck('name', 'id')->toArray()"
                                                    :selected="old('category_id', $product->category_id)" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <x-quantity-input name="alert_quantity" label="Alert Quantity" :value="old('alert_quantity', $product->stock->alert_quantity ?? 0)"
                                                min="1" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <x-form-radio-group name="is_returnable" label="Return Status" :options="[1 => 'Returnable', 0 => 'Non-returnable']"
                                                :selected="old('is_returnable', $product->is_returnable)" required />
                                        </div>
                                        <div class="col-md-6">
                                            <x-form-radio-group name="status" label="Status" :options="['active' => 'Active', 'inactive' => 'Inactive']"
                                                :selected="old('status', $product->status)" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border mb-4">
                            <h2 class="accordion-header" id="headingSpacingThree">
                                <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                                    data-bs-target="#SpacingThree" aria-expanded="true" aria-controls="SpacingThree">
                                    <div class="d-flex align-items-center justify-content-between flex-fill">
                                        <h5 class="d-flex align-items-center">
                                            <i data-feather="image" class="text-primary me-2"></i>
                                            <span>Product Images</span>
                                        </h5>
                                    </div>
                                </div>
                            </h2>
                            <!-- filepath: /Users/zulfaris/Desktop/ukm sistem/marcomm/resources/views/product/edit.blade.php -->
                            <div id="SpacingThree" class="accordion-collapse collapse show"
                                aria-labelledby="headingSpacingThree">
                                <div class="accordion-body border-top">
                                    <div class="text-editor add-list add">
                                        <div class="col-lg-12">
                                            <div class="add-choosen">
                                                <!-- Using the new component -->
                                                <x-image-manager :attachments="$product->attachments" id="product-images"
                                                    uploadText="Add Product Images" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-end mb-4">
                            <x-card-cancel-button route="products.index" />
                            <button type="submit" class="btn btn-primary">Update Product</button>
                        </div>
                    </div>
            </form>
        </div>
        <x-footer />
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
