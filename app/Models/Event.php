<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Fixed: Illuminate instead of Iluminate
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'event_name',
        'event_start_date',
        'event_end_date',
        'location',
        'description',
    ];
    //
}
