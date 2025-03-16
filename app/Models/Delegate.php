<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delegate extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id', // Add event_id to the fillable array
        'name', 
        'job_title', 
        'company_name', 
        'email', 
        'contact_number', 
        'personal_picture', 
        'personal_profile', 
        'company_profile', 
        'company_logo'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function priority()
    {
        return $this->hasOne(Priority::class, 'delegates_id');
    }
}
