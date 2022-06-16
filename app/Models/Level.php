<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Level extends Model implements HasMedia
{
    use HasFactory, HasMediaTrait;

    protected $fillable = [
        'name',
    ];


    public function subjects(){
        return $this->belongsToMany(Subject::class,'subject_levels','level_id','subject_id')
            ->using(SubjectLevel::class)
            ->withPivot('point')
            ->withTimestamps();
    }

    public function subjectLevelMinPoints($id){
        $point = $this->subjects()->where('subject_id',$id)->first();
        if ($point){
            return  $point->pivot->point;
        }

        return null;


    }
}
