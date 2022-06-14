<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'student_id',
        'stars',
        'comment',
    ];

    public function student(){
        return $this->belongsTo(User::class,'student_id','id');
    }
}
