<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'sponsor_id',
        'delegates_id',
        'priority',
        'status',
        'start_time',
        'end_time',
    ];

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class);
    }

    public function delegate()
    {
        return $this->belongsTo(Delegate::class, 'delegates_id');
    }
}
