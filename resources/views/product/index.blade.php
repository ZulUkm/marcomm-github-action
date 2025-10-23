<?php $page = 'product'; ?>
@extends('layout.mainlayout')

@section('content')
    {{-- Current locale: {{ app()->getLocale() }} --}}

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">

                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4 class="fw-bold">{{ __('messages.product') }}</h4>
                        <h6>{{ __('messages.manage_product') }}</h6>
                        {{-- <div>Session locale: {{ session('locale') }}</div>
								<div>Current locale: {{ app()->getLocale() }}</div> --}}
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <x:card-jana-pdf />
                    </li>
                    <li>
                        <x:card-jana-excel />
                    </li>
                    <li>
                        <x:card-refresh />
                    </li>
                    <li>
                        <x:card-collapse />
                    </li>
                </ul>
                <div class="page-btn">
                    <x:card-add-button route="products.create" />
                </div>
            </div>

            <!-- Add alert component here -->
            <x-alert />

            <!-- /product list -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                    <div class="search-set">
                        <div class="search-input">
                            <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="no-sort text-center align-middle">
                                        <label class="checkboxs mb-0">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th class="align-middle">ID</th>
                                    <th class="align-middle">Product Name</th>
                                    <th class="align-middle">Category</th>
                                    <th class="align-middle">Quantity</th>
                                    <th class="align-middle">Qty Alert</th>
                                    <th class="align-middle">Return Status</th>
                                    <th class="align-middle">Status</th>
                                    <th class="no-sort text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td><span class="text-gray-9">{{ $product->id }}</span></td>
                                        <td><span class="text-gray-9">{{ $product->name }}</span></td>
                                        <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                                        <td>{{ $product->total_quantity }}</td>
                                        <td>{{ $product->stock ? $product->stock->alert_quantity : 1 }}</td>
                                        <td>
                                            @if ($product->is_returnable)
                                                <x-card-return-status status="Returnable" />
                                            @else
                                                <x-card-return-status status="Non-returnable" />
                                            @endif
                                        </td>
                                        <td><x-card-status status="{{ $product->status }}" /></td>
                                        <td class="action-table-data">
                                            <div class="edit-delete-action">
                                                <button class="btn btn-sm me-1" title="Restock Product"
                                                    data-bs-toggle="modal" data-bs-target="#restockModal"
                                                    data-product-id="{{ $product->id }}"
                                                    data-product-name="{{ $product->name }}"
                                                    data-category="{{ $product->category->name ?? 'Uncategorized' }}" ">
                                                                            <i data-feather="plus-square" class="action-plus-square"></i>
                                                                        </button>
                                                                        <x-card-view-button :url="route('products.show', $product->id)" />
                                                                        <x:card-edit-button :url="route('products.edit', $product->id)" />
                                                                        <x:card-delete-button :url="route('products.destroy', $product->id)" />
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <!-- Restock Modal -->
                                                            <x-modal-popup.restock :product="$product" />
     @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /product list -->
        </div>
        <x-footer />
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const restockModal = document.getElementById('restockModal');
            if (restockModal) {
                restockModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;

                    // Get data from button
                    document.getElementById('product_id').value = button.dataset.productId;
                    document.getElementById('product_name').value = button.dataset.productName;
                    document.getElementById('category').value = button.dataset.category;
                });
            }
        });
    </script>
@endsection
