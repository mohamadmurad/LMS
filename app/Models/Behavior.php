<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Behavior extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hidden',
    ];
    protected $appends = ['human_name'];

    public function getHumanNameAttribute()
    {
        return strtoupper(str_replace('_', ' ', $this->name));
    }

    public function ScopeShowing($query)
    {
        return $query->where('hidden', 0);
    }


    public function points()
    {
        return $this->belongsToMany(Points::class, 'points_behaviors', 'behavior_id', 'point_id')
            ->withTimestamps();
    }

    public function behaviorPoints()
    {
        return $this->belongsToMany(Points::class, 'point_custom_behaviors', 'behavior_id', 'point_id')
            ->withTimestamps();
    }

    public function subject_points($id)
    {
        return $this->belongsToMany(Points::class, 'points_behaviors', 'behavior_id', 'point_id')
            ->whereHas('subject',function ($query) use ($id){
                $query->where('id', '=', $id);
            })
            ->withPivot('id')
            ->withTimestamps()
            ->get();
    }


    public function objective_points($id)
    {
        return $this->belongsToMany(Points::class, 'points_behaviors', 'behavior_id', 'point_id')
            ->whereHas('objective',function ($query) use ($id){
                $query->where('id', '=', $id);
            })
            ->withPivot('id')
            ->withTimestamps()
            ->get();
    }


    public function badges(){
        return $this->hasMany(BadgeBehavior::class,'behavior_id','id')->with('badge');
    }
}
