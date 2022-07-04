<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SubjectLevel extends Pivot
{
    use HasFactory;

    protected $table = 'subject_levels';

    protected $fillable = [
        'level_id',
        'subject_id',
        'point',
    ];

    public function level(){
        return $this->belongsTo(Level::class,'level_id','id');
    }
}
