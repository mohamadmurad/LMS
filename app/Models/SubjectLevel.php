<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SubjectLevel extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'level_id',
        'subject_id',
        'point',
    ];
}
