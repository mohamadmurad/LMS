<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSubmit extends Model
{
    use HasFactory;

    protected $fillable = [
        'final_mark',
        'student_id',
        'exam_id',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    public function answers()
    {
        return $this->belongsToMany(Question::class, 'exam_submit_answers',
            'exam_submits_id', 'question_id')
            ->using(ExamSubmitAnswers::class)
            ->withPivot(['option_id', 'correct'])
            ->withTimestamps();
    }

    public function correctQuestion($id)
    {
        $correct = false;
        $answer = $this->answers()
            ->where('question_id', $id)->first();
        if ($answer) {
            $correct = $answer->pivot->correct;
        }


        return $correct;

    }

    public function optionIDQuestion($id)
    {
        $oid = 0;
        $answer = $this->answers()
            ->where('question_id', $id)->first();
       // dd($answer);

        if ($answer) {
            $oid = $answer->pivot->option_id;
        }
        return $oid;

    }

}
