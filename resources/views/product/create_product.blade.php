<?php $page = 'add-product'; ?>
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
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                                            <x-form-input name="name" label="Product Name" :value="old('name')" />
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <x-form-input name="description" label="Details Product" :value="old('description')" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="mb-3">
                                                <x-form-select name=category_id label="Category" :options="$categories->pluck('name', 'id')->toArray()"
                                                    :selected="old('category_id')" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <x-quantity-input name="quantity" label="Quantity" :value="old('quantity', 1)"
                                                min="1" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <x-form-radio-group name="is_returnable" label="Return Status" :options="[1 => 'Returnable', 0 => 'Non-returnable']"
                                                :selected="old('is_returnable', 0)" required />
                                        </div>
                                        <div class="col-md-6">
                                            <x-form-radio-group name="status" label="Status" :options="['active' => 'Active', 'inactive' => 'Inactive']"
                                                :selected="old('status', 'active')" required />
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
                            <div id="SpacingThree" class="accordion-collapse collapse show"
                                aria-labelledby="headingSpacingThree">
                                <div class="accordion-body border-top">
                                    <div class="text-editor add-list add">
                                        <div class="col-lg-12">
                                            <div class="add-choosen">
                                                {{-- <input type="file" name="attachments[]"> --}}
                                                <x-form-image-upload name="attachments[]" label="Upload Files" multiple />
                                            </div>
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
                        <button type="submit" class="btn btn-primary">Add New Product</button>
                    </div>
                </div>
            </form>
        </div>
        <x-footer />
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const quantityInput = document.getElementById("quantityInput");
        const increaseBtn = document.getElementById("increaseBtn");
        const decreaseBtn = document.getElementById("decreaseBtn");

        if (quantityInput && increaseBtn && decreaseBtn) {
            increaseBtn.addEventListener("click", () => {
                quantityInput.value = parseInt(quantityInput.value) + 1;
            });

            decreaseBtn.addEventListener("click", () => {
                if (parseInt(quantityInput.value) > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                }
            });
        }
    });
</script>
