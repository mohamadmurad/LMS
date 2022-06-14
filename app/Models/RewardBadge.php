<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardBadge extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge_id',
        'user_id',
        'subject_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function badge()
    {
        return $this->belongsTo(Badge::class, 'badge_id', 'id');
    }
}
