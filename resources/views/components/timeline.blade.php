@props(['order'])

@php
    function getStatusColor($status)
    {
        return match ($status) {
            'Pending' => 'warning',
            'Processing' => 'primary',
            'Completed' => 'success',
            'Delivered' => 'info',
            'Cancelled' => 'danger',
            'Approved' => 'success',
            'Rejected' => 'danger',
            default => 'secondary',
        };
    }

    function getStatusIcon($status)
    {
        return match ($status) {
            'Pending' => 'fas fa-clock',
            'Processing' => 'fas fa-cog',
            'Completed' => 'fas fa-check-circle',
            'Delivered' => 'fas fa-truck',
            'Cancelled' => 'fas fa-ban',
            'Approved' => 'fas fa-thumbs-up',
            'Rejected' => 'fas fa-thumbs-down',
            default => 'fas fa-info-circle',
        };
    }
@endphp

<!-- Order Timeline -->

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Order Timeline</h5>
    </div>
    <div class="card-body">
        <ul class="timeline">
            <!-- Order creation entry -->
            <li>
                <div class="timeline-badge success">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">Order Created</h4>
                        <p><small class="text-muted"><i class="fas fa-clock"></i>
                                {{ $order->created_at->format('d M Y, h:i A') }}</small></p>
                    </div>
                    <div class="timeline-body">
                        <p>Order #{{ $order->order_number }} has been created.</p>
                        @if ($order->event_name)
                            <p><strong>Event:</strong> {{ $order->event_name }}</p>
                        @endif
                    </div>
                </div>
            </li>

            <!-- Status history entries -->
            @if ($order->statusHistory && $order->statusHistory->count() > 0)
                @foreach ($order->statusHistory as $index => $history)
                    <li class="{{ ($index + 1) % 2 == 0 ? 'timeline-inverted' : '' }}">
                        <div class="timeline-badge {{ getStatusColor($history->status) }}">
                            <i class="{{ getStatusIcon($history->status) }}"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Status Updated: {{ $history->status }}</h4>
                                <p><small class="text-muted"><i class="fas fa-clock"></i>
                                        {{ $history->created_at->format('d M Y, h:i A') }}</small></p>
                            </div>
                            <div class="timeline-body">
                                @if ($history->notes)
                                    <p>{{ $history->notes }}</p>
                                @else
                                    <p>Order status changed to <strong>{{ $history->status }}</strong>.</p>
                                @endif

                                @if ($history->created_by)
                                    <p class="text-muted"><small>Updated by:
                                            {{ $history->creator->name ?? 'System' }}</small></p>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
            @else
                <!-- If no status updates yet -->
                <li class="timeline-inverted">
                    <div class="timeline-badge warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">Current Status: {{ $order->status }}</h4>
                        </div>
                        <div class="timeline-body">
                            <p>No status updates have been recorded yet.</p>
                        </div>
                    </div>
                </li>
            @endif

            <!-- Status update form (only for staff) -->
            @if (auth()->user() && auth()->user()->can('update', $order))
                <li
                    class="{{ $order->statusHistory ? (($order->statusHistory->count() + 1) % 2 == 0 ? 'timeline-inverted' : '') : 'timeline-inverted' }}">
                    <div class="timeline-badge info">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">Update Status</h4>
                        </div>
                        <div class="timeline-body">
                            <form action="{{ route('orders.update-status', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <label for="status" class="form-label">New Status</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="Processing"
                                            {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing
                                        </option>
                                        <option value="Completed"
                                            {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed
                                        </option>
                                        <option value="Delivered"
                                            {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered
                                        </option>
                                        <option value="Cancelled"
                                            {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea name="notes" id="notes" class="form-control" rows="2"
                                        placeholder="Add notes about this status change"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Status</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</div>
