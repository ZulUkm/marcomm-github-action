<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'description', 'price', 'is_returnable', 'status', 'created_by'];

    /**
     * Get all attachments for the product.
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stocks()
    {
        return $this->hasOne(ProductStock::class);
    }

    public function stock()
    {
        return $this->hasOne(ProductStock::class);
    }

    public function restocks()
    {
        return $this->hasMany(ProductRestock::class);
    }

    /**
     * Get the primary image for the product.
     */
    public function getPrimaryImageAttribute()
    {
        return $this->attachments()->where('is_primary', true)->first() ?? $this->attachments()->first();
    }

    /**
     * Get the primary image URL.
     */
    public function getImageUrlAttribute()
    {
        return $this->primaryImage ? $this->primaryImage->path : asset('build/img/products/default.png');
    }

    public function getTotalQuantityAttribute()
    {
        return $this->stocks ? $this->stocks->quantity : 0;
    }
}
