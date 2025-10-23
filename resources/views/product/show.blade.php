<?php $page = 'view-product'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Product Details</h4>
                    <h6>Full details of a product</h6>
                </div>
            </div>

            <!-- /add -->
            <div class="row">
                <div class="col-lg-5 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <x-bar-code-view /> --}}
                            <div class="productdetails">
                                <ul class="product-bar">
                                    <li>
                                        <h4>Product Name</h4>
                                        <h6>{{ $product->name }}</h6>
                                    </li>
                                    <li>
                                        <h4>Category</h4>
                                        <h6>{{ $product->category->name ?? 'N/A' }}</h6>
                                    </li>
                                    <li>
                                        <h4>Details Product</h4>
                                        <h6>{{ $product->description }}</h6>
                                    </li>
                                    <li>
                                        <h4>Quantity</h4>
                                        <h6>{{ $product->stocks->sum('quantity') }}</h6>
                                    </li>
                                    <li>
                                        <h4>Status</h4>
                                        <h6>
                                            @if ($product->status === 'active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </h6>
                                    </li>
                                    <li>
                                        <h4>Return Status</h4>
                                        <h6>
                                            @if ($product->is_returnable)
                                                <span class="badge bg-info">Returnable</span>
                                            @else
                                                <span class="badge bg-secondary">Non-returnable</span>
                                            @endif
                                        </h6>
                                    </li>
                                    <li>
                                        <h4>Created At</h4>
                                        <h6>{{ $product->created_at->format('d M Y, H:i') }}</h6>
                                    </li>
                                    <li>
                                        <h4>Updated At</h4>
                                        <h6>{{ $product->updated_at->format('d M Y, H:i') }}</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>Restock History</h4>
                            </div>
                            {{-- <div class="card-btns">
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#restockModal" data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->name }}"
                                    data-category="{{ $product->category->name ?? 'Uncategorized' }}"
                                    data-quantity="{{ $product->total_quantity }}">
                                    <i data-feather="plus-circle"></i> Add Restock
                                </button>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            @if ($product->restocks->count() > 0)
                                <div class="table-responsive">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Added Qty</th>
                                                <th>Previous Qty</th>
                                                <th>New Qty</th>
                                                <th>Reference</th>
                                                <th>Added By</th>
                                                <th>Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->restocks as $restock)
                                                <tr>
                                                    <td>{{ $restock->created_at->format('d M Y, H:i') }}</td>
                                                    <td><span class="badge bg-success">+{{ $restock->quantity }}</span>
                                                    </td>
                                                    <td>{{ $restock->previous_quantity }}</td>
                                                    <td>{{ $restock->new_quantity }}</td>
                                                    <td>{{ $restock->reference_number ?? 'N/A' }}</td>
                                                    <td>{{ $restock->user->name ?? 'System' }}</td>
                                                    <td>
                                                        @if ($restock->notes)
                                                            <span data-bs-toggle="tooltip" title="{{ $restock->notes }}">
                                                                {{ \Illuminate\Support\Str::limit($restock->notes, 30) }}
                                                            </span>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <img src="{{ asset('build/img/icons/no-data.svg') }}" alt="No Data"
                                        class="w-25 opacity-50 mb-3" style="max-width: 120px;">
                                    <h5 class="text-muted">No restock history found</h5>
                                    <p>This product has never been restocked.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <x-image-slider :attachments="$product->attachments" />
                        </div>
                    </div>
                </div>
            </div>


            <!-- /add -->
        </div>
    </div>
@endsection
