@props(['order'])

<div class="card mt-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Process Returns</h5>
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
    <div class="card-body">
        @if ($order->status == 'Delivered' || $order->status == 'Completed' || $order->status == 'Approved')
            <form action="{{ route('admin.orders.return', $order->id) }}" method="POST">
                @csrf
                <div class="table-responsive mb-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Ordered Qty</th>
                                <th>Return Qty</th>
                                {{-- <th>Condition</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="mb-0">{{ $item->product->name ?? 'Unknown Product' }}</h6>
                                                <small class="text-muted">ID: {{ $item->product_id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>
                                        <input type="number" name="returns[{{ $item->id }}][quantity]"
                                            class="form-control form-control-sm" min="0"
                                            max="{{ $item->quantity }}" value="0">
                                    </td>
                                    {{-- <td>
                                        <select name="returns[{{ $item->id }}][condition]"
                                            class="form-select form-select-sm">
                                            <option value="good">Good (Restock)</option>
                                            <option value="damaged">Damaged</option>
                                        </select>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mb-3">
                    <label for="reason" class="form-label">Return Reason</label>
                    <select name="reason" id="reason" class="form-select" required>
                        <option value="">Select reason</option>
                        <option value="Customer Request">Customer Request</option>
                        <option value="Damaged Products">Damaged Products</option>
                        <option value="Wrong Items">Wrong Items</option>
                        <option value="Event Completed">Event Completed</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea name="notes" id="notes" rows="3" class="form-control"
                        placeholder="Additional details about this return..."></textarea>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-box me-1"></i> Process Return
                    </button>
                </div>
            </form>
        @elseif($order->status == 'Returned')
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                This order has been marked as returned
            </div>

            @if ($order->returnItems && $order->returnItems->count() > 0)
                <div class="table-responsive mt-3">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Returned Qty</th>
                                <th>Condition</th>
                                <th>Restocked</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->returnItems as $return)
                                <tr>
                                    <td>{{ $return->product->name ?? 'Unknown Product' }}</td>
                                    <td>{{ $return->quantity }}</td>
                                    <td>{{ ucfirst($return->condition) }}</td>
                                    <td>{{ $return->restocked ? 'Yes' : 'No' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Returns can only be processed for delivered, completed, or approved orders.
            </div>
        @endif
    </div>
</div>
