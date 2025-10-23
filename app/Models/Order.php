<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_number', 'customer_id', 'order_date', 'event_name', 'event_date', 'collect_date', 'status', 'total_amount', 'notes'];
    //

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function event()
    {
        return $this->hasOne(Event::class);
    }

    /**
     * Get the status history for the order.
     */
    public function statusHistory()
    {
        return $this->hasMany(OrderStatusHistory::class);
    }

    /**
     * Get the latest status history entry.
     */
    public function latestStatus()
    {
        return $this->hasOne(OrderStatusHistory::class)->latest();
    }

    public function orderReturn()
    {
        return $this->hasOne(OrderReturn::class);
    }

    /**
     * Add a new status to the order history.
     *
     * @param string $status
     * @param string|null $notes
     * @return OrderStatusHistory
     */
    public function addStatus($status, $notes = null)
    {
        // Update the order's current status
        $this->status = $status;
        $this->save();

        // Create status history record
        return $this->statusHistory()->create([
            'status' => $status,
            'notes' => $notes,
            'created_by' => auth()->id() ?? null,
        ]);
    }
}
