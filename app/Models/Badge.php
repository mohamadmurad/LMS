<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Badge extends Model implements HasMedia
{
    use HasFactory, HasMediaTrait;

    protected $fillable = [
        'name',
    ];

    public function behavior()
    {
        return $this->belongsToMany(Behavior::class, 'badge_behaviors', 'badge_id', 'behavior_id')
            ->withTimestamps();
    }

}
