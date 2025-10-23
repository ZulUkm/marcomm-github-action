@props(['order'])


<a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
</a>
<ul class="dropdown-menu">
    <li>
        <a href="{{ route('orders.show', $order->id) }}" class="dropdown-item">
            <i data-feather="eye" class="info-img"></i>Order Detail
        </a>
    </li>
    <li>
        <a href="{{ route('orders.edit', $order->id) }}" class="dropdown-item">
            <i data-feather="edit" class="info-img"></i>Edit Order
        </a>
    </li>
    <li>
        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="dropdown-item mb-0 text-danger"
                onclick="return confirm('Are you sure you want to delete this order?')">
                <i data-feather="trash-2" class="info-img"></i>Delete Order
            </button>
        </form>
    </li>
</ul>
