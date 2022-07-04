<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Question extends Model implements HasMedia
{
    use HasFactory, HasMediaTrait;

    protected $fillable = [
        'question',
        'level',
        'subject_id',
        'objective_id',
    ];


    public function options()
    {
        return $this->hasMany(QuestionOption::class, 'question_id', 'id');
    }

    public function objective(){
        return $this->belongsTo(Objective::class, 'objective_id', 'id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function correctOption()
    {
        return $this->hasOne(QuestionOption::class, 'question_id', 'id')
            ->where('correct', 1);
    }

    public function exams(){
        return $this->belongsToMany(Exam::class,'exam_questions','question_id','exam_id')
            ->withTimestamps()
            ->using(ExamQuestion::class);
    }
}
