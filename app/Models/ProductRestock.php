<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductRestock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'previous_quantity',
        'new_quantity',
        'reference_number',
        'unit_cost',
        'batch_number',
        'expiry_date',
        'status',
        'notes'
    ];

     /**
     * Get the product that was restocked.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user who performed the restock.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
