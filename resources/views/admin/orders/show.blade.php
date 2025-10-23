@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Order Details #{{ $order->order_number }}</h4>
                    </div>
                    <div class="ms-auto">
                        <a href="{{ route('orders.index') }}" class="btn btn-light me-2">
                            <i class="fa fa-arrow-left"></i> Back to Orders
                        </a>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary me-2">
                            <i class="fa fa-edit"></i> Edit Order
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Order Details -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Order Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6 class="text-muted">Order Number</h6>
                                        <p class="fw-bold">{{ $order->order_number }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="text-muted">Customer</h6>
                                        <p class="fw-bold">{{ $order->customer_id ?? 'N/A' }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="text-muted">Event Name</h6>
                                        <p class="fw-bold">{{ $order->event_name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6 class="text-muted">Order Date</h6>
                                        <p class="fw-bold">
                                            {{ $order->order_date ? date('d M Y', strtotime($order->order_date)) : 'N/A' }}
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="text-muted">Event Date</h6>
                                        <p class="fw-bold">
                                            {{ $order->event_date ? date('d M Y', strtotime($order->event_date)) : 'N/A' }}
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="text-muted">Status</h6>
                                        <span
                                            class="badge badge-{{ $order->status == 'Completed' ? 'success' : ($order->status == 'Pending' ? 'warning' : 'info') }} fs-6">
                                            {{ $order->status ?? 'Pending' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top pt-4">
                                <h5 class="mb-3">Order Items</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($order->items as $item)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($item->product && $item->product->attachments->first())
                                                                <img src="{{ asset('storage/' . $item->product->attachments->first()->file_path) }}"
                                                                    class="rounded me-2" width="40" height="40"
                                                                    alt="{{ $item->product->name }}">
                                                            @else
                                                                <div class="avatar avatar-sm me-2 bg-light rounded">
                                                                    <span
                                                                        class="avatar-text">{{ substr($item->product->name ?? 'P', 0, 1) }}</span>
                                                                </div>
                                                            @endif
                                                            <div>
                                                                <h6 class="mb-0">
                                                                    {{ $item->product->name ?? 'Unknown Product' }}</h6>
                                                                <small class="text-muted">ID:
                                                                    {{ $item->product_id }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->quantity }}</td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No items found for this order
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            @if ($order->notes)
                                <div class="border-top pt-4">
                                    <h5 class="mb-3">Notes</h5>
                                    <div class="p-3 bg-light rounded">
                                        {{ $order->notes }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <x-timeline :order="$order" />
                </div>

                <!-- Only show approval form for admins -->
                {{-- @if (auth()->user() && auth()->user()->isAdmin()) --}}
                <x-order-approval-form :order="$order" />
                {{-- @endif --}}


                <div class="col-12 mt-4">
                    <x-order-return-form :order="$order" />
                </div>


            </div>
        </div>
        <x-footer />
    </div>
@endsection
