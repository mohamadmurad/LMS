<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointCustomBehavior extends Model
{
    use HasFactory;

    protected $fillable = [
        'point_id',
        'behavior_id',
        'subject_id',
    ];

    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
    public function behavior(){
        return $this->belongsTo(Behavior::class,'behavior_id','id');
    }
    public function point(){
        return $this->belongsTo(Points::class,'point_id','id');
    }
}
