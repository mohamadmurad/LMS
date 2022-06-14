<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBehavior extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'behavior_id',
        'subject_id',
    ];


    public function behavior()
    {
        return $this->belongsTo(Behavior::class, 'behavior_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
