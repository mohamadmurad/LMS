<?php

namespace App\Models;

use App\Traits\HasPoints;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Exam extends Model
{
    use HasFactory, HasPoints;

    protected $fillable = [
        'name',
        'subject_id',
        'module_id',
    ];


    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'exam_questions', 'exam_id', 'question_id')
            ->withTimestamps()
            ->using(ExamQuestion::class);
    }

    public function submits()
    {
        return $this->hasMany(ExamSubmit::class, 'exam_id', 'id')
            ->with('answers');
    }

    public function authSubmit()
    {
        return $this->submits()
            ->where('student_id', Auth::id());
    }

    public function userSubmit($id)
    {
        return $this->submits()
            ->where('student_id', $id);


    }

    public function correctOptionId($q_id){
        return $this->questions()->where('question_id',$q_id)->correctOption->id;
    }
}
