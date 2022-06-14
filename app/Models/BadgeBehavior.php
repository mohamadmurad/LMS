<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadgeBehavior extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'behavior_id',
        'badge_id' ,
    ];

    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
    public function behavior(){
        return $this->belongsTo(Behavior::class,'behavior_id','id');
    }
    public function badge(){
        return $this->belongsTo(Badge::class,'badge_id','id');
    }
}
