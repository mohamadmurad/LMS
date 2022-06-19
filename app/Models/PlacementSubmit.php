<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacementSubmit extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'placement_id',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function placement()
    {
        return $this->belongsTo(Placement::class, 'placement_id', 'id');
    }

    public function answers()
    {
        return $this->belongsToMany(Question::class, 'placement_submit_answers',
            'placement_submits_id', 'question_id')
            ->using(PlacementSubmitAnswers::class)
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

        if ($answer) {
            $oid = $answer->pivot->option_id;
        }


        return $oid;

    }
}
