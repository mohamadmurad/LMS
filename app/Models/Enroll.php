<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Enroll extends Pivot
{
    use HasFactory;
    protected $table = 'enrolls';


    protected $fillable = [
        'student_id','subject_id','points','level_id'
    ];

    public function level(){
        return $this->belongsTo(Level::class,'level_id','id');
    }
}
