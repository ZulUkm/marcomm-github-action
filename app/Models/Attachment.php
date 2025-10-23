<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'original_filename',
        'filename',
        'path',
        'mime_type',
        'size',
        'attachable_type',
        'attachable_id',
        'is_primary',
        'alt_text',
        'display_order',
        'created_by'
    ];
    
    /**
     * Get the parent attachable model.
     */
    public function attachable()
    {
        return $this->morphTo();
    }
    
    /**
     * Get the full URL of the attachment.
     */
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }
}
