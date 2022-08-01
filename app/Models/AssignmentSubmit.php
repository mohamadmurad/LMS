<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class AssignmentSubmit extends Model  implements HasMedia
{
    use HasFactory, HasMediaTrait;

    protected $fillable = [
        'assignment_id',
        'content',
        'status',
        'mark',
        'student_id',
        'feedback',
    ];


    public function assignment(){
        return $this->belongsTo(Assignment::class,'assignment_id','id');
    }
    public function student(){

        return $this->belongsTo(User::class,'student_id','id');
    }
    public function objectives(){
        return $this->hasMany(assignmentSubmitObjectives::class,'submit_id','id');
    }

    public function achieved(){
        return $this->objectives()->where('is_achieved',true)->pluck('objective_id')->toArray();
    }


}
