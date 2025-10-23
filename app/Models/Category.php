<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $fillable = ['name', 'is_active'];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Optional: clean up files when a category is deleted
    protected static function booted()
    {
        static::deleting(function ($category) {
            foreach ($category->attachments as $att) {
                if ($att->path && Storage::disk('public')->exists($att->path)) {
                    Storage::disk('public')->delete($att->path);
                }
                $att->delete();
            }
        });
    }
}
