      <!-- Order Timeline -->
      <div class="col-lg-4">
          <div class="card">
              <div class="card-header">
                  <h5 class="card-title">Order Timeline</h5>
              </div>
              <div class="card-body">
                  <div class="order-timeline">
                      <div class="timeline-item active">
                          <div class="timeline-dot bg-primary"></div>
                          <div class="timeline-content">
                              <h6>Order Placed</h6>
                              <p class="text-muted mb-0">
                                  {{ $order->order_date ? date('d M Y, h:i A', strtotime($order->order_date)) : 'N/A' }}
                              </p>
                          </div>
                      </div>

                      <div class="timeline-item {{ $order->status != 'Pending' ? 'active' : '' }}">
                          <div class="timeline-dot {{ $order->status != 'Pending' ? 'bg-primary' : 'bg-light' }}">
                          </div>
                          <div class="timeline-content">
                              <h6>Processing</h6>
                              <p class="text-muted mb-0">
                                  {{ $order->processed_at ? date('d M Y, h:i A', strtotime($order->processed_at)) : 'Pending' }}
                              </p>
                          </div>
                      </div>

                      <div class="timeline-item {{ $order->status == 'Completed' ? 'active' : '' }}">
                          <div class="timeline-dot {{ $order->status == 'Completed' ? 'bg-primary' : 'bg-light' }}">
                          </div>
                          <div class="timeline-content">
                              <h6>Completed</h6>
                              <p class="text-muted mb-0">
                                  {{ $order->completed_at ? date('d M Y, h:i A', strtotime($order->completed_at)) : 'Pending' }}
                              </p>
                          </div>
                      </div>

                      <div class="timeline-item {{ $order->status == 'Delivered' ? 'active' : '' }}">
                          <div class="timeline-dot {{ $order->status == 'Delivered' ? 'bg-primary' : 'bg-light' }}">
                          </div>
                          <div class="timeline-content">
                              <h6>Delivered</h6>
                              <p class="text-muted mb-0">
                                  {{ $order->delivered_at ? date('d M Y, h:i A', strtotime($order->delivered_at)) : 'Pending' }}
                              </p>
                          </div>
                      </div>
                  </div>

                  <!-- Status Update Form -->
                  @if (auth()->user() && auth()->user()->can('update', $order))
                      <div class="border-top pt-4 mt-4">
                          <h5 class="mb-3">Update Status</h5>
                          <form action="{{ route('orders.update-status', $order->id) }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <div class="mb-3">
                                  <select name="status" class="form-select">
                                      <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>
                                          Pending</option>
                                      <option value="Processing"
                                          {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing
                                      </option>
                                      <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>
                                          Completed
                                      </option>
                                      <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>
                                          Delivered
                                      </option>
                                      <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>
                                          Cancelled
                                      </option>
                                  </select>
                              </div>
                              <button type="submit" class="btn btn-primary">Update Status</button>
                          </form>
                      </div>
                  @endif
              </div>
          </div>
      </div>


      <style>
          .order-timeline {
              position: relative;
              padding-left: 30px;
          }

          .order-timeline:before {
              content: '';
              position: absolute;
              left: 10px;
              top: 0;
              height: 100%;
              width: 2px;
              background-color: #e9ecef;
          }

          .timeline-item {
              position: relative;
              padding-bottom: 30px;
          }

          .timeline-dot {
              position: absolute;
              left: -30px;
              top: 0;
              width: 20px;
              height: 20px;
              border-radius: 50%;
              border: 2px solid #fff;
              box-shadow: 0 0 0 2px #e9ecef;
          }

          .timeline-item.active .timeline-dot {
              background-color: #4e73df;
          }

          .timeline-content {
              padding-bottom: 10px;
          }
      </style>
