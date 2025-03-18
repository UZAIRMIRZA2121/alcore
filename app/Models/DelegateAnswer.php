<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelegateAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['delegate_id', 'question_id', 'answers'];

    protected $casts = [
        'answers' => 'array', // Automatically handle JSON conversion
    ];

    // Relationships
    public function delegate()
    {
        return $this->belongsTo(Delegate::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
