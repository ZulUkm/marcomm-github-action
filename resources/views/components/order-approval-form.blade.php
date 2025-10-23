@props(['order'])

<div class="card mt-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Order Approval</h5>
    </div>
    <div class="card-body">
        @if ($order->status == 'Pending')
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                This order is waiting for your approval.
            </div>

            <form action="{{ route('admin.orders.process-approval', $order->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="comments" class="form-label">Notes (Optional)</label>
                    <textarea name="comments" id="comments" rows="3" class="form-control"
                        placeholder="Add any notes about this order..."></textarea>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" name="action" value="approve" class="btn btn-success">
                        <i class="fas fa-check-circle me-1"></i> Approve Order
                    </button>

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                        <i class="fas fa-times-circle me-1"></i> Reject Order
                    </button>
                </div>
            </form>

            <!-- Reject Modal -->
            <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="rejectModalLabel">Confirm Rejection</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.orders.process-approval', $order->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <p>Are you sure you want to reject this order?</p>
                                <div class="mb-3">
                                    <label for="comments" class="form-label">Rejection Reason <span
                                            class="text-danger">*</span></label>
                                    <textarea name="comments" id="comments" rows="3" class="form-control" required
                                        placeholder="Please provide a reason for rejecting this order..."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" name="action" value="reject" class="btn btn-danger">Confirm
                                    Rejection</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @elseif($order->status == 'Approved')
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                This order has been approved.
            </div>
            @if ($order->admin_notes)
                <div class="mt-3">
                    <h6 class="text-muted">Admin Notes:</h6>
                    <p class="p-3 bg-light rounded">{{ $order->admin_notes }}</p>
                </div>
            @endif
        @elseif($order->status == 'Rejected')
            <div class="alert alert-danger">
                <i class="fas fa-times-circle me-2"></i>
                This order has been rejected.
            </div>
            @if ($order->rejection_reason)
                <div class="mt-3">
                    <h6 class="text-muted">Rejection Reason:</h6>
                    <p class="p-3 bg-light rounded">{{ $order->rejection_reason }}</p>
                </div>
            @endif
        @else
            <div class="alert alert-secondary">
                <i class="fas fa-info-circle me-2"></i>
                This order is in {{ $order->status }} status.
            </div>
        @endif
    </div>
</div>
