<?php

namespace App\Models;

use App\Traits\HasPoints;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Points extends Model  implements HasMedia
{
    use HasFactory, HasMediaTrait;

    protected $fillable = [
        'name',
        'count',
        'model_type',
        'model_id',
        'hidden',
    ];

    public function behavior()
    {
        return $this->belongsToMany(Behavior::class, 'points_behaviors', 'point_id', 'behavior_id')
            ->withTimestamps();
    }

    public function subject()
    {
        return $this->morphTo(Subject::class, 'model_type', 'model_id');
    }

    public function objective()
    {
        return $this->morphTo(Objective::class, 'model_type', 'model_id');
    }

    public function pointReason()
    {
        return $this->morphTo('reason', 'model_type', 'model_id');
    }

    public function ScopeShowing($query)
    {
        return $query->where('hidden', 0);
    }
}
