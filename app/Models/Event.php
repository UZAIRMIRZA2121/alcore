<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'start',
        'end',
        'lock_date',
    ];
    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class);
    }
}
