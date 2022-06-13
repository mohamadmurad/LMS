<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'count',
    ];

    public function behavior(){
        return $this->belongsToMany(Behavior::class,'points_behaviors','point_id','behavior_id')
            ->withTimestamps();
    }

    public function subject(){
        return $this->morphTo(Subject::class,'model_type','model_id');
    }
}
