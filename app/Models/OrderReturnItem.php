<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderReturnItem extends Model
{
    protected $fillable = [
        'order_return_id',
        'product_id',
        'quantity',
        'notes',
    ];
    // Define relationships and other model methods as needed

    public function orderReturn()
    {
        return $this->belongsTo(OrderReturn::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
