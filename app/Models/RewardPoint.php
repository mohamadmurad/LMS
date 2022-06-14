<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'point_id','subject_id','student_id'
    ];

    public function point(){
        return $this->belongsTo(Points::class,'point_id','id');
    }
}
