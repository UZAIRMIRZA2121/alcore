<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sponsor extends Authenticatable
{
    use HasFactory;

    protected $guard = 'sponsor'; // Define the guard for this model

    protected $fillable = [
        'username',
        'email',
        'password',
        'status',
        'event_id',
        'details',
        'image',
        'job',
        'company_name',
        'company_details',
        'company_image',
        'phone',
        'type', // Add a 'type' column to differentiate between user types
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function isSponsor()
    {
        return $this->type === 'sponsor';
    }
}
